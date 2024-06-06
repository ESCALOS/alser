<?php

namespace App\Livewire\MyOperations;

use App\Models\Operation;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class OperationItem extends Component
{
    #[Reactive]
    public Operation $operation;

    public function render()
    {
        return view('livewire.my-operations.operation-item');
    }
}
