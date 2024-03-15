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
        <!--Apoderado-->
        <div>
            <x-mary-input label="Datos del apoderado (En caso de ser menor de Edad)" wire:model='form.representative'
                placeholder="Padre o Madre" />
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
        <!--Dirección-->
        <div class="flex flex-col md:flex-row md:space-x-2">
            <div class="w-full md:w-1/2">
                <x-mary-input label="Dirección" wire:model='form.street' placeholder="Av. / Calle / Jr." required />
            </div>
            <div class="flex w-full mt-2 space-x-2 md:w-1/2 md:mt-0">
                <div class="w-1/3">
                    <x-mary-input label="Nro/Mz" wire:model='form.streetNumber' />
                </div>
                <div class="w-1/3">
                    <x-mary-input label="Lote" wire:model='form.streetLot' />
                </div>
                <div class="w-1/3">
                    <x-mary-input label="Nro Dpto" wire:model='form.streetDpto' />
                </div>
            </div>
        </div>
        <!--Urbanizacion-->
        <div>
            <x-mary-input label="Urbanización" wire:model='form.urbanization' />
        </div>
        <!--Referencia-->
        <div>
            <x-mary-input label="Referencia" wire:model='form.reference' />
        </div>
        <!--Medio de Respuesta-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
            <div class="w-full md:w-1/3">
                <x-mary-input label="Teléfono" wire:model='form.telephone' x-mask="(+99) 999999" required
                    placeholder="Cód. Provincia + Nro Teléfono" />
            </div>
            <div class="w-full md:w-1/3">
                <x-mary-input label="Celular" wire:model='form.celphone' required x-mask="999999999" />
            </div>
            <div class="w-full md:w-1/3">
                <x-mary-input label="Correo electrónico" type="email" wire:model='form.email' placeholder="___@___"
                    required />
            </div>
        </div>
        <div>
            <x-mary-choices-offline option-value="name" label="Medio de Respuesta" wire:model="form.responseMedium"
                :options="$responseMediums" single required />
        </div>
        <h1 class="py-6 text-3xl font-bold text-center text-home-primary md:text-4xl">
            Datos de la queja o reclamo
        </h1>
        <div>
            <x-mary-radio label="Motivo de contacto" :options="$reasons" option-value="name" wire:model="form.reason"
                class="w-full" />
        </div>
        <div x-show="$wire.form.reason != 'Queja'">
            <div class="pt-2 pb-4 text-sm font-bold">
                <label for="hiredService">Servicio contratado</label>
            </div>
            <div class="space-y-2">
                <div @click="$wire.form.hiredService = 'Cambio de moneda online'" class="cursor-pointer">
                    <input type="radio" name="service" wire:model='form.hiredService' value="Cambio de moneda online">
                    Cambio de moneda online
                </div>
                <div @click="$wire.form.hiredService = 'Otros'" class="cursor-pointer">
                    <input type="radio" name="service" wire:model='form.hiredService' value="Otros"> Otros
                </div>
            </div>
            <div x-show="$wire.form.hiredService == 'Cambio de moneda online'" x-transition class="pt-5">
                <div class="flex space-x-2">
                    <div class="w-1/3">
                        <x-mary-choices-offline label="Tipo de moneda" wire:model.live="form.hiredServiceCurrencyType"
                            :options="$currencies" single />
                    </div>
                    <div class="w-1/3">
                        <x-mary-input label="Código de operación" wire:model='form.hiredServiceOperationCode'
                            placeholder="000000000" x-mask="999999999" prefix="ALS-" />
                    </div>
                    <div class="w-1/3">
                        <x-mary-input label="Monto a reclamar" wire:model='form.hiredServiceAmountToClaim'
                            x-mask:dynamic="$money($input, '.', ',')"
                            prefix="{{ $form->hiredServiceCurrencyType == 1 ? 'S/.' : '$ ' }}" />
                    </div>
                </div>
            </div>
            <div x-show="$wire.form.hiredService=='Otros'" x-transition>
                <x-mary-textarea label="Ingrese su reclamo" wire:model="form.reasonDescription"
                    placeholder="Ingrese su reclamo lo más descriptivo posible..." rows="5" />
            </div>
        </div>

        <div x-show="$wire.form.reason == 'Queja'">
            <x-mary-textarea wire:model="form.reasonDescription"
                placeholder="Ingrese su queja lo más descriptivo posible..." rows="5" inline />
        </div>
        <p class="text-sm text-justify text-gray-700">
            *Si tu reclamo es sobre una operación que realizaste en alsercambio.com, indica el código de esta (puedes
            encontrarlo en la sección "Historial de operaciones" en tu cuenta registrada en alsercambio.com)
        </p>
        <x-slot:actions>
            <x-mary-button label="Enviar documento a Libro de Reclamaciones" class="text-white btn-primary "
                type="submit" spinner="save" />
        </x-slot:actions>

    </x-mary-form>
    <!--Forzar compilacion de estilos-->
    <div class="max-h-64"></div>
</div>
