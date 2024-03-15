<div>
    <x-mary-form wire:submit='save'>
        <h1 class="py-6 text-3xl font-bold text-center text-home-primary md:text-4xl">
            Datos Personales
        </h1>
        <!--Documento -->
        <div class="flex flex-col md:flex-row md:space-x-2">
            <div class="w-full md:w-1/3">
                <x-mary-choices-offline label="Tipo de Documento" wire:model.blur='form.documentType' :options="$documentTypes"
                    single required />
            </div>
            <div class="w-full mt-2 md:w-2/3 md:mt-0">
                <x-mary-input label="Número de documento" type="text"
                    x-mask:dynamic="(value) => {
                        console.log($wire.form.documentType);
                        switch ($wire.form.documentType) {
                            case 1:
                                return '99999999';
                            case 2:
                                if (value.startsWith('1')) {
                                    return '10999999999';
                                }
                                if(value.startsWith('2')) {
                                    return '20999999999'
                                }
                                return 'a';
                            case 3:
                            case 4:
                                return '999999999999';
                            default:
                                return 'a';
                        }
                }"
                    wire:model="form.documentNumber" clearable required />
            </div>
        </div>
        <!--Nombres-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-x-2 md:space-y-0">
            <div class="w-full md:w-1/4">
                <x-mary-input label="Apellido paterno" wire:model='form.lastNameFather' required />
            </div>
            <div class="w-full md:w-1/4">
                <x-mary-input label="Apellido materno" wire:model='form.lastNameMother' required />
            </div>
            <div class="w-full md:w-2/4">
                <x-mary-input label="Nombres" wire:model='form.name' required />
            </div>
        </div>
        <!--Dirección-->
        <div class="flex flex-col md:flex-row md:space-x-2">
            <div class="w-full md:w-1/2">
                <x-mary-input label="Dirección" wire:model='form.street' hint="Av. / Calle / Jr." required />
            </div>
            <div class="flex w-full mt-2 space-x-2 md:w-1/2 md:mt-0">
                <div class="w-1/3">
                    <x-mary-input label="Nro/Mz" wire:model='form.streetNumber' />
                </div>
                <div class="w-1/3">
                    <x-mary-input label="Lote" wire:model='form.streetLot' />
                </div>
                <div class="w-1/3">
                    <x-mary-input label="Dpto" wire:model='form.streetDpto' />
                </div>
            </div>
        </div>
        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
            <div class="w-1/2">
                <x-mary-input label="Urbanización" wire:model='form.urbanization' />
            </div>
            <div class="w-1/2">
                <x-mary-input label="Referencia" wire:model='form.reference' />
            </div>
        </div>
        <!--Ubicación-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-x-2 md:space-y-0">
            <div class="transition-all ease-in-out"
                :class="$wire.provinceId ? 'md:w-1/3 w-full' : ($wire.departmentId ? 'md:w-1/2 w-full' :
                    'w-full')">
                <x-mary-choices-offline label="Departamento" wire:model.live="departmentId" :options="$this->departments" single
                    searchable no-result-text="Departamento no encontrado." required />
            </div>
            <div x-show="$wire.departmentId" class="transition-all ease-out"
                :class="!$wire.departmentId ? 'opacity-0' : ($wire.provinceId ? 'md:w-1/3 w-full opacity-100' :
                    'md:w-1/2 w-full')">
                <x-mary-choices-offline label="Provincia" wire:model.live="provinceId" :options="$provincesFound" single
                    searchable no-result-text="Provincia no encontrada." required />
            </div>
            <div x-show="$wire.provinceId" class="w-full transition-all ease-out md:w-1/3"
                :class="$wire.departmentId ? 'opacity-100' : 'opacity-0'">
                <x-mary-choices-offline label="Distrito" wire:model.live="form.districtId" :options="$districtsFound" single
                    searchable no-result-text="Distrito no encontrado." required />
            </div>
        </div>
        <!--Medio de Respuesta-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
            <div class="w-1/2">
                <x-mary-input label="Teléfono | Celular | Correo electrónico" wire:model='form.reference' required />
            </div>
            <div class="w-1/2">
                <x-mary-choices-offline option-label="id" label="Medio de Respuesta"
                    wire:model.live="form.responseMedium" :options="$responseMediums" single required />
            </div>
        </div>
        <x-slot:actions>
            <x-mary-button label="Enviar" class="text-white btn-primary " type="submit" spinner="save" />
        </x-slot>
    </x-mary-form>
    <!--Forzar compilacion del estilo max-h-64-->
    <div class="max-h-64"></div>
</div>
