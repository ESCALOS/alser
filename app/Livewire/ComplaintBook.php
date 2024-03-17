<?php

namespace App\Livewire;

use App\Enums\ClaimTypeEnum;
use App\Enums\CurrencyTypeEnum;
use App\Enums\DocumentTypeEnum;
use App\Enums\ResponseMediumEnum;
use App\Enums\ServiceEnum;
use App\Livewire\Forms\ClaimForm;
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

    public ClaimForm $claimForm;

    public array $provincesFound = [];

    public array $districtsFound = [];

    public array $documentTypes;

    public array $currencies;

    public array $responseMediums;

    public array $reasons;

    public array $services;

    public function boot()
    {
        $this->form->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                $this->dispatch('focus-input-error', field: array_key_first($validator->failed()) ?? null);
            });
        });
    }

    public function mount()
    {
        $this->documentTypes = DocumentTypeEnum::getChoices();
        $this->currencies = CurrencyTypeEnum::getChoices();
        $this->services = ServiceEnum::getChoices();
        $this->reasons = ClaimTypeEnum::getChoices();
        $this->responseMediums = ResponseMediumEnum::getChoices();
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
        if (isset($this->form->departmentId)) {
            $this->provincesFound = collect($this->provinces)
                ->where('location_department_id', $this->form->departmentId)
                ->values()
                ->toArray();
        }
    }

    private function loadDistricts()
    {
        if (isset($this->form->provinceId)) {
            $this->districtsFound = collect($this->districts)
                ->where('location_province_id', $this->form->provinceId)
                ->values()
                ->toArray();
        } else {
            //$this->form->districtId = null;
            $this->districtsFound = [];
        }

    }

    public function updated($property)
    {
        if ($property === 'form.departmentId') {
            $this->loadProvinces();
            //$this->reset('form.provinceId,form.districtId');
        }

        if ($property === 'form.provinceId') {
            $this->loadDistricts();
        }
    }

    public function save()
    {
        $this->form->validate();
        $this->alert('success', 'Reclamo enviado', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => '',
        ]);
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="min-h-screen">
            <div>
                <h1 class="text-2xl font-bold text-home-primary">Cargando formulario</h1>
            </div>

            <x-mary-progress value="12" max="100" class="h-3" style="--progress-color: rgb(234,179,8)" indeterminate />
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.complaint-book');
    }
}
