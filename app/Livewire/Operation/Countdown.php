<?php

namespace App\Livewire\Operation;

use Livewire\Component;

class Countdown extends Component
{
    public $createdAt;

    public function render()
    {
        return view('livewire.operation.countdown');
    }
}
