<?php

namespace App\Livewire\Account;

use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use App\Filament\Resources\UserResource;
use App\Livewire\Forms\Account\PersonalForm;
use App\Models\Country;
use App\Models\PersonalAccount;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
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

    public bool $verificationLinkSent = false;

    public function mount()
    {
        $this->documentTypes = DocumentTypeEnum::getChoicesExceptRuc();
        $this->form->setPersonalForm();
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

            $personaAccount = PersonalAccount::firstOrNew(['user_id' => Auth::id()]);
            $personaAccount->user_id = $this->user->id;
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
            $admins = User::where('is_admin', true)->get();
            Notification::make()
                ->title('Nuevo usuario a validar')
                ->info()
                ->body('El usuario <strong>'.$this->user->name.'</strong> se ha registrado.')
                ->actions([
                    Action::make('view')
                        ->label('Ver')
                        ->url(UserResource::getUrl('view', ['record' => $this->user]))
                        ->markAsRead(),
                ])
                ->sendToDatabase($admins);
            $this->form->personalAccount = $personaAccount;
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
        return view('livewire.account.personal');
    }
}
