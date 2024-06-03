<?php

namespace App\Livewire\Forms\Operation;

use Livewire\Attributes\Validate;
use Livewire\Form;

class NumberForm extends Form
{
    #[Validate]
    public array $transactions = [];

    public function rules(): array
    {
        return [
            'transactions.0.number' => ['required', 'numeric'],
            'transactions.0.amount' => ['required', 'decimal:0,2', 'numeric', 'max:999999'],
            'transactions.*.number' => ['required_with:transactions.*.amount', 'numeric'],
            'transactions.*.amount' => ['required_with:transactions.*.number', 'decimal:0,2', 'numeric', 'max:999999'],
        ];
    }

    public function messages(): array
    {
        return [
            'transactions.*.number.required' => 'Ingrese el número de operación',
            'transactions.*.amount.required' => 'Ingrese el monto de la transacción',
            'transactions.*.number.required_with' => 'Ingrese el número de operación',
            'transactions.*.amount.required_with' => 'Ingrese el monto de la transacción',
            'transactions.*.number.numeric' => 'Ingrese un número válido',
            'transactions.*.amount.decimal' => 'Ingrese un monto válido',
            'transactions.*.amount.numeric' => 'Ingrese un monto válido',
            'transactions.*.amount.max' => 'Ingrese un monto válido',
        ];
    }

    protected function prepareForValidation($attributes): array
    {
        $this->transactions = collect($this->transactions)->map(function ($transaction) {
            $transaction['amount'] = floatval(str_replace(',', '', $transaction['amount']));

            return $transaction;
        })->toArray();

        return $attributes;
    }
}
