<?php

namespace App\Livewire;

use App\Enums\OperationStatusEnum;
use App\Models\Operation as ModelsOperation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Operation extends Component
{
    use Toast;

    public $lastOperation;

    public function mount()
    {
        $this->lastOperation = ModelsOperation::where('user_id', Auth::id())->latest()->first();
    }

    #[Computed]
    public function status(): OperationStatusEnum
    {
        return $this->lastOperation->status ?? OperationStatusEnum::WITHOUT_OPERATION;
    }

    #[On('operation-created')]
    public function updateLastOperation()
    {
        $this->lastOperation = ModelsOperation::where('user_id', Auth::id())->latest()->first();
    }

    public function render()
    {
        return view('livewire.operation');
    }
}
