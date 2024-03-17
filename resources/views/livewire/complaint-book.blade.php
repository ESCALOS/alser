<div>
    <x-mary-form wire:submit.prevent='save'>
        <h1 class="py-6 text-3xl font-bold text-center text-home-primary md:text-4xl">
            Datos Personales
        </h1>
        <!--Documento -->
        <div class="flex flex-col md:flex-row md:space-x-2">
            <div id="documentType" class="w-full md:w-1/3">
                <x-mary-choices-offline label="Tipo de Documento" wire:model='form.documentType' :options="$documentTypes"
                    single />
            </div>
            <div id="documentNumber" class="w-full mt-2 md:w-2/3 md:mt-0">
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
                                return '************';
                            default:
                                return 'a';
                        }
                }"
                    wire:model.blur="form.documentNumber" clearable />
            </div>
        </div>
        <!--Nombres-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-x-2 md:space-y-0">
            <div id="lastNameFather" class="w-full md:w-1/4">
                <x-mary-input label="Apellido paterno" wire:model.blur='form.lastNameFather' />
            </div>
            <div id="lastNameMother" class="w-full md:w-1/4">
                <x-mary-input label="Apellido materno" wire:model.blur='form.lastNameMother' />
            </div>
            <div id="name" class="w-full md:w-2/4">
                <x-mary-input label="Nombres" wire:model.blur='form.name' />
            </div>
        </div>
        <!--Apoderado-->
        <div>
            <x-mary-input label="Datos del apoderado (En caso de ser menor de Edad)" wire:model='form.representative'
                placeholder="Padre o Madre" />
        </div>
        <!--Ubicación-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-x-2 md:space-y-0">
            <div id="departmentId" class="transition-all ease-in-out"
                :class="$wire.form.provinceId ? 'md:w-1/3 w-full' : ($wire.form.departmentId ? 'md:w-1/2 w-full' :
                    'w-full')">
                <x-mary-choices-offline label="Departamento" @change-selection="$wire.form.provinceId = null"
                    wire:model.live="form.departmentId" :options="$this->departments" single searchable
                    no-result-text="Departamento no encontrado." />
            </div>
            <div id="provinceId" x-show="$wire.form.departmentId" class="transition-all ease-out"
                :class="!$wire.form.departmentId ? 'opacity-0' : ($wire.form.provinceId ? 'md:w-1/3 w-full opacity-100' :
                    'md:w-1/2 w-full')">
                <x-mary-choices-offline label="Provincia" @change-selection="$wire.form.districtId = null"
                    wire:model.live="form.provinceId" wire:loading.class='opacity-50' wire:target='form.departmentId'
                    :options="$provincesFound" single searchable no-result-text="Provincia no encontrada." />
            </div>
            <div id="districtId" x-show="$wire.form.provinceId" class="w-full transition-all ease-out md:w-1/3"
                :class="$wire.form.departmentId ? 'opacity-100' : 'opacity-0'">
                <x-mary-choices-offline label="Distrito" wire:model='form.districtId'
                    wire:target='form.departmentId,form.provinceId' wire:loading.class='opacity-50' :options="$districtsFound"
                    single searchable no-result-text="Distrito no encontrado." />
            </div>
        </div>
        <!--Dirección-->
        <div class="flex flex-col md:flex-row md:space-x-2">
            <div id="street" class="w-full md:w-1/2">
                <x-mary-input label="Dirección" wire:model='form.street' placeholder="Av. / Calle / Jr." />
            </div>
            <div class="flex w-full mt-2 space-x-2 md:w-1/2 md:mt-0">
                <div class="w-1/3" id="streetNumber">
                    <x-mary-input label="Nro/Mz" wire:model='form.streetNumber' />
                </div>
                <div id="streetLot" class="w-1/3">
                    <x-mary-input label="Lote" wire:model='form.streetLot' />
                </div>
                <div id="streetDpto" class="w-1/3">
                    <x-mary-input label="Nro Dpto" wire:model='form.streetDpto' />
                </div>
            </div>
        </div>
        <!--Urbanizacion-->
        <div id="urbanization">
            <x-mary-input label="Urbanización" wire:model='form.urbanization' />
        </div>
        <!--Referencia-->
        <div id="reference">
            <x-mary-input label="Referencia" wire:model='form.reference' />
        </div>
        <!--Medio de Respuesta-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
            <div id="telephone" class="w-full md:w-1/3">
                <x-mary-input label="Teléfono" wire:model='form.telephone' x-mask="(+99) 999999"
                    placeholder="Cód. Provincia + Nro Teléfono" />
            </div>
            <div id="celphone" class="w-full md:w-1/3">
                <x-mary-input label="Celular" wire:model='form.celphone' x-mask="999999999" />
            </div>
            <div id="email" class="w-full md:w-1/3">
                <x-mary-input label="Correo electrónico" type="email" wire:model='form.email' placeholder="___@___" />
            </div>
        </div>
        <div id="responseMedium">
            <x-mary-choices-offline label="Medio de Respuesta" wire:model="form.responseMedium" :options="$responseMediums"
                single />
        </div>
        <h1 class="py-6 text-3xl font-bold text-center text-home-primary md:text-4xl">
            Datos de la queja o reclamo
        </h1>
        <div>
            <x-mary-radio label="Motivo de contacto" :options="$reasons" wire:model="form.isComplaint"
                class="w-full" />
        </div>
        <div x-show="$wire.form.isComplaint == 0" x-transition.in>
            <div class="pt-2 pb-4 text-sm font-bold">
                <label for="service">Servicio contratado</label>
            </div>
            <div class="space-y-2">
                <div @click="$wire.claimForm.service = 1" class="cursor-pointer">
                    <input type="radio" name="service" wire:model='claimForm.service' value="1">
                    Cambio de moneda online
                </div>
                <div @click="$wire.claimForm.service = 2" class="cursor-pointer">
                    <input type="radio" name="service" wire:model='claimForm.service' value="2"> Otros
                </div>
            </div>
            <div x-show="$wire.claimForm.service == 1" x-transition class="pt-4">
                <div class="flex space-x-2">
                    <div class="w-1/3">
                        <x-mary-choices-offline label="Tipo de moneda" wire:model="claimForm.currencyType"
                            :options="$currencies" single />
                    </div>
                    <div class="w-1/3">
                        <x-mary-input label="Código de operación" wire:model='claimForm.operationCode'
                            placeholder="000000" x-mask="999999" prefix="ALS-" />
                    </div>
                    <div class="w-1/3">
                        <x-mary-input label="Monto a reclamar" wire:model='claimForm.amountToClaim'
                            x-mask:dynamic="$money($input, '.', ',')"
                            prefix="{{ $claimForm->currencyType == 1 ? 'S/.' : '$ ' }}" />
                    </div>
                </div>
            </div>
            <div x-show="$wire.claimForm.service == 2" class="pt-2" x-transition>
                <x-mary-textarea label="Ingrese su reclamo" wire:model="form.reasonDescription"
                    placeholder="Ingrese su reclamo lo más descriptivo posible..." rows="5" />
            </div>
        </div>

        <div x-show="$wire.form.isComplaint == 1" x-transition.in>
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
    <div class="max-h-64"></div>
</div>
@script
    <script>
        $wire.on('focus-input-error', (field) => {
            const inputError = document.getElementById(field.field);
            console.log(field)
            if (field.field !== null) {
                inputError.scrollIntoView({
                    behavior: 'smooth',
                });
            }
        });
    </script>
@endscript
