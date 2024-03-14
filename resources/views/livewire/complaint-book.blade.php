<div>
    <x-mary-form wire:submit='save'>
        <h1 class="py-6 text-3xl font-bold text-center text-home-primary md:text-4xl">
            Datos Personales
        </h1>
        <div class="grid grid-cols-1 gap-4"
            :class="$wire.form.provinceId ? 'md:grid-cols-3' : ($wire.form.departmentId ? 'md:grid-cols-2' : 'md:grid-cols-1')">
            <x-mary-choices-offline label="Departamento" wire:model.live="form.departmentId" :options="$this->departments" single
                searchable no-result-text="Departamento no encontrado." />
            <div x-show="$wire.form.departmentId != null" x-transition.in.duration.300ms>
                <x-mary-choices-offline label="Provincias" wire:model.live="form.provinceId" :options="$provincesFound" single
                    searchable no-result-text="Provincia no encontrada." />
            </div>
            <div x-show="$wire.form.provinceId != null" x-transition.in.duration.300ms>
                <x-mary-choices-offline label="Distritos" wire:model.live="form.districtId" :options="$districtsFound" single
                    searchable no-result-text="Distrito no encontrado." />
            </div>
        </div>
        <x-slot:actions>
            <x-mary-button label="Enviar" class="btn-primary" type="submit" spinner="save" />
        </x-slot>
    </x-mary-form>
</div>
