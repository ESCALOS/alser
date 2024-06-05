<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Collection;

class UniqueInCollection implements ValidationRule
{
    public function __construct(
        public Collection $collection,
        public string $field,
        public string $message)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->collection->pluck($this->field)->duplicates()->contains($value)) {
            $fail($this->message);
        }
    }
}
