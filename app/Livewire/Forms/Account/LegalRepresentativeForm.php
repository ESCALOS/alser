<?php

namespace App\Livewire\Forms\Account;

use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use App\Enums\RepresentationTypeEnum;
use App\Models\LegalRepresentative;
use App\Rules\DocumentNumberValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Locked;
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

    #[Locked]
    public IdentityDocumentStatusEnum $identityDocumentStatus = IdentityDocumentStatusEnum::PENDING;

    public function setLegalRepresentativeForm()
    {
        $this->celphone = Auth::user()->celphone ?? '';

        for ($i = 0; $i < 3; $i++) {
            $this->shareHolders[$i]['documentType'] = DocumentTypeEnum::ID;
        }
        $this->shareHolders;
        if (LegalRepresentative::where('user_id', Auth::user()->id)->exists()) {
            $this->legalRepresentative = LegalRepresentative::where('user_id', Auth::user()->id)->first();

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
            $this->identityDocumentStatus = $this->legalRepresentative->identity_document_status;
        }
    }

    public function rules(): array
    {
        return [
            'shareHolders.*.name' => ['required_with:shareHolders.*.documentNumber'],
            'shareHolders.*.documentType' => ['required', Rule::enum(DocumentTypeEnum::class)],
            'shareHolders.*.documentNumber' => ['required_with:shareHolders.*.name', new DocumentNumberValidation($this->documentType)],
            'documentType' => ['required', Rule::enum(DocumentTypeEnum::class)->except([DocumentTypeEnum::TAX_NUMBER])],
            'documentNumber' => ['required', new DocumentNumberValidation($this->documentType)],
            'representationType' => ['required', Rule::enum(RepresentationTypeEnum::class)],
            'identityDocumentFront' => [Rule::excludeIf(! $this->isIdentityDocumentRequired()), 'required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'identityDocumentBack' => [Rule::excludeIf(! $this->isIdentityDocumentRequired()), 'required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
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

    public function saveIdentityDocumentImages(LegalRepresentative $legalRepresentative): void
    {
        if ($legalRepresentative->isIdentityDocumentRequired()) {
            try {
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
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage();
                throw new \Exception($errorMessage);
            }
        }
    }

    public function savePdfPEP($legalRepresentative): void
    {
        if (! $legalRepresentative->isIdentityDocumentRequired()) {
            return;
        }
        if (! ($this->isPEP || $this->wifeIsPEP || $this->relativeIsPEP)) {
            return;
        }

        if (! $this->pdfPEP->storeAs('pdf-PEP/', Auth::user()->id.'.pdf', 's3')) {
            new \Exception('Error al guardar el pdf');
        }
    }

    public function setIdentityDocumentStatus(): void
    {
        $this->identityDocumentStatus = LegalRepresentative::where('user_id', Auth::user()->id)->first()->identity_document_status ?? IdentityDocumentStatusEnum::PENDING;
    }

    public function isIdentityDocumentRequired(): bool
    {
        return $this->identityDocumentStatus === IdentityDocumentStatusEnum::PENDING || $this->identityDocumentStatus === IdentityDocumentStatusEnum::REJECTED;
    }
}
