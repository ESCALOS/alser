<?php

namespace App\View\Components\Operation;

use App\Models\Operation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Summary extends Component
{
    public function __construct(
        public Operation $operation
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.operation.summary');
    }
}
