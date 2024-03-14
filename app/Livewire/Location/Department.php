<?php

namespace App\Livewire\Location;

use App\Models\LocationDepartment;
use Livewire\Component;

class Department extends Component
{
    public array $departments;

    public $department;

    public function mount()
    {
        $this->departments = LocationDepartment::select('id', 'name')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.location.department');
    }
}
