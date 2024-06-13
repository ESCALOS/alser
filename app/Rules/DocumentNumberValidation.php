<?php

namespace App\Rules;

use App\Enums\DocumentTypeEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentNumberValidation implements ValidationRule
{
    public function __construct(
        private DocumentTypeEnum $documentType
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_null($this->documentType)) {
            $fail(':attribute no válido.');
        }

        $isValidLenght = $this->documentType->validateNumberLength($value);

        if (! $isValidLenght) {
            $fail('El número '.$value.' no es un '.$this->documentType->getLabel().'.');
        }
    }
}
