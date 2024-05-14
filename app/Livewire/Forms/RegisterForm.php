<?php

namespace App\Livewire\Forms;

use App\Actions\Fortify\PasswordValidationRules;
use App\Enums\AccountTypeEnum;
use App\Enums\DocumentTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    use PasswordValidationRules;

    #[Validate]
    public $account_type = AccountTypeEnum::PERSONAL;

    #[Validate]
    public $document_number = '';

    #[Validate]
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
            'account_type' => ['required', Rule::enum(AccountTypeEnum::class)],
            'document_number' => [Rule::excludeIf(fn () => $this->account_type == AccountTypeEnum::PERSONAL), 'required', 'string', 'digits:11', 'unique:users'],
            'name' => [Rule::excludeIf(fn () => $this->account_type == AccountTypeEnum::PERSONAL), 'required', 'string', 'max:255'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'account_type' => 'Tipo de cuenta',
            'document_number' => 'RUC',
            'name' => 'Razón Social',
        ];
    }

    public function store(): User
    {
        $this->validate();
        $data = [];
        if ($this->account_type == AccountTypeEnum::BUSINESS) {
            $data['document_type'] = DocumentTypeEnum::TAX_NUMBER;
            $data['document_number'] = $this->document_number;
            $data['name'] = $this->name;
        }
        $data['account_type'] = $this->account_type;
        $data['email'] = $this->email;
        $data['password'] = Hash::make($this->password);

        return User::create($data);
    }
}
