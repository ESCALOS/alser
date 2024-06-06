<?php

namespace App\Livewire\MyOperations;

use App\Models\Operation;
use Carbon\Carbon;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class OperationItem extends Component
{
    #[Reactive]
    public Operation $operation;

    public string $createdAtFormatted;

    public string $currencySymbolSend;

    public string $currencySymbolReceive;

    public function mount()
    {
        Carbon::setLocale('es');
        $date = Carbon::parse($this->operation->created_at);
        $firtPart = ucfirst($date->translatedFormat('l, d \d\e '));
        $SecondPart = ucfirst($date->translatedFormat('M \d\e Y'));
        $this->createdAtFormatted = $firtPart.$SecondPart;
        $this->currencySymbolSend = $this->operation->is_purchase ? '$' : 'S/.';
        $this->currencySymbolReceive = $this->operation->is_purchase ? 'S/.' : '$';
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="w-full p-4 bg-white border-r-2 border-violet-700">
            <p class="text-sm font-bold text-gray-700">
                <div class="w-32 h-4 bg-gray-300 animate-pulse"></div>
            </p>
            <div class="flex justify-between pt-2">
                <p class="font-bold text-gray-500">
                    <div class="w-20 h-4 bg-gray-300 animate-pulse"></div>
                </p>
                <p><i class="fa-solid fa-arrow-right text-violet-900"></i></p>
                <p class="font-bold text-gray-500">
                    <div class="w-20 h-4 bg-gray-300 animate-pulse"></div>
                </p>
            </div>
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.my-operations.operation-item');
    }
}
