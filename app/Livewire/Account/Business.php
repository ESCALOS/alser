<?php

namespace App\Livewire\Account;

use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use App\Enums\RepresentationTypeEnum;
use App\Livewire\Forms\Account\LegalRepresentativeForm;
use App\Models\Country;
use App\Models\LegalRepresentative;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Business extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $documentTypes;

    public LegalRepresentativeForm $form;

    public array $representationTypes;

    public function mount()
    {
        $this->documentTypes = DocumentTypeEnum::getChoicesExceptRuc();
        $this->representationTypes = RepresentationTypeEnum::getChoices();
        $this->form->setLegalRepresentativeForm();

    }

    #[Computed(persist: true)]
    public function countries(): array
    {
        return Country::select('id', 'name')->get()->toArray();
    }

    #[Computed]
    public function isIdentityDocumentRequired(): bool
    {
        return $this->form->identityDocumentStatus === IdentityDocumentStatusEnum::PENDING || $this->form->identityDocumentStatus === IdentityDocumentStatusEnum::REJECTED;
    }

    public function save()
    {
        $type = 'success';
        $message = 'Datos guardados';
        try {
            $this->form->resetValidation();
            $this->form->setIdentityDocumentStatus();
            $this->form->validate();

            $legalRepresentative = LegalRepresentative::firstOrNew(['user_id' => Auth::user()->id]);
            $legalRepresentative->name = $this->form->name;
            $legalRepresentative->first_lastname = $this->form->firstLastname;
            $legalRepresentative->second_lastname = $this->form->secondLastname;
            $legalRepresentative->document_type = $this->form->documentType;
            $legalRepresentative->document_number = $this->form->documentNumber;
            $legalRepresentative->country_id = $this->form->nacionality;
            $legalRepresentative->is_PEP = $this->form->isPEP;
            $legalRepresentative->wife_is_PEP = $this->form->wifeIsPEP;
            $legalRepresentative->relative_is_PEP = $this->form->relativeIsPEP;
            $legalRepresentative->representation_type = $this->form->representationType;

            $this->form->saveIdentityDocumentImages($legalRepresentative);
            $this->form->savePdfPEP($legalRepresentative);

            DB::transaction(function () use ($legalRepresentative) {
                $user = User::find(Auth::user()->id);
                $user->celphone = $this->form->celphone;
                $user->save();
                $legalRepresentative->save();
            });

            $this->form->identityDocumentStatus = IdentityDocumentStatusEnum::UPLOADED;
            $this->form->legalRepresentative = $legalRepresentative;

        } catch (ValidationException $ex) {
            $type = 'error';
            $message = '';
            foreach ($ex->errors() as $field => $errorMessage) {
                $this->addError($field, $errorMessage);
                if ($message === '') {
                    $message = $errorMessage[0];
                }

            }
        } catch (\Exception $ex) {
            $type = 'error';
            $message = $ex->getMessage();
        }

        $this->alert($type, $message, [
            'position' => 'center',
            'toast' => false,
            'timer' => null,
            'showConfirmButton' => true,
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
        return view('livewire.account.business');
    }
}
