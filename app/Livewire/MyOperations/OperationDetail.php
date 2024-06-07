<?php

namespace App\Livewire\MyOperations;

use App\Models\Operation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class OperationDetail extends Component
{
    public bool $withoutOperations = true;

    public string $date = '';

    public string $status = '';

    public bool $areOperations = false;

    #[On('show-operation-detail')]
    public function showOperationDetail(string $date, string $status)
    {
        $this->date = $date;
        $this->status = $status;
    }

    public function render()
    {
        return view('livewire.my-operations.operation-detail', [
            'areThereOperations' => Operation::where('user_id', Auth::id())->exists(),
        ]);
    }
}
