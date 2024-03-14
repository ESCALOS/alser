<?php

namespace App\Livewire;

use App\Livewire\Forms\ComplaintBookForm;
use App\Models\LocationDepartment;
use App\Models\LocationDistrict;
use App\Models\LocationProvince;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ComplaintBook extends Component
{
    use LivewireAlert;

    public ComplaintBookForm $form;

    public ?int $departmentId = null;

    public ?int $provinceId = null;

    public array $provincesFound = [];

    public array $districtsFound = [];

    public function mount()
    {

    }

    #[Computed(persist: true)]
    public function departments(): array
    {
        return LocationDepartment::select('id', 'name')->get()->toArray();
    }

    #[Computed(persist: true)]
    public function provinces(): array
    {
        return LocationProvince::select('id', 'name', 'location_department_id')->get()->toArray();
    }

    #[Computed(persist: true)]
    public function districts(): array
    {
        return LocationDistrict::select('id', 'name', 'location_province_id')->get()->toArray();
    }

    private function loadProvinces()
    {
        if (isset($this->departmentId)) {
            $this->provincesFound = collect($this->provinces)
                ->where('location_department_id', $this->departmentId)
                ->values()
                ->toArray();
        }
    }

    private function loadDistricts()
    {
        if (isset($this->departmentId)) {
            if (isset($this->provinceId)) {
                $this->districtsFound = collect($this->districts)
                    ->where('location_province_id', $this->provinceId)
                    ->values()
                    ->toArray();
            } else {
                $this->form->districtId = null;
                $this->districtsFound = [];
            }
        }

    }

    public function updatedDepartmentId()
    {
        $this->loadProvinces();

        $this->reset('provinceId');
        $this->form->districtId = null;
    }

    public function updatedProvinceId()
    {
        $this->loadDistricts();
    }

    public function render()
    {
        return view('livewire.complaint-book');
    }
}
