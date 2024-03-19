<div>
    <x-mary-form wire:submit.prevent='save'>
        <h1 class="py-6 text-3xl font-bold text-center text-home-primary md:text-4xl">
            Datos Personales
        </h1>
        <!--Documento -->
        <div class="flex flex-col md:flex-row md:space-x-2">
            <div id="document_type" class="w-full md:w-1/3">
                <x-mary-choices-offline label="Tipo de Documento" wire:model='form.document_type' :options="$document_types"
                    single />
            </div>
            <div id="document_number" class="w-full mt-2 md:w-2/3 md:mt-0">
                <x-mary-input label="Número de documento" type="text"
                    x-mask:dynamic="(value) => {
                        switch ($wire.form.document_type) {
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
                    wire:model.blur="form.document_number" clearable required />
            </div>
        </div>
        <!--Nombres-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-x-2 md:space-y-0">
            <div id="last_name_father" class="w-full md:w-1/4">
                <x-mary-input label="Apellido paterno" wire:model.blur='form.last_name_father' required />
            </div>
            <div id="last_name_mother" class="w-full md:w-1/4">
                <x-mary-input label="Apellido materno" wire:model.blur='form.last_name_mother' required />
            </div>
            <div id="name" class="w-full md:w-2/4">
                <x-mary-input label="Nombres" wire:model.blur='form.name' required />
            </div>
        </div>
        <!--Apoderado-->
        <div>
            <x-mary-input label="Datos del apoderado (En caso de ser menor de Edad)" wire:model='form.representative'
                placeholder="Padre o Madre" />
        </div>
        <!--Ubicación-->
        <div class="flex flex-col space-y-2 md:flex-row md:space-x-2 md:space-y-0">
            <div id="location_department_id" class="transition-all ease-in-out"
                :class="$wire.form.location_province_id ? 'md:w-1/3 w-full' : ($wire.form.location_department_id ?
                    'md:w-1/2 w-full' :
                    'w-full')">
                <x-mary-choices-offline label="Departamento" @change-selection="$wire.form.location_province_id = null"
                    wire:model.live="form.location_department_id" :options="$this->departments" single searchable
                    no-result-text="Departamento no encontrado." />
            </div>
            <div id="location_province_id" x-show="$wire.form.location_department_id" class="transition-all ease-out"
                :class="!$wire.form.location_department_id ? 'opacity-0' : ($wire.form.location_province_id ?
                    'md:w-1/3 w-full opacity-100' :
                    'md:w-1/2 w-full')">
                <x-mary-choices-offline label="Provincia" @change-selection="$wire.form.location_district_id = null"
                    wire:model.live="form.location_province_id" wire:loading.class='opacity-50'
                    wire:target='form.location_department_id' :options="$provinces_found" single searchable
                    no-result-text="Provincia no encontrada." />
            </div>
            <div id="location_district_id" x-show="$wire.form.location_province_id"
                class="w-full transition-all ease-out md:w-1/3"
                :class="$wire.form.location_department_id ? 'opacity-100' : 'opacity-0'">
                <x-mary-choices-offline label="Distrito" wire:model='form.location_district_id'
                    wire:target='form.location_department_id,form.location_province_id' wire:loading.class='opacity-50'
                    :options="$districts_found" single searchable no-result-text="Distrito no encontrado." />
            </div>
        </div>
        <!--Dirección-->
        <div class="flex flex-col md:flex-row md:space-x-2">
            <div id="street" class="w-full md:w-1/2">
                <x-mary-input label="Dirección" wire:model='form.street' placeholder="Av. / Calle / Jr." required />
            </div>
            <div class="flex w-full mt-2 space-x-2 md:w-1/2 md:mt-0">
                <div class="w-1/3" id="street_number">
                    <x-mary-input label="Nro/Mz" wire:model='form.street_number' required />
                </div>
                <div id="street_lot" class="w-1/3">
                    <x-mary-input label="Lote" wire:model='form.street_lot' />
                </div>
                <div id="street_dpto" class="w-1/3">
                    <x-mary-input label="Nro Dpto" wire:model='form.street_dpto' />
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
                <x-mary-input label="Celular" wire:model='form.celphone' x-mask="999999999" required />
            </div>
            <div id="email" class="w-full md:w-1/3">
                <x-mary-input label="Correo electrónico" type="email" wire:model='form.email' placeholder="___@___"
                    required />
            </div>
        </div>
        <div id="response_medium">
            <x-mary-choices-offline label="Medio de Respuesta" wire:model="form.response_medium" :options="$response_mediums"
                single />
        </div>
        <h1 class="py-6 text-3xl font-bold text-center text-home-primary md:text-4xl">
            Datos de la queja o reclamo
        </h1>
        <div>
            <x-mary-radio label="Motivo de contacto" :options="$reasons" wire:model="form.is_complaint" class="w-full"
                required />
        </div>
        <div x-show="$wire.form.is_complaint == 0" x-transition.in id="claimForm.service">
            <div class="pt-2 pb-4 text-sm font-bold">
                <label for="service">Servicio contratado</label>
            </div>
            <div class="space-y-2">
                <div @click="$wire.claimForm.service = 1" class="cursor-pointer">
                    <input type="radio" name="service" wire:model='claimForm.service' value="1" />
                    Cambio de moneda online
                </div>
                <div @click="$wire.claimForm.service = 2" class="cursor-pointer">
                    <input type="radio" name="service" wire:model='claimForm.service' value="2" />
                    Otros
                </div>
            </div>
            <div x-show="$wire.claimForm.service == 1" x-transition class="pt-4">
                <div class="flex flex-col space-x-0 space-y-2 md:space-y-0 md:space-x-2 md:flex-row">
                    <div class="w-full md:w-1/3" id="claimForm.currency_type">
                        <x-mary-choices-offline label="Tipo de moneda" wire:model="claimForm.currency_type"
                            :options="$currencies" single />
                    </div>
                    <div class="w-full md:w-1/3" id="claimForm.operation_code">
                        <x-mary-input label="Código de operación" wire:model='claimForm.operation_code'
                            placeholder="000000" x-mask="999999" prefix="ALS-" />
                    </div>
                    <div class="w-full md:w-1/3" id="claimForm.amount_to_claim">
                        <x-mary-input label="Monto a reclamar" wire:model='claimForm.amount_to_claim'
                            x-mask:dynamic="$money($input, '.', ',')" prefix="S/ " />
                    </div>
                </div>
            </div>
            <div x-show="$wire.claimForm.service == 2" class="pt-2" x-transition>
                <x-mary-textarea label="Ingrese su reclamo" wire:model="form.reason_description"
                    placeholder="Ingrese su reclamo lo más descriptivo posible..." rows="5" />
            </div>
        </div>

        <div id="form.reason_description" x-show="$wire.form.is_complaint == 1" x-transition.in>
            <x-mary-textarea label="Ingrese su queja" wire:model="form.reason_description"
                placeholder="Ingrese su queja lo más descriptivo posible..." rows="5" />
        </div>
        <p class="text-sm text-justify text-gray-700">
            *Si tu reclamo es sobre una operación que realizaste en alsercambio.com, indica el código de esta (puedes
            encontrarlo en la sección "Historial de operaciones" en tu cuenta registrada en alsercambio.com)
        </p>
        <x-slot:actions>
            <x-mary-button label="Enviar documento a Libro de Reclamaciones" class="text-white btn-primary"
                type="submit" spinner="save" />
        </x-slot:actions>
    </x-mary-form>
    <div class="max-h-64"></div>
</div>
@script
    <script>
        $wire.on('focus-input-error', (field) => {
            if (field && field.field) {
                const inputError = document.getElementById(field.field);
                if (inputError) {
                    inputError.scrollIntoView({
                        behavior: 'smooth',
                    });
                }
            }
        });
    </script>
@endscript
