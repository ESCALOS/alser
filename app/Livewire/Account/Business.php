<?php

namespace App\Livewire\Account;

use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use App\Enums\RepresentationTypeEnum;
use App\Livewire\Forms\Account\LegalRepresentativeForm;
use App\Models\Country;
use App\Models\LegalRepresentative;
use App\Models\ShareHolder;
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

    public $documentTypesExceptRuc;

    public LegalRepresentativeForm $form;

    public array $representationTypes;

    public bool $verificationLinkSent = false;

    public function mount()
    {
        $this->documentTypes = DocumentTypeEnum::getChoices();
        $this->documentTypesExceptRuc = DocumentTypeEnum::getChoicesExceptRuc();
        $this->representationTypes = RepresentationTypeEnum::getChoices();
        $this->form->setLegalRepresentativeForm($this->user);

    }

    #[Computed]
    public function user(): User
    {
        return User::find(Auth::id());
    }

    #[Computed(persist: true)]
    public function countries(): array
    {
        return Country::select('id', 'name')->get()->toArray();
    }

    public function sendEmailVerification()
    {
        $this->user->forceFill([
            'email_verified_at' => null,
        ])->save();

        $this->user->sendEmailVerificationNotification();
        $this->verificationLinkSent = true;
    }

    public function save()
    {
        $type = 'success';
        $message = 'Datos guardados';
        try {
            $this->form->resetValidation();
            $this->form->validate();
            unset($this->user);

            if (! $this->user->identity_document_status === IdentityDocumentStatusEnum::UPLOADED) {
                throw new \Exception('Datos en proceso de validación');
            }

            if (! $this->user->identity_document_status === IdentityDocumentStatusEnum::VALIDATED) {
                throw new \Exception('Datos validados');
            }

            $legalRepresentative = LegalRepresentative::firstOrNew(['user_id' => Auth::id()]);
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

            $this->form->saveIdentityDocumentImages();
            $this->form->savePdfPEP();

            DB::transaction(function () use ($legalRepresentative) {
                $this->user->celphone = $this->form->celphone;
                $this->user->identity_document_status = IdentityDocumentStatusEnum::UPLOADED;
                ShareHolder::where('user_id', $this->user->id)->delete();
                foreach ($this->form->shareHolders as $input) {
                    if (! empty($input['name'])) {
                        ShareHolder::create([
                            'fullname' => $input['name'],
                            'document_type' => $input['documentType'],
                            'document_number' => $input['documentNumber'],
                            'user_id' => $this->user->id,
                        ]);
                    }
                }

                $this->user->save();
                $legalRepresentative->save();
            });

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
