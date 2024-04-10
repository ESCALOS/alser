<?php

namespace App\Livewire\Account;

use App\Enums\DocumentTypeEnum;
use App\Livewire\Forms\Account\PersonalForm;
use App\Models\Country;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class Personal extends Component
{
    use WithFileUploads;

    public $documentTypes;

    public PersonalForm $form;

    public $front;

    public $back;

    public function mount()
    {
        $this->front['name'] = 'hola';
        $this->documentTypes = DocumentTypeEnum::getChoicesExceptRuc();
    }

    #[Computed(persist: true)]
    public function countries(): array
    {
        return Country::select('id', 'name')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.account.personal');
    }
}
