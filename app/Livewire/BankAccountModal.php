<?php

namespace App\Livewire;

use App\Enums\BankAccountTypeEnum;
use App\Enums\CurrencyTypeEnum;
use App\Livewire\Forms\BankAccountForm;
use App\Models\Bank;
use App\Models\LocationDepartment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class BankAccountModal extends Component
{
    use LivewireAlert;

    public bool $showDrawer = false;

    public BankAccountForm $form;

    public array $departments;

    #[Locked]
    public array $bankAccountTypes;

    #[Locked]
    public array $currencies;

    public array $banks;

    public function mount()
    {
        $this->bankAccountTypes = BankAccountTypeEnum::getChoices();
        $this->currencies = CurrencyTypeEnum::getChoices();
        $this->departments = LocationDepartment::select('id', 'name')->get()->toArray();
        $this->banks = Bank::select('id', 'name')->get()->toArray();
    }

    #[On('fill-fields')]
    public function fillFields($bankAccountId)
    {
        $this->resetValidation();
        $this->form->fillFields($bankAccountId);
        $this->showDrawer = true;
        // usleep(1000000);
    }

    #[On('delete')]
    public function delete($bankAccountId)
    {
        $this->form->delete($bankAccountId);
        $this->dispatch('account-deleted');
    }

    public function save()
    {
        $bankAccount = $this->form->save();
        if ($this->form->bankAccountId > 0) {
            $this->dispatch('account-updated.'.$this->form->bankAccountId);
        } else {
            $data = [
                'id' => $bankAccount->id,
                'name' => $bankAccount->name,
                'account_number' => $bankAccount->account_number,
                'bank_logo' => $bankAccount->bank->logo,
                'currency_type' => $bankAccount->currency_type,
            ];
            $this->dispatch('account-created', bankAccount: $data);
        }
        $this->showDrawer = false;

        $this->alert('success', 'Guardado', [
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
        return view('livewire.bank-account-modal');
    }
}
