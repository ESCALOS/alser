<?php

namespace App\Livewire\Forms;

use App\Models\BankAccount;
use Livewire\Attributes\Locked;
use Livewire\Form;

class BankAccountForm extends Form
{
    #[Locked]
    public int $user_id;

    public int $location_department_id = 15;

    public int $bank_id = 1;

    public int $bank_account_type = 1;

    public int $currency_type = 1;

    public string $account_number = '';

    public string $name = '';

    public function save()
    {
        BankAccount::create($this->all());
    }
}
