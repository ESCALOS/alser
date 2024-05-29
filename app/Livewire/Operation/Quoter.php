<?php

namespace App\Livewire\Operation;

use App\Models\Price;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Mary\Traits\Toast;

class Quoter extends Component
{
    use Toast;

    public bool $isPurchase = true;

    #[Locked]
    public $purchaseFactor = 0;

    #[Locked]
    public $salesFactor = 0;

    public $amountToSend = 1000;

    public $amountToReceive = 3737;

    #[Locked]
    public int $version = 0;

    public function mount()
    {
        $price = Price::latest()->first(['purchase', 'sales']);
        $this->purchaseFactor = $price->purchase ?? 0;
        $this->salesFactor = $price->sales ?? 0;
        $this->amountToSend = 1000;
        $this->amountToReceive = $this->amountToSend * $this->purchaseFactor;
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

    public function render()
    {
        return view('livewire.operation.quoter');
    }
}
