<?php

namespace App\Livewire\Forms\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BusinessForm extends Form
{
    #[Validate('required|digits:11', as: 'RUC')]
    public ?string $ruc = '';

    #[Validate('required', as: 'Razón Social')]
    public ?string $businessName = '';

    #[Validate('required|digits:9', as: 'Celular')]
    public ?string $celphone = '';

    public function setBusinessForm()
    {
        $this->ruc = Auth::user()->document_number ?? '';
        $this->businessName = Auth::user()->name;
        $this->celphone = Auth::user()->celphone ?? '';
    }
}
