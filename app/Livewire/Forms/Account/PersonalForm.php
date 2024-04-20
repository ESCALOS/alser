<?php

namespace App\Livewire\Forms\Account;

use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use App\Models\PersonalAccount;
use App\Models\User;
use App\Rules\DocumentNumberValidation;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonalForm extends Form
{
    #[Validate('required', as: 'Nombre')]
    public ?string $name = '';

    #[Validate('required', as: 'Primer Apellido')]
    public ?string $first_surname = '';

    #[Validate('required', as: 'Segundo Apellido')]
    public ?string $second_surname = '';

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

    #[Locked]
    public IdentityDocumentStatusEnum $identity_document_status = IdentityDocumentStatusEnum::PENDING;

    public function setPersonalForm()
    {
        $this->name = Auth::user()->name;
        $this->document_type = Auth::user()->document_type ?? DocumentTypeEnum::ID;
        $this->document_number = Auth::user()->document_number ?? '';
        $this->celphone = Auth::user()->celphone ?? '';
        if (PersonalAccount::where('user_id', Auth::user()->id)->exists()) {
            $personalAccount = PersonalAccount::where('user_id', Auth::user()->id)->first();
            $this->first_surname = $personalAccount->first_surname;
            $this->second_surname = $personalAccount->second_surname;
            $this->nacionality = $personalAccount->nacionality;
            $this->is_PEP = $personalAccount->is_PEP;
            $this->wife_is_PEP = $personalAccount->wife_is_PEP;
            $this->relative_is_PEP = $personalAccount->relative_is_PEP;
            $this->identity_document_status = $personalAccount->identity_document ?? IdentityDocumentStatusEnum::PENDING;
        }
    }

    public function rules(): array
    {
        return [
            'document_type' => ['required', Rule::enum(DocumentTypeEnum::class)->except([DocumentTypeEnum::TAX_NUMBER])],
            'document_number' => ['required', new DocumentNumberValidation($this->document_type)],
            'identity_document_front' => [Rule::excludeIf(! $this->isIdentityDocumentRequired()), 'required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'identity_document_back' => [Rule::excludeIf(! $this->isIdentityDocumentRequired()), 'required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'document_number' => 'Número de documento',
            'identity_document_front' => 'lado frontal',
            'identity_document_back' => 'lado reverso',
        ];
    }

    public function messages(): array
    {
        return [
            'document_number.required' => 'El número de documento es obligatorio',
        ];
    }

    public function save(): void
    {
        $this->setIdentityDocumentStatus();
        $this->validate();
        DB::transaction(function () {
            $user = User::find(Auth::user()->id);
            $user->name = $this->name;
            $user->document_type = $this->document_type;
            $user->document_number = $this->document_number;
            $user->celphone = $this->celphone;

            $data = [
                'first_surname' => $this->first_surname,
                'second_surname' => $this->second_surname,
                'nacionality' => $this->nacionality,
                'is_PEP' => $this->is_PEP,
                'wife_is_PEP' => $this->wife_is_PEP,
                'relative_is_PEP' => $this->relative_is_PEP,
            ];

            if ($this->isIdentityDocumentRequired()) {
                $this->saveIdentityDocumentImages();
                $this->identity_document_status = IdentityDocumentStatusEnum::UPLOADED;
                $data['identity_document'] = $this->identity_document_status;
            } else {
                new Exception('La imagen no es requerida');
            }

            $personalAccount = PersonalAccount::updateOrCreate(
                ['user_id' => $user->id],
                $data
            );

            $user->save();
            $personalAccount->save();
        });
    }

    private function saveIdentityDocumentImages(): void
    {
        $managerFront = ImageManager::imagick();
        $imageFront = $managerFront
            ->read($this->identity_document_front);
        if (! Storage::put('identity-documents/personal-account/'.Auth::user()->id.'/front.png', (string) $imageFront->toPng())) {
            new Exception('Error al guardar la imagen');
        }

        $managerBack = ImageManager::imagick();
        $imageBack = $managerBack
            ->read($this->identity_document_back);
        if (! Storage::put('identity-documents/personal-account/'.Auth::user()->id.'/back.png', (string) $imageBack->toPng())) {
            new Exception('Error al guardar la imagen');
        }
    }

    private function setIdentityDocumentStatus(): void
    {
        $this->identity_document_status = PersonalAccount::where('user_id', Auth::user()->id)->first()->identity_document ?? IdentityDocumentStatusEnum::PENDING;
    }

    public function isIdentityDocumentRequired(): bool
    {
        return $this->identity_document_status === IdentityDocumentStatusEnum::PENDING || $this->identity_document_status === IdentityDocumentStatusEnum::REJECTED;
    }
}
