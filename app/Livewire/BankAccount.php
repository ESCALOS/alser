<?php

namespace App\Livewire;

use App\Enums\BankAccountTypeEnum;
use App\Enums\CurrencyTypeEnum;
use App\Livewire\Forms\BankAccountForm;
use App\Models\Bank;
use App\Models\BankAccount as ModelsBankAccount;
use App\Models\LocationDepartment;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class BankAccount extends Component
{
    use LivewireAlert;

    public bool $showDrawer = false;

    public BankAccountForm $form;

    #[Locked]
    public array $bankAccountTypes;

    #[Locked]
    public array $currencies;

    public function mount()
    {
        $this->bankAccountTypes = BankAccountTypeEnum::getChoices();
        $this->currencies = CurrencyTypeEnum::getChoices();
        $this->form->user_id = Auth::user()->id;
    }

    #[Computed(persist: true)]
    public function departments(): array
    {
        return LocationDepartment::select('id', 'name')->get()->toArray();
    }

    #[Computed(persist: true)]
    public function banks(): array
    {
        return Bank::select('id', 'name')->get()->toArray();
    }

    public function save()
    {
        $bankAccount = new ModelsBankAccount();
        $bankAccount->user_id = 1;
        $bankAccount->location_department_id = 1;
        $bankAccount->bank_id = 1;
        $bankAccount->bank_account_type = 1;
        $bankAccount->currency_type = 1;
        $bankAccount->account_number = 1;
        $bankAccount->name = 'hola';
        $bankAccount->is_owner = true;
        $bankAccount->save();
        $this->showDrawer = false;

        $this->alert('danger', 'azlgo', [
            'position' => 'center',
            'toast' => false,
            'timer' => '',
            'showConfirmButton' => true,
            'onConfirmed' => '',
            'confirmButtonText' => 'OK',
        ]);

    }

    public function render()
    {
        return view('livewire.bank-account');
    }
}
