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
use App\Notifications\ComplaintBook as NotificationsComplaintBook;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ComplaintBook extends Component
{
    use LivewireAlert;

    public ComplaintBookForm $form;

    public ClaimForm $claimForm;

    public $pdf_name = '';

    #[Locked]
    public array $provinces_found = [];

    #[Locked]
    public array $districts_found = [];

    #[Locked]
    public array $document_types;

    #[Locked]
    public array $currencies;

    #[Locked]
    public array $response_mediums;

    #[Locked]
    public array $reasons;

    #[Locked]
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

    #[Computed]
    public function getPdfPath(): string
    {
        return storage_path('pdf/complaint-book/'.$this->pdf_name);
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
        if (! $this->form->is_complaint && $this->claimForm->service == 1) {
            $this->form->reason_description = '';
        }
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
            if ($this->form->document_type == 2) {
                $this->form->representative = '';
                $this->form->last_name_father = '';
                $this->form->last_name_mother = '';
            }
            $savedComplaint = ModelsComplaintBook::create($this->form->except(['location_department_id', 'location_province_id']));

            $formData = $this->form->all();
            $formData['id'] = str_pad($savedComplaint->id, 6, '0', STR_PAD_LEFT);
            $formData['document_type_name'] = DocumentTypeEnum::getValueById($formData['document_type']);
            $formData['response_medium_name'] = ResponseMediumEnum::getValueById($formData['response_medium']);
            $formData['location_department_name'] = $this->departments()[$formData['location_department_id'] - 1]['name'];
            $formData['location_province_name'] = $this->provinces()[$formData['location_province_id'] - 1]['name'];
            $formData['location_district_name'] = $this->districts()[$formData['location_district_id'] - 1]['name'];

            $claimFormData = [];
            if (! $this->form->is_complaint && $this->claimForm->service == 1) {
                $claimFormData = $this->claimForm->all();
                $claimFormData['amount_str'] = $this->claimForm->amount_to_claim;
                $claimFormData['amount_to_claim'] = floatval(str_replace(',', '', $claimFormData['amount_to_claim']));
                $claimFormData['complaint_book_id'] = $savedComplaint->id;
                Claim::create($claimFormData);
                $claimFormData['currency_type_name'] = CurrencyTypeEnum::getValueById($claimFormData['currency_type']);
            }

            $data = [
                'form' => $formData,
                'claim' => $claimFormData,
            ];

            $this->form->reset();
            $this->claimForm->reset();
            $this->savedPdf($data);
            $savedComplaint->notify(new NotificationsComplaintBook($this->getPdfPath()));
            $this->alert('success', 'Reclamo enviado', [
                'position' => 'center',
                'toast' => false,
                'timer' => '',
                'showConfirmButton' => true,
                'onConfirmed' => 'download-pdf',
                'confirmButtonText' => 'Descargar PDF',
                'text' => 'Se le envió una copia a su correo',
            ]);
        });
    }

    private function savedPdf($data)
    {
        $this->pdf_name = 'Alser-Reclamo-'.$data['form']['id'].'.pdf';
        PDF::loadView('pdf.complaint-book', $data)->setPaper('a4')->save($this->getPdfPath());
    }

    #[On('download-pdf')]
    public function downloadPdf()
    {
        return response()->download($this->getPdfPath());
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
