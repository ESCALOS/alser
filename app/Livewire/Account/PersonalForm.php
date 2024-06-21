<?php

namespace App\Livewire\Account;

use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use App\Livewire\Forms\Account\PersonalForm as AccountPersonalForm;
use App\Models\Country;
use App\Models\PersonalAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class PersonalForm extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $documentTypes;

    public AccountPersonalForm $form;

    public User $user;

    public bool $verificationLinkSent = false;

    public function mount()
    {
        $this->documentTypes = DocumentTypeEnum::getChoicesExceptRuc();
        $this->form->setPersonalForm();
    }

    #[Computed(persist: true)]
    public function countries(): array
    {
        return Country::select('id', 'name')->get()->toArray();
    }

    public function sendEmailVerification()
    {
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
            $this->user = User::find(Auth::id());
            if (! $this->user->identity_document_status === IdentityDocumentStatusEnum::UPLOADED) {
                throw new \Exception('Datos en proceso de validación');
            }

            if (! $this->user->identity_document_status === IdentityDocumentStatusEnum::VALIDATED) {
                throw new \Exception('Datos validados');
            }

            $personaAccount = PersonalAccount::firstOrNew(['user_id' => Auth::id()]);
            $personaAccount->fill($this->form->getPersonalForm());

            $this->form->saveIdentityDocumentImages($personaAccount);
            $this->form->savePdfPEP($personaAccount);

            DB::transaction(function () use ($personaAccount) {

                $this->user->fill($this->form->only([
                    'name',
                    'document_type',
                    'document_number',
                    'celphone',
                ]));
                $this->user->identity_document_status = IdentityDocumentStatusEnum::UPLOADED;
                $this->user->save();
                $personaAccount->save();
            });
            $this->dispatch('refresh-personal');
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

    public function render()
    {
        return view('livewire.account.personal-form');
    }
}
