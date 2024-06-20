<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class LegalRepresentativeForm extends Component
{
    protected User $user;

    public function __construct(
        public bool $verificationLinkSent,

    ) {
        $this->user = User::find(Auth::id());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.legal-representative-form', [
            'user' => $this->user,
        ]);
    }
}
