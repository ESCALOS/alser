<?php

namespace App\Livewire\MyOperations;

use App\Models\Operation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OperationList extends Component
{
    public function render()
    {
        return view('livewire.my-operations.operation-list', [
            'operations' => Operation::where('user_id', Auth::id())->latest()->paginate(7),
        ]);
    }
}
