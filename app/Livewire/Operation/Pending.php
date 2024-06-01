<?php

namespace App\Livewire\Operation;

use App\Models\Operation;
use Livewire\Component;

class Pending extends Component
{
    public Operation $operation;

    public function render()
    {
        return view('livewire.operation.pending');
    }
}
