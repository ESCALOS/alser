<?php

namespace App\Livewire\Forms;

use App\Enums\BankAccountTypeEnum;
use App\Enums\CurrencyTypeEnum;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class BankAccountForm extends Form
{
    public int $bankAccountId = 0;

    public int $locationDepartmentId = 15;

    public int $bankId = 1;

    public BankAccountTypeEnum $bankAccountType = BankAccountTypeEnum::SAVING;

    public CurrencyTypeEnum $currencyType = CurrencyTypeEnum::SOL;

    public string $accountNumber = '';

    public string $name = '';

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
            $this->name = $bankAccount->name;
        }

    }

    public function save()
    {
        if ($this->bankAccountId == 0) {
            $bankAccount = new BankAccount();
        } else {
            $bankAccount = BankAccount::find($this->bankAccountId);
            if ($bankAccount->user_id !== Auth::user()->id) {
                return;
            }
        }
        $bankAccount->user_id = Auth::user()->id;
        $bankAccount->location_department_id = $this->locationDepartmentId;
        $bankAccount->bank_id = $this->bankId;
        $bankAccount->bank_account_type = $this->bankAccountType;
        $bankAccount->currency_type = $this->currencyType;
        $bankAccount->account_number = $this->accountNumber;
        $bankAccount->name = $this->name;

        $bankAccount->save();
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
