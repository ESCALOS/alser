<?php

namespace App\Livewire\Forms;

use App\Enums\BankAccountTypeEnum;
use App\Enums\CurrencyTypeEnum;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BankAccountForm extends Form
{
    #[Validate('required')]
    public int $bankAccountId = 0;

    #[Validate('required|exists:location_departments,id', as: 'Departamento')]
    public int $locationDepartmentId = 15;

    #[Validate('required|exists:banks,id')]
    public int $bankId = 1;

    #[Validate]
    public BankAccountTypeEnum $bankAccountType = BankAccountTypeEnum::SAVING;

    #[Validate]
    public CurrencyTypeEnum $currencyType = CurrencyTypeEnum::SOL;

    #[Validate]
    public string $accountNumber = '';

    #[Validate]
    public string $cciNumber = '';

    #[Validate]
    public string $name = '';

    public function rules(): array
    {
        return [
            'bankAccountType' => [
                'required',
                Rule::enum(BankAccountTypeEnum::class),
            ],
            'currencyType' => [
                'required',
                Rule::enum(CurrencyTypeEnum::class),
            ],
            'accountNumber' => [
                'required',
                Rule::unique('bank_accounts', 'account_number')->where('user_id', Auth::user()->id)->ignore($this->bankAccountId),
                'min:10',
                'max:30',
            ],
            'cciNumber' => [
                'required',
                Rule::unique('bank_accounts', 'cci_number')->where('user_id', Auth::user()->id)->ignore($this->bankAccountId),
                'min:10',
                'max:30',
            ],
            'name' => [
                'required',
                Rule::unique('bank_accounts')->where('user_id', Auth::user()->id)->ignore($this->bankAccountId),
                'min:3',
                'max:30',
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'bankAccountType' => 'Tipo de cuenta bancaria',
            'currencyType' => 'Tipo de moneda',
            'accountNumber' => 'Número de cuenta',
            'cciNumber' => 'Número de CCI',
            'name' => 'Alias',
        ];
    }

    public function messages()
    {
        return [
            'bankAccountType.required' => 'El tipo de cuenta es requerido',
            'currencyType.required' => 'El tipo de moneda es obligatorio',
            'accountNumber.unique' => 'Ya se ha registrado este número de cuenta',
            'accountNumber.min' => 'Número de cuenta no válido',
            'accountNumber.max' => 'Número de cuenta no válido',
            'name.unique' => 'El alias ya existe',
        ];
    }

    public function fillFields(int $bankAccountId)
    {
        $bankAccount = BankAccount::find($bankAccountId);

        if ($bankAccount->user_id === Auth::user()->id) {
            $this->bankAccountId = $bankAccountId;
            $this->locationDepartmentId = $bankAccount->location_department_id;
            $this->bankId = $bankAccount->bank_id;
            $this->bankAccountType = $bankAccount->bank_account_type;
            $this->currencyType = $bankAccount->currency_type;
            $this->accountNumber = $bankAccount->account_number;
            $this->cciNumber = $bankAccount->cci_number;
            $this->name = $bankAccount->name;
        }

    }

    public function save(): ?BankAccount
    {
        $this->validate();
        if ($this->bankAccountId == 0) {
            $bankAccount = new BankAccount();
        } else {
            $bankAccount = BankAccount::find($this->bankAccountId);
            if ($bankAccount->user_id !== Auth::user()->id) {
                return null;
            }
        }
        $bankAccount->user_id = Auth::user()->id;
        $bankAccount->location_department_id = $this->locationDepartmentId;
        $bankAccount->bank_id = $this->bankId;
        $bankAccount->bank_account_type = $this->bankAccountType;
        $bankAccount->currency_type = $this->currencyType;
        $bankAccount->cci_number = $this->cciNumber;
        $bankAccount->account_number = $this->accountNumber;
        $bankAccount->name = $this->name;

        $bankAccount->save();

        return $bankAccount;
    }

    public function delete($bankAccountId)
    {
        $bankAccount = BankAccount::find($bankAccountId);
        if ($bankAccount->user_id !== Auth::user()->id) {
            return;
        }
        $bankAccount->delete();
    }
}
