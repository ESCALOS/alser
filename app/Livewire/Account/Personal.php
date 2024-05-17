<?php

namespace App\Livewire\Account;

use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use App\Livewire\Forms\Account\PersonalForm;
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

class Personal extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $documentTypes;

    public PersonalForm $form;

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

    #[Computed]
    public function isIdentityDocumentRequired(): bool
    {
        return $this->form->identity_document_status === IdentityDocumentStatusEnum::PENDING || $this->form->identity_document_status === IdentityDocumentStatusEnum::REJECTED;
    }

    public function save()
    {
        $type = 'success';
        $message = 'Datos guardados';
        try {
            $this->form->resetValidation();
            $this->form->setIdentityDocumentStatus();
            $this->form->validate();

            $personaAccount = PersonalAccount::firstOrNew(['user_id' => Auth::user()->id]);
            $personaAccount->user_id = Auth::user()->id;
            $personaAccount->fill($this->form->getPersonalForm());

            $this->form->saveIdentityDocumentImages($personaAccount);
            $this->form->savePdfPEP($personaAccount);
            $personaAccount->identity_document_status = IdentityDocumentStatusEnum::UPLOADED;

            DB::transaction(function () use ($personaAccount) {
                $user = User::find(Auth::user()->id);
                $user->fill($this->form->only([
                    'name',
                    'document_type',
                    'document_number',
                    'celphone',
                ]))->save();
                $personaAccount->save();
            });

            $this->form->identity_document_status = IdentityDocumentStatusEnum::UPLOADED;
            $this->form->personalAccount = $personaAccount;

        } catch (ValidationException $ex) {
            $type = 'error';
            $message = $ex->getMessage();
            foreach ($ex->errors() as $field => $errorMessage) {
                $this->addError($field, $errorMessage);
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
        return view('livewire.account.personal');
    }
}
