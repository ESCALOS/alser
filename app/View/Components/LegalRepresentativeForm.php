<?php

namespace App\View\Components;

use App\Models\LegalRepresentative;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LegalRepresentativeForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public LegalRepresentative $legalRepresentative,
        public User $user,
        public bool $verificationLinkSent,

    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.legal-representative-form');
    }
}
