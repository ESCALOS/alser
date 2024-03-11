<?php

namespace App\View\Components\Home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Faq extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $start = 0,
        public int $quantity = 2,
        public string $img = "default.png",
        public string $imgPosition = "float-right" )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $faqs = DB::table('faqs')->skip($this->start)->take($this->quantity)->get();

        return view('components.home.faq',compact('faqs'));
    }
}
