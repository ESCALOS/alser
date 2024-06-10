<?php

namespace App\Livewire\Forms\Account;

use App\Enums\DocumentTypeEnum;
use App\Models\PersonalAccount;
use App\Rules\DocumentNumberValidation;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonalForm extends Form
{
    public ?PersonalAccount $personalAccount;

    #[Validate('required', as: 'Nombre')]
    public ?string $name = '';

    #[Validate('required', as: 'Primer Apellido')]
    public ?string $first_lastname = '';

    #[Validate('required', as: 'Segundo Apellido')]
    public ?string $second_lastname = '';

    #[Validate]
    public DocumentTypeEnum $document_type = DocumentTypeEnum::ID;

    #[Validate]
    public ?string $document_number = '';

    #[Validate('required|digits:9', as: 'Celular')]
    public ?string $celphone = '';

    #[Validate('required|exists:countries,id', as: 'Nacionalidad')]
    public ?int $nacionality = 140;

    #[Validate]
    public $identity_document_front;

    #[Validate]
    public $identity_document_back;

    #[Validate('required|boolean')]
    public bool $is_PEP = false;

    #[Validate('required|boolean')]
    public bool $wife_is_PEP = false;

    #[Validate('required|boolean')]
    public bool $relative_is_PEP = false;

    #[Validate]
    public $pdf_PEP;

    public function setPersonalForm()
    {
        $this->name = auth()->user()->name;
        $this->document_type = auth()->user()->document_type ?? DocumentTypeEnum::ID;
        $this->document_number = auth()->user()->document_number ?? '';
        $this->celphone = auth()->user()->celphone ?? '';
        if (PersonalAccount::where('user_id', Auth::id())->exists()) {
            $this->personalAccount = PersonalAccount::where('user_id', Auth::id())->first();
            $this->first_lastname = $this->personalAccount->first_lastname;
            $this->second_lastname = $this->personalAccount->second_lastname;
            $this->nacionality = $this->personalAccount->country_id;
            $this->is_PEP = $this->personalAccount->is_PEP;
            $this->wife_is_PEP = $this->personalAccount->wife_is_PEP;
            $this->relative_is_PEP = $this->personalAccount->relative_is_PEP;
        }
    }

    public function getPersonalForm(): array
    {
        return [
            'user_id' => Auth::id(),
            'first_lastname' => $this->first_lastname,
            'second_lastname' => $this->second_lastname,
            'country_id' => $this->nacionality,
            'is_PEP' => $this->is_PEP,
            'wife_is_PEP' => $this->wife_is_PEP,
            'relative_is_PEP' => $this->relative_is_PEP,
        ];
    }

    public function rules(): array
    {
        return [
            'document_type' => ['required', Rule::enum(DocumentTypeEnum::class)->except([DocumentTypeEnum::TAX_NUMBER])],
            'document_number' => ['required', Rule::unique('users')->ignore(Auth::id()), new DocumentNumberValidation($this->document_type)],
            'identity_document_front' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'identity_document_back' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'pdf_PEP' => [Rule::excludeIf(! ($this->is_PEP || $this->wife_is_PEP || $this->relative_is_PEP)), 'file', 'mimes:pdf'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'document_number' => 'Número de documento',
            'identity_document_front' => 'lado frontal',
            'identity_document_back' => 'lado reverso',
            'pdf_PEP' => 'Documento PEP',
        ];
    }

    public function messages(): array
    {
        return [
            'document_number.required' => 'El número de documento es obligatorio',
            'pdf_PEP.file' => 'El documento PEP es obligatorio',
        ];
    }

    public function saveIdentityDocumentImages(): void
    {
        $managerFront = ImageManager::imagick();
        $imageFront = $managerFront->read($this->identity_document_front);
        if (! Storage::put('identity-documents/'.Auth::user()->id.'/front.png', (string) $imageFront->toPng())) {
            throw new Exception('Error al guardar la imagen');
        }

        $managerBack = ImageManager::imagick();
        $imageBack = $managerBack->read($this->identity_document_back);
        if (! Storage::put('identity-documents/'.Auth::user()->id.'/back.png', (string) $imageBack->toPng())) {
            throw new Exception('Error al guardar la imagen');
        }
    }

    public function savePdfPEP(): void
    {
        if (! ($this->is_PEP || $this->wife_is_PEP || $this->relative_is_PEP)) {
            return;
        }

        if (! $this->pdf_PEP->storeAs('pdf-PEP/', Auth::user()->id.'.pdf', 's3')) {
            throw new Exception('Error al guardar el pdf');
        }
    }
}
