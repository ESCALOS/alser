<?php

namespace App\Livewire\Account;

use App\Enums\DocumentTypeEnum;
use App\Livewire\Forms\Account\PersonalForm;
use App\Models\Country;
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

    public function save()
    {
        $this->form->save();

        $this->alert('success', 'Registro éxitoso', [
            'position' => 'center',
            'toast' => false,
            'timer' => '',
            'showConfirmButton' => true,
            'onConfirmed' => 'OK',
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
