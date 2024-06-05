<?php

namespace App\Livewire\MyOperations;

use App\Models\Operation;
use Livewire\Component;

class OperationItem extends Component
{
    public Operation $operation;

    public function render()
    {
        return view('livewire.my-operations.operation-item');
    }
}
