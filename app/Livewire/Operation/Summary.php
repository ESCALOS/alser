<?php

namespace App\Livewire\Operation;

use App\Models\Operation;
use Livewire\Component;

class Summary extends Component
{
    public Operation $operation;

    public function render()
    {
        return view('livewire.operation.summary');
    }
}
