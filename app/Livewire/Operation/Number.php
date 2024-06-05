<?php

namespace App\Livewire\Operation;

use App\Enums\OperationStatusEnum;
use App\Livewire\Forms\Operation\NumberForm;
use App\Models\Operation;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Number extends Component
{
    use LivewireAlert;

    public Operation $operation;

    public NumberForm $form;

    public float $totalAmount = 0;

    public function mount()
    {
        $this->form->transactions[0]['number'] = '';
        $this->form->transactions[0]['amount'] = $this->operation->amount_to_send;
        $this->totalAmount = $this->operation->amount_to_send;
    }

    #[Computed]
    public function currencySymbol(): string
    {
        return $this->operation->is_purchase ? '$' : 'S/. ';
    }

    public function cancelByUser()
    {
        $this->operation->status = OperationStatusEnum::CANCELLED_BY_USER;
        $this->operation->save();
        $this->dispatch('operation-cancelled');
    }

    public function cancelBySystem()
    {
        $this->operation->status = OperationStatusEnum::CANCELLED_BY_SYSTEM;
        $this->operation->save();
        $this->dispatch('operation-cancelled');
    }

    public function save()
    {
        try {
            $this->form->validate();
            $accumulatedAmount = collect($this->form->transactions)->sum('amount');

            if ($accumulatedAmount < $this->totalAmount) {
                $this->alert('warning', 'Monto insuficiente', [
                    'position' => 'center',
                    'toast' => false,
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                ]);

                return;
            }

            if ($accumulatedAmount > $this->totalAmount) {
                $this->alert('warning', 'Monto excedente', [
                    'position' => 'center',
                    'toast' => false,
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                ]);

                return;
            }

            $this->dispatch('save-number', $this->form->transactions);
        } catch (ValidationException $ex) {
            foreach ($ex->errors() as $errorMessage) {
                $this->alert('warning', $errorMessage[0], [
                    'position' => 'center',
                    'toast' => false,
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                ]);

                return;
            }
        }
    }

    public function render()
    {
        return view('livewire.operation.number');
    }
}
