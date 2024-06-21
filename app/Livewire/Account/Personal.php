<?php

namespace App\Livewire\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Personal extends Component
{
    public bool $verificationLinkSent = false;

    public User $user;

    public function mount()
    {
        $this->user = User::find(Auth::id());
    }

    public function sendEmailVerification()
    {
        $this->user->sendEmailVerificationNotification();
        $this->verificationLinkSent = true;
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="min-h-screen">
            <div>
                <h1 class="text-2xl font-bold text-home-primary">Cargando formulario</h1>
            </div>

            <x-mary-progress value="12" max="100" class="h-3" style="--progress-color: rgb(234,179,8)" indeterminate />
        </div>
        HTML;
    }

    #[On('refresh-personal')]
    public function render()
    {
        return view('livewire.account.personal');
    }
}
