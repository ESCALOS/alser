<div>
    <x-mary-card title="Datos del Perfil" shadow>
        <div class="space-y-4">
            <x-mary-input inline label="{{ __('Email') }}" class="rounded-lg" value="{{ auth()->user()->email }}"
                readonly />
            <p class="pt-2 text-pretty">Por resolución de la SBS, necesitas llenar los siguientes
                datos.
            </p>
            <x-mary-alert icon="o-exclamation-circle" class="text-white bg-sky-600">
                <span class="font-bold text-md text-pretty">Tus nombres y apellidos deben ser iguales a los que
                    figuran en tu documento de identidad.</span>
            </x-mary-alert>
            <x-mary-input inline label="Nombres" wire:model='form.name' />
            <div class="grid grid-cols-2 gap-3">
                <x-mary-input inline label="Primer Apellido" wire:model='form.surname' />
                <x-mary-input inline label="Segundo Apellido" wire:model='form.second_surname' />
            </div>
            <div class="grid gap-3 md:grid-cols-3">
                <x-mary-select label="Tipo de Documento" :options="$documentTypes" wire:model='form.document_type' />
                <x-mary-input label="Número de documento" wire:model='form.document_number'
                    x-mask:dynamic="(value) => {
                    if ($wire.form.document_type == 1) {
                        return '99999999';
                    }else {
                        return '************';
                    }
                }" />
                <x-mary-choices-offline label="Nacionalidad" wire:model='form.nacionality' :options="$this->countries" single
                    searchable />
            </div>
        </div>
    </x-mary-card>
</div>
