<?php

namespace App\Livewire;

use App\Livewire\Forms\ComplaintBookForm;
use App\Models\LocationDepartment;
use App\Models\LocationDistrict;
use App\Models\LocationProvince;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ComplaintBook extends Component
{
    public ComplaintBookForm $form;

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

    public function updated()
    {

        $existDepartmentId = isset($this->form->departmentId);

        if (! $existDepartmentId) {
            $this->form->provinceId = null;
        }

        $this->provincesFound = $existDepartmentId
                    ? collect($this->provinces)
                        ->where('location_department_id', $this->form->departmentId)
                        ->values()
                        ->toArray()
                    : [];

        $existProvinceId = isset($this->form->provinceId);

        if (! $existProvinceId) {
            $this->form->districtId = null;
        }

        $this->districtsFound = $existProvinceId
                    ? collect($this->districts)
                        ->where('location_province_id', $this->form->provinceId)
                        ->values()
                        ->toArray()
                    : [];

    }

    public function render()
    {
        return view('livewire.complaint-book');
    }
}
