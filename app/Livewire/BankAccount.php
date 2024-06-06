<?php

namespace App\Livewire;

use App\Models\BankAccount as ModelsBankAccount;
use Livewire\Attributes\On;
use Livewire\Component;

class BankAccount extends Component
{
    public ModelsBankAccount $item;

    public function placeholder()
    {
        return <<<'HTML'
        <div class="relative flex flex-col p-5 rounded-sm bg-base-100">
            <div class="animate-pulse">
            <div class="animate-pulse">
            <!-- Título -->
            <div class="mb-4">
                <div class="w-48 h-6 bg-gray-300 rounded"></div>
            </div>
            <div class="flex flex-col justify-between gap-2 md:flex-row flex-column">
                <div>
                    <div class="w-40 h-6 bg-gray-300 rounded"></div>
                </div>
                <div>
                    <div class="w-40 h-6 bg-gray-300 rounded"></div>
                </div>
                <div class="hidden md:block">
                    <div class="w-40 h-6 bg-gray-300 rounded"></div>
                </div>
            </div>
        </div>
            </div>
        </div>
        HTML;
    }

    #[On('account-updated.{item.id}')]
    public function render()
    {
        return view('livewire.bank-account');
    }
}
