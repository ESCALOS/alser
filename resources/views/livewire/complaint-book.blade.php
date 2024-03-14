<div>
    <x-mary-form wire:submit='save'>
        <h1 class="py-6 text-3xl font-bold text-center text-home-primary md:text-4xl">
            Datos Personales
        </h1>
        <div class="flex" x-data="{ isDepartmentSelected: $wire.entangle('departmentId') }">
            <div class="transition-all ease-in-out"
                :class="$wire.provinceId ? 'w-1/3' : (isDepartmentSelected ? 'w-1/2 pr-2' :
                    'w-full')">
                <x-mary-choices-offline label="Departamento" wire:model.live="departmentId" :options="$this->departments" single
                    searchable no-result-text="Departamento no encontrado." />
            </div>
            <div x-show="$wire.departmentId" class="transition-all ease-out"
                :class="!$wire.departmentId ? 'opacity-0' : ($wire.provinceId ? 'w-1/3 px-2 opacity-100' :
                    'w-1/2')">
                <x-mary-choices-offline label="Provincia" wire:model.live="provinceId" :options="$provincesFound" single
                    searchable no-result-text="Provincia no encontrada." />
            </div>
            <div x-show="$wire.provinceId" class="w-1/3 transition-all ease-out"
                :class="$wire.departmentId ? 'opacity-100' : 'opacity-0'">
                <x-mary-choices-offline label="Distrito" wire:model="form.districtId" :options="$districtsFound" single
                    searchable no-result-text="Distrito no encontrado." />
            </div>
        </div>
        <x-slot:actions>
            <x-mary-button label="Enviar" class="btn-primary" type="submit" spinner="save" />
        </x-slot>
    </x-mary-form>
    <!--Forzar compilacion del estilo max-h-64-->
    <div class="max-h-64"></div>
</div>
