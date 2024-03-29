<?php

namespace App\View\Components\Graphics;

use App\Models\Price;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DollarFluctuation extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $yesteday = now()->subDay();
        $lastPrice = Price::whereDate('created_at', '<', today())->latest()->first() ?? new Price();
        $prices = Price::whereDate('created_at', today())->get();

        return view('components.graphics.dollar-fluctuation', compact('prices', 'lastPrice'));
    }
}
