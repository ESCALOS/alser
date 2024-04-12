<?php

namespace App\Livewire\Forms\Account;

use App\Models\PersonalAccount;
use App\Models\User;
use App\Rules\DocumentNumberValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonalForm extends Form
{
    #[Validate('required', as: 'Nombre')]
    public string $name = '';

    #[Validate('required', as: 'Primer Apellido')]
    public string $first_surname = '';

    #[Validate('required', as: 'Segundo Apellido')]
    public string $second_surname = '';

    #[Validate('required|in:1,3,4')]
    public int $document_type = 1;

    #[Validate]
    public string $document_number = '';

    #[Validate('required|digits:9', as: 'Celular')]
    public string $celphone = '';

    #[Validate('required|exists:countries,id', as: 'Nacionalidad')]
    public int $nacionality = 140;

    #[Validate('required|image|max:1024|mimes:jpeg,png,jpg', as: 'La imagen')]
    public $identity_document_front;

    #[Validate('required|image|max:1024|mimes:jpeg,png,jpg', as: 'La imagen')]
    public $identity_document_back;

    #[Validate('required|boolean')]
    public bool $is_PEP = false;

    #[Validate('required|boolean')]
    public bool $wife_is_PEP = false;

    #[Validate('required|boolean')]
    public bool $relative_is_PEP = false;

    public function setPersonalForm()
    {
        $this->name = Auth::user()->name;
        $this->document_type = Auth::user()->document_type;
        $this->document_number = Auth::user()->document_number;
        $this->celphone = Auth::user()->celphone;
        if (PersonalAccount::where('user_id', Auth::user()->id)->exists()) {
            $personalAccount = PersonalAccount::where('user_id', Auth::user()->id)->first();
            $this->first_surname = $personalAccount->first_surname;
            $this->second_surname = $personalAccount->second_surname;
        }
    }

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
        //dd($this->identity_document_front->getClientOriginalName());
        $this->validate();

        DB::transaction(function () {
            $user = User::find(Auth::user()->id);
            $user->name = $this->name;
            $user->document_type = $this->document_type;
            $user->document_number = $this->document_number;
            $user->celphone = $this->celphone;

            $personalAccount = PersonalAccount::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'first_surname' => $this->first_surname,
                    'second_surname' => $this->second_surname,
                    'nacionality' => $this->nacionality,
                    'is_PEP' => $this->is_PEP,
                    'wife_is_PEP' => $this->wife_is_PEP,
                    'relative_is_PEP' => $this->relative_is_PEP,
                ]
            );
            $this->identity_document_front->storeAs(path: 'identity-documents/personal_account', name: $this->getFilenameIdentityDocument('front', $this->identity_document_front->getClientOriginalName()));
            $this->identity_document_back->storeAs(path: 'identity-documents/personal_account', name: $this->getFilenameIdentityDocument('back', $this->identity_document_back->getClientOriginalName()));

            $user->save();
            $personalAccount->save();
        });
    }

    private function getFilenameIdentityDocument(string $prefix, string $fileName)
    {
        $extensionSeparatorIndex = strrpos($fileName, '.');
        if ($extensionSeparatorIndex !== false) {
            $extension = substr($fileName, $extensionSeparatorIndex);
        } else {
            $extension = '';
        }

        return $prefix.''.Auth::user()->id.''.$extension;
    }
}
