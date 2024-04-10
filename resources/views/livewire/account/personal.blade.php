<div>
    <x-mary-card title="Datos del Perfil" shadow>
        <div class="space-y-4">
            <x-mary-input label="{{ __('Email') }}" class="rounded-lg" value="{{ auth()->user()->email }}" disabled />
            <p class="pt-2 text-pretty">Por resolución de la SBS, necesitas llenar los siguientes
                datos.
            </p>
            <x-mary-alert icon="o-exclamation-circle" class="text-white bg-sky-600">
                <span class="font-bold text-md text-pretty">Tus nombres y apellidos deben ser iguales a los que
                    figuran en tu documento de identidad.</span>
            </x-mary-alert>
            <x-mary-input label="Nombres" wire:model='form.name' />
            <div class="grid grid-cols-2 gap-3">
                <x-mary-input label="Primer Apellido" wire:model='form.surname' />
                <x-mary-input label="Segundo Apellido" wire:model='form.second_surname' />
            </div>
            <div class="grid gap-3 lg:grid-cols-2">
                <x-mary-choices-offline label="Tipo de Documento" :options="$documentTypes" wire:model='form.document_type'
                    single />
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

                <x-mary-input label="Celular" wire:model='form.celphone' x-mask='999999999' />
            </div>
            <div class="grid grid-cols-2 gap-3">
                <x-mary-file wire:model="front" accept="image/*" change-text="Cambiar">
                    <div class="h-52">
                        <div class="h-32 rounded-t-md bg-violet-100">
                            <h3 class="pt-4 pb-1 text-lg font-semibold text-center text-violet-400">Lado Frontal</h3>
                            <img src="{{ asset('storage/images/document_front.png') }}" class="h-24 m-auto" />
                        </div>
                        <div class="h-20 px-4 pt-4 align-middle cursor-pointer rounded-b-md bg-violet-300">
                            <div
                                class="content-center w-full h-12 font-semibold text-center bg-white rounded-sm text-violet-500">
                                <x-mary-icon name="m-camera" />
                                <span>Foto del documento</span>
                            </div>
                        </div>
                    </div>
                </x-mary-file>
                <x-mary-file wire:model="back" accept="image/*" change-text="Cambiar">
                    <div class="h-52">
                        <div class="h-32 rounded-t-md bg-violet-100">
                            <h3 class="pt-4 pb-1 text-lg font-semibold text-center text-violet-400">Lado Rerverso</h3>
                            <img src="{{ asset('storage/images/document_back.png') }}" class="h-24 m-auto" />
                        </div>
                        <div class="h-20 px-4 pt-4 align-middle cursor-pointer rounded-b-md bg-violet-300">
                            <div
                                class="content-center w-full h-12 font-semibold text-center bg-white rounded-sm text-violet-500">
                                <x-mary-icon name="m-camera" />
                                <span>Foto del documento</span>
                            </div>
                        </div>
                    </div>
                </x-mary-file>
            </div>
            <x-mary-toggle label="Left" wire:model="form.is_PEP" />
        </div>
    </x-mary-card>
</div>
