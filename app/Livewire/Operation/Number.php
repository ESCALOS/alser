<?php

namespace App\Livewire\Operation;

use App\Enums\OperationStatusEnum;
use App\Livewire\Forms\Operation\NumberForm;
use App\Models\Operation;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Number extends Component
{
    public Operation $operation;

    public bool $areMany = false;

    public NumberForm $form;

    public function mount()
    {
        $this->form->transactions[0]['number'] = '8989';
        $this->form->transactions[0]['amount'] = $this->operation->amount_to_send;
    }

    #[Computed]
    public function areManyNumbers()
    {
        return count($this->form->transactions) > 1;
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
        $this->form->validate();
        $this->dispatch('save-number', $this->form->transactions);
    }

    public function render()
    {
        return view('livewire.operation.number');
    }
}
