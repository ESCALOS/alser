<?php

namespace App\Livewire;

use App\Enums\BankAccountTypeEnum;
use App\Enums\CurrencyTypeEnum;
use App\Livewire\Forms\BankAccountForm;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\LocationDepartment;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class BankAccountList extends Component
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
        $this->form->fillFields($bankAccountId);
        $this->showDrawer = true;
        // usleep(1000000);
    }

    #[On('confirmDelete')]
    public function confirmDelete($bankAccountId, $name)
    {
        $this->form->bankAccountId = $bankAccountId;
        $this->confirm('¿Desea eliminar la cuenta <b>"'.$name.'"</b>?', [
            'onConfirmed' => 'delete',
            'confirmButtonText' => 'Sí',
        ]);
    }

    #[On('delete')]
    public function delete()
    {
        $this->form->delete();
    }

    public function save()
    {
        $this->form->save();
        if ($this->form->bankAccountId > 0) {
            $this->dispatch('account-updated.'.$this->form->bankAccountId);
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
        return view('livewire.bank-account-list', [
            'todos' => BankAccount::where('user_id', Auth::user()->id)->get(),
        ]);
    }
}
