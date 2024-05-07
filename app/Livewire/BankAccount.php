<?php

namespace App\Livewire;

use App\Models\BankAccount as ModelsBankAccount;
use Livewire\Attributes\On;
use Livewire\Component;

class BankAccount extends Component
{
    public ModelsBankAccount $item;

    #[On('account-updated.{item.id}')]
    public function render()
    {
        return view('livewire.bank-account');
    }
}
