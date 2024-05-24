<?php

namespace App\Livewire\Forms\Account;

use App\Enums\DocumentTypeEnum;
use App\Enums\RepresentationTypeEnum;
use App\Models\LegalRepresentative;
use App\Models\User;
use App\Rules\DocumentNumberValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LegalRepresentativeForm extends Form
{
    public ?LegalRepresentative $legalRepresentative;

    #[Validate('required|digits:9', as: 'Celular')]
    public ?string $celphone = '';

    #[Validate]
    public $shareHolders = [];

    #[Validate('required', as: 'Nombre')]
    public ?string $name = '';

    #[Validate('required', as: 'Primer Apellido')]
    public ?string $firstLastname = '';

    #[Validate('required', as: 'Segundo Apellido')]
    public ?string $secondLastname = '';

    #[Validate]
    public DocumentTypeEnum $documentType = DocumentTypeEnum::ID;

    #[Validate]
    public ?string $documentNumber = '';

    #[Validate('required|exists:countries,id', as: 'Nacionalidad')]
    public int $nacionality = 140;

    #[Validate]
    public RepresentationTypeEnum $representationType = RepresentationTypeEnum::PODER;

    #[Validate]
    public $identityDocumentFront;

    #[Validate]
    public $identityDocumentBack;

    #[Validate('required|boolean')]
    public bool $isPEP = false;

    #[Validate('required|boolean')]
    public bool $wifeIsPEP = false;

    #[Validate('required|boolean')]
    public bool $relativeIsPEP = false;

    #[Validate]
    public $pdfPEP;

    public function setLegalRepresentativeForm()
    {
        $this->celphone = auth()->user()->celphone ?? '';
        for ($i = 0; $i < 3; $i++) {
            $this->shareHolders[$i]['documentType'] = DocumentTypeEnum::ID;
        }
        $this->shareHolders;
        if (LegalRepresentative::where('user_id', Auth::id())->exists()) {
            $this->legalRepresentative = LegalRepresentative::where('user_id', Auth::id())->first();

            $this->name = $this->legalRepresentative->name;
            $this->firstLastname = $this->legalRepresentative->first_lastname;
            $this->secondLastname = $this->legalRepresentative->second_lastname;
            $this->documentType = $this->legalRepresentative->document_type;
            $this->documentNumber = $this->legalRepresentative->document_number;
            $this->nacionality = $this->legalRepresentative->country_id;
            $this->representationType = $this->legalRepresentative->representation_type;
            $this->isPEP = $this->legalRepresentative->is_PEP;
            $this->wifeIsPEP = $this->legalRepresentative->wife_is_PEP;
            $this->relativeIsPEP = $this->legalRepresentative->relative_is_PEP;
        }
    }

    public function rules(): array
    {
        $user = User::find(Auth::id());

        return [
            'shareHolders.*.name' => ['required_with:shareHolders.*.documentNumber'],
            'shareHolders.*.documentType' => ['required', Rule::enum(DocumentTypeEnum::class)],
            'shareHolders.*.documentNumber' => ['required_with:shareHolders.*.name', new DocumentNumberValidation($this->documentType)],
            'documentType' => ['required', Rule::enum(DocumentTypeEnum::class)->except([DocumentTypeEnum::TAX_NUMBER])],
            'documentNumber' => ['required', new DocumentNumberValidation($this->documentType)],
            'representationType' => ['required', Rule::enum(RepresentationTypeEnum::class)],
            'identityDocumentFront' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'identityDocumentBack' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'pdfPEP' => [Rule::excludeIf(! ($this->isPEP || $this->wifeIsPEP || $this->relativeIsPEP)), 'file', 'mimes:pdf'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'documentNumber' => 'Número de documento',
            'identityDocumentFront' => 'lado frontal',
            'identityDocumentBack' => 'lado reverso',
            'pdfPEP' => 'Documento PEP',
        ];
    }

    public function messages(): array
    {
        return [
            'shareHolders.*.name.required_with' => 'El nombre del accionista es obligatorio',
            'shareHolders.*.documentNumber.required_with' => 'El número de documento del accionista es obligatorio',
            'documentNumber.required' => 'El número de documento es obligatorio',
            'pdfPEP.file' => 'El documento PEP es obligatorio',
        ];
    }

    public function saveIdentityDocumentImages(): void
    {
        $managerFront = ImageManager::imagick();
        $imageFront = $managerFront->read($this->identityDocumentFront);
        if (! Storage::put('identity-documents/'.Auth::user()->id.'/front.png', (string) $imageFront->toPng())) {
            throw new \Exception('Error al guardar la imagen');
        }

        $managerBack = ImageManager::imagick();
        $imageBack = $managerBack->read($this->identityDocumentBack);
        if (! Storage::put('identity-documents/'.Auth::user()->id.'/back.png', (string) $imageBack->toPng())) {
            throw new \Exception('Error al guardar la imagen');
        }
    }

    public function savePdfPEP(): void
    {
        if (! ($this->isPEP || $this->wifeIsPEP || $this->relativeIsPEP)) {
            return;
        }

        if (! $this->pdfPEP) {
            return;
        }

        if (! $this->pdfPEP->storeAs('pdf-PEP/', Auth::user()->id.'.pdf', 's3')) {
            new \Exception('Error al guardar el pdf');
        }
    }
}
