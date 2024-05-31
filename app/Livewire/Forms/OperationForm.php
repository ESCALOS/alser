<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class OperationForm extends Form
{
    #[Validate]
    public bool $isPurchase = true;

    #[Validate('required|max:99999999|decimal:10,2', as: 'Cantidad a enviar')]
    public float|string $amountToSend = 1000;

    #[Validate('required|max:99999999|decimal:10,2', as: 'Cantidad a recibir')]
    public float|string $amountToReceive = 3737;

    #[Validate('required', as: 'Cuenta en soles')]
    public ?string $solAccount;

    #[Validate('required', as: 'Cuenta en dólares')]
    public ?string $dollarAccount;

    #[Validate('accepted|required', as: 'Términos')]
    public bool $terms = false;
}
