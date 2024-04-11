<?php

namespace App\Livewire\Forms\Account;

use App\Rules\DocumentNumberValidation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonalForm extends Form
{
    #[Validate('required', as: 'Nombre')]
    public $name = '';

    #[Validate('required', as: 'Primer Apellido')]
    public $first_surname = '';

    #[Validate('required', as: 'Segundo Apellido')]
    public $second_surname = '';

    #[Validate('required|in:1,3,4')]
    public $document_type = 1;

    #[Validate]
    public $document_number = '';

    #[Validate('required|digits:9', as: 'Celular')]
    public $celphone = '';

    #[Validate('required|exists:countries,id', as: 'Nacionalidad')]
    public $nacionality = 140;

    #[Validate('required|image|max:1024|mimes:jpeg,png,jpg', as: 'La imagen')]
    public $identity_document_front;

    #[Validate('required|image|max:1024|mimes:jpeg,png,jpg', as: 'La imagen')]
    public $identity_document_back;

    #[Validate('required|boolean')]
    public $is_PEP = false;

    #[Validate('required|boolean')]
    public $wife_is_PEP = false;

    #[Validate('required|boolean')]
    public $relative_is_PEP = false;

    public function rules(): array
    {
        return [
            'document_number' => ['required', new DocumentNumberValidation($this->document_type ?? 0)],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'document_number' => 'Número de documento',
        ];
    }

    public function messages(): array
    {
        return [
            'document_number.required' => 'El número de documento es obligatorio',
        ];
    }

    public function save()
    {
        $this->validate();

    }
}
