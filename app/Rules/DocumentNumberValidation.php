<?php

namespace App\Rules;

use App\Enums\DocumentTypeEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentNumberValidation implements ValidationRule
{
    protected DocumentTypeEnum $documentType;

    public function __construct(DocumentTypeEnum $documentType)
    {
        $this->documentType = $documentType;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_null($this->documentType)) {
            $fail(':attribute no válido.');
        }

        $isValidLenght = $this->documentType->validateNumberLength($value);

        if (! $isValidLenght) {
            $fail(':attribute no válido.');
        }
    }
}
