<?php

namespace App\Livewire;

use App\Enums\OperationStatusEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\BankAccount;
use App\Models\Operation as ModelsOperation;
use App\Models\OperationNumber;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Operation extends Component
{
    use LivewireAlert;
    use Toast;

    public ?ModelsOperation $lastOperation;

    public function mount()
    {
        $this->lastOperation = ModelsOperation::where('user_id', Auth::id())->latest()->first();
    }

    #[On('send-verification-email')]
    public function sendEmailVerification()
    {
        $user = User::find(Auth::id());
        $user->forceFill([
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
        $this->alert(message: 'Revise su correo', options: [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => '',
        ]);
    }

    #[Computed]
    public function status(): OperationStatusEnum
    {
        return $this->lastOperation->status ?? OperationStatusEnum::WITHOUT_OPERATION;
    }

    #[On('create-operation')]
    public function createOperation(array $form, $factor)
    {
        $user = User::find(Auth::id());
        if (! $user->hasVerifiedEmail()) {
            $this->alert('warning', 'Tienes que validar tu correo', [
                'position' => 'center',
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);

            return;
        }

        if ($user->isDataPending()) {
            $this->alert('warning', 'Rellena los datos de tu perfil', [
                'position' => 'center',
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);

            return;
        }
        if ($user->isDataUploaded()) {
            $this->alert('info', 'Tus datos están siendo validados', [
                'position' => 'center',
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);

            return;
        }

        $this->lastOperation = ModelsOperation::where('user_id', Auth::id())->latest()->first();

        if ($this->lastOperation && $this->lastOperation->status === OperationStatusEnum::PENDING) {
            $this->warning('Advertencia', 'Ya tienes una operación en proceso');
            $this->dispatch('update-operation');

            return;
        }

        $accounts = BankAccount::whereIn('id', [$form['solAccount'], $form['dollarAccount']])->get();
        $solAccount = $accounts->find($form['solAccount']);
        $dollarAccount = $accounts->find($form['dollarAccount']);

        $accountFromSend = $form['isPurchase'] ? $dollarAccount : $solAccount;
        $accountToReceive = $form['isPurchase'] ? $solAccount : $dollarAccount;

        $amountToSend = floatval(str_replace(',', '', $form['amountToSend']));
        $amountToReceive = $form['isPurchase'] ? ($amountToSend * $factor) : ($amountToSend / $factor);

        $newOperation = ModelsOperation::create([
            'user_id' => auth()->user()->id,
            'transaction_type' => $form['isPurchase'] ? TransactionTypeEnum::PURCHASE : TransactionTypeEnum::SALE,
            'amount_to_send' => $amountToSend,
            'amount_to_receive' => $amountToReceive,
            'factor' => $factor,
            'account_from_send' => $accountFromSend->account_number,
            'account_to_receive' => $accountToReceive->account_number,
            'origin_bank' => $accountFromSend->bank_id,
            'destination_bank' => $accountToReceive->bank_id,
            'bank_account_to_receive_name' => $form['isPurchase'] ? $accountFromSend->bank->dollar_account_name : $accountFromSend->bank->sol_account_name,
            'bank_account_to_receive_number' => $form['isPurchase'] ? $accountFromSend->bank->dollar_account_number : $accountFromSend->bank->sol_account_number,
            'status' => OperationStatusEnum::PENDING,
        ]);
        $this->lastOperation = $newOperation;
        $this->info('Realiza la transferencia y proporciona el código de pago');
    }

    #[On('update-operation')]
    public function updateLastOperation()
    {
        $this->lastOperation = ModelsOperation::where('user_id', Auth::id())->latest()->first();
    }

    #[On('operation-cancelled')]
    public function cancelOperation()
    {
        $this->updateLastOperation();
        if ($this->lastOperation->status !== OperationStatusEnum::PENDING) {
            $this->info('No se puede cancelar la operación');

            return;
        }
        $now = new \DateTime();
        $createdAt = new \DateTime($this->lastOperation->created_at);

        $diff = $now->diff($createdAt);
        $minutes = $diff->i;

        if ($minutes <= 15) {
            $this->lastOperation->status = OperationStatusEnum::CANCELLED_BY_USER;
        } else {
            $this->lastOperation->status = OperationStatusEnum::CANCELLED_BY_SYSTEM;
        }
        $this->lastOperation->save();
    }

    #[On('save-number')]
    public function saveNumber(array $transactions)
    {
        $this->updateLastOperation();
        if ($this->lastOperation->status !== OperationStatusEnum::PENDING) {
            $this->info('No se puede editar la operación');

            return;
        }

        try {
            DB::transaction(function () use ($transactions) {
                foreach ($transactions as $transaction) {
                    $transaction = OperationNumber::create([
                        'operation_id' => $this->lastOperation->id,
                        'number' => $transaction['number'],
                        'amount' => floatval(str_replace(',', '', $transaction['amount'])),
                    ]);
                }
                $this->lastOperation->status = OperationStatusEnum::UPLOADED;
                $this->lastOperation->save();
            }, 2);
            $this->alert('success', 'Operación realizada con éxito', [
                'position' => 'center',
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);
        } catch (\Exception $e) {
            $this->alert('warning', 'Ocurrió un error', [
                'position' => 'center',
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.operation');
    }
}
