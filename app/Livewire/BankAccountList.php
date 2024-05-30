<?php

namespace App\Livewire;

use App\Enums\CurrencyTypeEnum;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BankAccountList extends Component
{
    public function render()
    {
        $todos = BankAccount::where('user_id', Auth::user()->id)->get();
        $solAccounts = $todos->filter(fn ($cuenta) => $cuenta->currency_type === CurrencyTypeEnum::SOL);
        $dollarAccounts = $todos->filter(fn ($cuenta) => $cuenta->currency_type === CurrencyTypeEnum::DOLLAR);

        $haveBothTypes = $solAccounts->isNotEmpty() && $dollarAccounts->isNotEmpty();

        return view('livewire.bank-account-list', compact('todos', 'haveBothTypes'));
    }
}
