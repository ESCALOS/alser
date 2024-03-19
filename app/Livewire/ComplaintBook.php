<?php

namespace App\Livewire;

use App\Enums\ClaimTypeEnum;
use App\Enums\CurrencyTypeEnum;
use App\Enums\DocumentTypeEnum;
use App\Enums\ResponseMediumEnum;
use App\Enums\ServiceEnum;
use App\Livewire\Forms\ClaimForm;
use App\Livewire\Forms\ComplaintBookForm;
use App\Models\Claim;
use App\Models\ComplaintBook as ModelsComplaintBook;
use App\Models\LocationDepartment;
use App\Models\LocationDistrict;
use App\Models\LocationProvince;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ComplaintBook extends Component
{
    use LivewireAlert;

    public ComplaintBookForm $form;

    public ClaimForm $claimForm;

    public array $provinces_found = [];

    public array $districts_found = [];

    public array $document_types;

    public array $currencies;

    public array $response_mediums;

    public array $reasons;

    public array $services;

    public function mount()
    {
        $this->document_types = DocumentTypeEnum::getChoices();
        $this->currencies = CurrencyTypeEnum::getChoices();
        $this->services = ServiceEnum::getChoices();
        $this->reasons = ClaimTypeEnum::getChoices();
        $this->response_mediums = ResponseMediumEnum::getChoices();
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
        if (isset($this->form->location_department_id)) {
            $this->provinces_found = collect($this->provinces)
                ->where('location_department_id', $this->form->location_department_id)
                ->values()
                ->toArray();
        }
    }

    private function loadDistricts()
    {
        if (isset($this->form->location_province_id)) {
            $this->districts_found = collect($this->districts)
                ->where('location_province_id', $this->form->location_province_id)
                ->values()
                ->toArray();
        } else {
            $this->districts_found = [];
        }

    }

    public function updated($property)
    {
        if ($property === 'form.location_department_id') {
            $this->loadProvinces();
        }

        if ($property === 'form.location_province_id') {
            $this->loadDistricts();
        }
    }

    public function save()
    {
        $this->form->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                if (! $this->form->is_complaint && $this->claimForm->service == 2 && (empty($this->form->reason_description) || trim($this->form->reason_description) === '')) {
                    $validator->errors()->add('reason_description', 'Campo Obligatorio');
                }
                $fieldError = array_key_first($validator->failed());
                if ($fieldError) {
                    $this->dispatch('focus-input-error', field: $fieldError);
                }
            });
        });
        $this->form->validate();
        if (! $this->form->is_complaint) {
            $this->claimForm->validate();
        }

        DB::transaction(function () {
            $savedComplaint = ModelsComplaintBook::create($this->form->except(['location_department_id', 'location_province_id']));

            if (! $this->form->is_complaint && $this->claimForm->service == 1) {
                $claimFormData = $this->claimForm->all();
                $claimFormData['amount_to_claim'] = floatval(str_replace(',', '', $claimFormData['amount_to_claim']));
                $claimFormData['complaint_book_id'] = $savedComplaint->id;
                Claim::create($claimFormData);
            }

        });

        $this->form->reset();
        $this->claimForm->reset();
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
