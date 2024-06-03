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

    public ?ModelsOperation $lastOperation;

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

    #[On('operation-cancelled')]
    public function cancelOperation()
    {
        $this->updateLastOperation();
        if ($this->lastOperation->status !== OperationStatusEnum::PENDING) {
            return;
        }
        $now = new \DateTime();
        $createdAt = new \DateTime($this->lastOperation->created_at);

        $diff = $now->diff($createdAt);
        $minutes = $diff->i;

        if ($minutes <= 15) {
            $this->lastOperation->status = OperationStatusEnum::CANCELLED_BY_USER;
        } else {
            $this->lastOperation->status = OperationStatusEnum::CANCELLED_BY_SYSTEM;
        }
        $this->lastOperation->save();
    }

    public function render()
    {
        return view('livewire.operation');
    }
}
