<?php

namespace App\Livewire\Operation;

use App\Enums\CurrencyTypeEnum;
use App\Enums\OperationStatusEnum;
use App\Livewire\Forms\OperationForm;
use App\Models\BankAccount;
use App\Models\Operation;
use App\Models\Price;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Quoter extends Component
{
    use Toast;

    #[Locked]
    public $purchaseFactor = 0;

    #[Locked]
    public $salesFactor = 0;

    public Collection $solAccounts;

    public Collection $dollarAccounts;

    #[Locked]
    public int $version = 0;

    public OperationForm $form;

    public function mount()
    {
        $price = Price::latest()->first(['purchase', 'sales']);
        $this->purchaseFactor = $price->purchase ?? 0;
        $this->salesFactor = $price->sales ?? 0;
        $this->form->amountToSend = 1000;
        $this->form->amountToReceive = number_format($this->form->amountToSend * $this->purchaseFactor, 2);

        $bankAccounts = BankAccount::where('user_id', Auth::id())
            ->with('bank')
            ->get(['id', 'name', 'account_number', 'currency_type', 'bank_id']);

        $this->solAccounts = $bankAccounts->filter(fn ($bankAccount) => $bankAccount->currency_type === CurrencyTypeEnum::SOL)
            ->map(fn ($bankAccount) => [
                'id' => $bankAccount->id,
                'name' => $bankAccount->name,
                'account_number' => $bankAccount->account_number,
                'bank_logo' => $bankAccount->bank->logo,
            ])->values();
        if (! $this->solAccounts->isEmpty()) {
            $this->form->solAccount = $this->solAccounts->first()['id'];
        }
        $this->dollarAccounts = $bankAccounts->filter(fn ($bankAccount) => $bankAccount->currency_type === CurrencyTypeEnum::DOLLAR)
            ->map(fn ($bankAccount) => [
                'id' => $bankAccount->id,
                'name' => $bankAccount->name,
                'account_number' => $bankAccount->account_number,
                'bank_logo' => $bankAccount->bank->logo,
            ])->values();
        if (! $this->dollarAccounts->isEmpty()) {
            $this->form->dollarAccount = $this->dollarAccounts->first()['id'];
        }
    }

    #[On('account-created')]
    public function newBankAccount($bankAccount)
    {
        $currencyType = CurrencyTypeEnum::from($bankAccount['currency_type']);
        $data = [
            'id' => $bankAccount['id'],
            'name' => $bankAccount['name'],
            'account_number' => $bankAccount['account_number'],
            'bank_logo' => $bankAccount['bank_logo'],
        ];
        if ($currencyType === CurrencyTypeEnum::SOL) {
            if ($this->solAccounts->isEmpty()) {
                $this->solAccounts = collect([$data]);
            } else {
                $this->solAccounts->push($data);
            }
            $this->form->solAccount = $bankAccount['id'];
        } else {
            if ($this->dollarAccounts->isEmpty()) {
                $this->dollarAccounts = collect([$data]);
            } else {
                $this->dollarAccounts->push($data);
            }
            $this->form->dollarAccount = $bankAccount['id'];
        }
    }

    public function getPrices()
    {
        $price = Price::latest()->first(['purchase', 'sales']);
        if ($this->purchaseFactor != $price->purchase || $this->salesFactor != $price->sales) {
            $this->purchaseFactor = $price->purchase ?? 0;
            $this->salesFactor = $price->sales ?? 0;
            $this->version++;
            $this->toast(
                type: 'success',
                title: 'Cambio el dolar',
                description: 'Revisa los nuevos precios',                  // optional (text)
                position: 'toast-top toast-end',    // optional (daisyUI classes)
                icon: 'o-information-circle',       // Optional (any icon)
                css: 'alert-info',                  // Optional (daisyUI classes)
                timeout: 3000,                      // optional (ms)
                redirectTo: null                    // optional (uri)
            );
        }
    }

    public function save()
    {
        try {
            $this->form->resetValidation();
            $this->form->validate();

            $lastOperation = Operation::where('user_id', Auth::id())->latest()->first();

            if ($lastOperation) {
                if ($lastOperation->status === OperationStatusEnum::PENDING) {
                    $this->info('Ingresa el número de operación.');
                    $this->dispatch('operation-created');

                    return;
                }
                if ($lastOperation->status === OperationStatusEnum::UPLOADED) {
                    $this->warning('Advertencia', 'Ya tienes una operación en proceso');
                    $this->dispatch('operation-created');

                    return;
                }
            }

            $accounts = BankAccount::whereIn('id', [$this->form->solAccount, $this->form->dollarAccount])->get();
            $solAccount = $accounts->find($this->form->solAccount);
            $dollarAccount = $accounts->find($this->form->dollarAccount);

            $accountFromSend = $this->form->isPurchase ? $dollarAccount : $solAccount;
            $accountToReceive = $this->form->isPurchase ? $solAccount : $dollarAccount;

            Operation::create([
                'user_id' => auth()->user()->id,
                'is_purchase' => $this->form->isPurchase,
                'amount_to_send' => floatval(str_replace(',', '', $this->form->amountToSend)),
                'amount_to_receive' => floatval(str_replace(',', '', $this->form->amountToReceive)),
                'factor' => $this->form->isPurchase ? $this->purchaseFactor : $this->salesFactor,
                'account_from_send' => $accountFromSend->account_number,
                'account_to_receive' => $accountToReceive->account_number,
                'origin_bank' => $accountFromSend->bank_id,
                'destination_bank' => $accountToReceive->bank_id,
            ]);

            $this->form->terms = false;

            $this->info('Realiza la transferencia y proporciona el código de pago');
            $this->dispatch('operation-created');
        } catch (ValidationException $ex) {
            $message = '';
            foreach ($ex->errors() as $field => $errorMessage) {
                $this->addError($field, $errorMessage);
                if ($message === '') {
                    $message = $errorMessage[0];
                }
            }
            $this->warning('Advertencia', $message);
        }
    }

    public function render()
    {
        return view('livewire.operation.quoter');
    }
}
