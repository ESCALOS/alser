<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BankAccountLength implements ValidationRule
{
    public function __construct(
        private int $bankId
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $length = strlen($value);
        $isValid = false;
        switch ($this->bankId) {
            case 1:
                $isValid = $length == 17;
                break;
            case 2:
                $isValid = $length == 14;
                break;
            default:
                $isValid = $length > 13 && $length <= 25;
                break;
        }

        if (! $isValid) {
            $fail($this->message());
        }
    }

    public function message(): string
    {
        return 'La longitud del número de cuenta no es válida para este banco.';
    }
}
