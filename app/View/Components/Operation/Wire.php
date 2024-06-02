<?php

namespace App\View\Components\Operation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Wire extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $bank,
        public string $account,
        public float $amount,
        public bool $isPurchase
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.operation.wire');
    }
}
