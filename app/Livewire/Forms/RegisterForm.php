<?php

namespace App\Livewire\Forms;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    use PasswordValidationRules;

    #[Validate('required|in:1,2', as: 'Tipo de cuenta')]
    public $account_type = 1;

    #[Validate('exclude_if:account_type,1|required|digits:11|unique:users', as: 'RUC')]
    public $document_number = '';

    #[Validate('exclude_if:account_type,1|required|string|max:255', as: 'Razón Social')]
    public $name = '';

    #[Validate('required|string|email|max:255|unique:users')]
    public $email = '';

    #[Validate]
    public $password = '';

    #[Validate('required')]
    public $password_confirmation = '';

    #[Validate('accepted|required')]
    public $terms = false;

    public function rules(): array
    {
        return [
            'password' => $this->passwordRules(),
        ];
    }

    public function store(): User
    {
        $this->validate();
        $data = [];
        if ($this->account_type == 2) {
            $data['document_type'] = 2; //Enum RUC
            $data['document_number'] = $this->document_number;
            $data['name'] = $this->name;
        }
        $data['account_type'] = $this->account_type;
        $data['email'] = $this->email;
        $data['password'] = Hash::make($this->password);

        return User::create($data);
    }
}
