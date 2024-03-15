<?php

namespace App\Livewire;

use App\Enums\CurrencyTypeEnum;
use App\Enums\DocumentTypeEnum;
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

    public ?int $departmentId = 15;

    public ?int $provinceId = null;

    public array $provincesFound = [];

    public array $districtsFound = [];

    public array $documentTypes;

    public array $currencies;

    public array $responseMediums = [
        ['name' => 'Correo electrónico'],
        ['name' => 'Entrega a domicilio'],
    ];

    public array $reasons = [
        ['name' => 'Queja'],
        ['name' => 'Reclamo'],
    ];

    public array $services = [
        ['name' => 'Cambio de moneda online'],
        ['name' => 'Otro'],
    ];

    public function mount()
    {
        $this->documentTypes = DocumentTypeEnum::getChoices();
        $this->currencies = CurrencyTypeEnum::getChoices();
        $this->loadProvinces();
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

    public function save()
    {
        $this->form->store();

        $this->alert('success', 'Reclamo enviado', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => '',
        ]);
    }

    public function render()
    {
        return view('livewire.complaint-book');
    }
}
