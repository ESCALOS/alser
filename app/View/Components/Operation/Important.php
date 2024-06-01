<?php

namespace App\View\Components\Operation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Important extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $originBank,
        public string $destinationBank
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.operation.important');
    }
}
