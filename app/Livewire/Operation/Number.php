<?php

namespace App\Livewire\Operation;

use App\Enums\OperationStatusEnum;
use App\Models\Operation;
use Livewire\Component;

class Number extends Component
{
    public Operation $operation;

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

    public function render()
    {
        return view('livewire.operation.number');
    }
}
