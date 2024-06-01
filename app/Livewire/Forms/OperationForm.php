<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class OperationForm extends Form
{
    #[Validate]
    public bool $isPurchase = true;

    #[Validate('required|min:1,max:99999999|decimal:0,2', as: 'Cantidad a enviar')]
    public $amountToSend = 1000;

    #[Validate('required|max:99999999|decimal:0,2', as: 'Cantidad a recibir')]
    public $amountToReceive = 3737;

    #[Validate('required', as: 'Cuenta en soles')]
    public ?string $solAccount;

    #[Validate('required', as: 'Cuenta en dólares')]
    public ?string $dollarAccount;

    #[Validate('accepted|required', as: 'Términos')]
    public bool $terms = false;

    protected function prepareForValidation($attributes): array
    {
        $attributes['amountToSend'] = floatval(str_replace(',', '', $attributes['amountToSend']));
        $attributes['amountToReceive'] = floatval(str_replace(',', '', $attributes['amountToReceive']));

        return $attributes;
    }
}
