<?php

namespace App\Livewire\Operation;

use App\Enums\CurrencyTypeEnum;
use App\Livewire\Forms\OperationForm;
use App\Models\BankAccount;
use App\Models\Price;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Mary\Traits\Toast;

class Quoter extends Component
{
    use Toast;

    #[Locked]
    public $purchaseFactor = 0;

    #[Locked]
    public $salesFactor = 0;

    public ?Collection $solAccounts = null;

    public ?Collection $dollarAccounts = null;

    #[Locked]
    public int $version = 0;

    public OperationForm $form;

    public function mount()
    {
        $price = Price::latest()->first(['purchase', 'sales']);
        $this->purchaseFactor = $price->purchase ?? 0;
        $this->salesFactor = $price->sales ?? 0;
        $this->form->amountToSend = 1000;
        $this->form->amountToReceive = $this->form->amountToSend * $this->purchaseFactor;

        $bankAccounts = BankAccount::where('user_id', Auth::id())
            ->with('bank')
            ->get(['id', 'name', 'account_number', 'currency_type', 'bank_id']);

        $this->solAccounts = $bankAccounts->filter(fn ($bankAccount) => $bankAccount->currency_type === CurrencyTypeEnum::SOL)
            ->map(fn ($bankAccount) => [
                'id' => $bankAccount->id,
                'name' => $bankAccount->name,
                'account_number' => $bankAccount->account_number,
                'bank_logo' => $bankAccount->bank->logo,
            ])->values();
        $this->form->solAccount = $this->solAccounts->first()?->id;

        $this->dollarAccounts = $bankAccounts->filter(fn ($bankAccount) => $bankAccount->currency_type === CurrencyTypeEnum::DOLLAR)
            ->map(fn ($bankAccount) => [
                'id' => $bankAccount->id,
                'name' => $bankAccount->name,
                'account_number' => $bankAccount->account_number,
                'bank_logo' => $bankAccount->bank->logo,
            ])->values();

        $this->form->dollarAccount = $this->dollarAccounts->first()?->id;
    }

    public function getPrices()
    {
        $price = Price::latest()->first(['purchase', 'sales']);
        if ($this->purchaseFactor != $price->purchase || $this->salesFactor != $price->sales) {
            $this->purchaseFactor = $price->purchase ?? 0;
            $this->salesFactor = $price->sales ?? 0;
            $this->version++;
            $this->toast(
                type: 'success',
                title: 'Cambio el dolar',
                description: 'Revisa los nuevos precios',                  // optional (text)
                position: 'toast-top toast-end',    // optional (daisyUI classes)
                icon: 'o-information-circle',       // Optional (any icon)
                css: 'alert-info',                  // Optional (daisyUI classes)
                timeout: 3000,                      // optional (ms)
                redirectTo: null                    // optional (uri)
            );
        }
    }

    public function save()
    {
        $bankAccount = BankAccount::create([
            'name' => 'Otra cuenta generada',
            'bank_id' => 1,
            'account_number' => '1238891821',
        ]);
    }

    public function render()
    {
        return view('livewire.operation.quoter');
    }
}
