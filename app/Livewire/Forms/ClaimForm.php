<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ClaimForm extends Form
{
    #[Validate('required|integer|in:1,2', message: 'El servicio contratado es obligatorio')]
    public ?int $service = 1;

    #[Validate('required_if:service,1|in:1,2', message: 'El tipo de moneda es obligatorio')]
    public ?int $currency_type = 1;

    #[Validate('required_if:service,1', message: 'El código es obligatorio')]
    #[Validate('digits:6', message: 'Código inválido')]
    public string $operation_code = '';

    #[Validate('required_if:service,1', message: 'La cantidad a reclamar es obligatoria')]
    #[Validate('decimal:0,2', message: 'Ingrese una cantidad válida')]
    public string $amount_to_claim = '';

    protected function prepareForValidation($attributes): array
    {
        $attributes['amount_to_claim'] = floatval(str_replace(',', '', $attributes['amount_to_claim']));

        return $attributes;
    }
}
