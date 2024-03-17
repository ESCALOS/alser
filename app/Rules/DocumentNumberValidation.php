<?php

namespace App\Rules;

use App\Enums\DocumentTypeEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentNumberValidation implements ValidationRule
{
    protected $documentType;

    public function __construct($documentType)
    {
        $this->documentType = $documentType;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $documentTypeEnum = DocumentTypeEnum::getSelfById($this->documentType);
        $isValidLenght = $documentTypeEnum->validateNumberLength($value);

        if (is_null($documentTypeEnum) || ! $isValidLenght) {
            $fail(':attribute no válido.');
        }
    }
}
