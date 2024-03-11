<?php

namespace App\Livewire;

use App\Models\Price;
use Livewire\Component;

class Quoter extends Component
{
    public $purchaseFactor;
    public $salesFactor;

    public function mount() {
        $price = Price::latest()->first(['purchase', 'sales']);
        $this->purchaseFactor = $price->purchase ?? 0;
        $this->salesFactor = $price->sales ?? 0;
    }

    public function render()
    {
        return view('livewire.quoter');
    }
}
