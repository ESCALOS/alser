<div>
    <x-mary-card title="Datos del Perfil" shadow>
        @if ($this->user->isIdentityDocumentRequired())
            <x-mary-form wire:submit='save'>
                <div class="space-y-4">
                    <x-mary-input label="{{ __('Email') }}" class="rounded-lg" value="{{ $this->user->email }}"
                        disabled />
                    @if (!$this->user->hasVerifiedEmail())
                        <p class="mt-2 text-sm text-red-600">
                            {{ __('Your email address is unverified.') }}

                            <button wire:loading.remove wire:target='sendEmailVerification' type="button"
                                class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                wire:click.prevent="sendEmailVerification">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                            <span class="text-blue-500" wire:loading
                                wire:target='sendEmailVerification'>Enviando...</span>
                        </p>
                        @if ($verificationLinkSent)
                            <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    @endif

                    <p class="pt-2 text-pretty">Por resolución de la SBS, necesitas llenar los siguientes
                        datos.
                    </p>
                    <x-mary-input label="RUC" value="{{ auth()->user()->document_number }}" readonly />
                    <div class="grid grid-cols-2 gap-3">
                        <x-mary-input label="Razón Social" value="{{ auth()->user()->name }}" readonly />
                        <x-mary-input label="Celular" wire:model='form.celphone' x-mask='999999999' />
                    </div>
                    <h3 class="text-xl font-semibold">Datos de los accionistas</h3>
                    <p class="text-md">
                        Según los requerimientos de la SBS, indica los accionistas, socios o asociados que tengan
                        directa o indirectamente más del 25% del capital social, aporte o participación de la persona
                        jurídica.
                    </p>
                    {{-- Accionistas --}}
                    @for ($i = 0; $i < 3; $i++)
                        <h3 class="font-semibold border-b-2 border-gray-900 text-md">
                            Accionista {{ $i + 1 }}
                        </h3>
                        <div class="grid grid-cols-2 gap-2 py-4 md:grid-cols-4">
                            <div class="col-span-2">
                                <x-mary-input label="Nombres o Razón Social"
                                    wire:model='form.shareHolders.{{ $i }}.name' />
                            </div>
                            <x-mary-choices-offline label="Tipo de Documento" :options="$documentTypes"
                                wire:model='form.shareHolders.{{ $i }}.documentType' single />
                            <x-mary-input label="Número de documento"
                                wire:model='form.shareHolders.{{ $i }}.documentNumber'
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
                                }" />
                        </div>
                    @endfor

                    <x-mary-alert icon="o-exclamation-circle" class="text-white bg-sky-600">
                        <span class="font-bold text-md text-pretty">
                            Tus nombres y apellidos deben ser iguales a los que figuran en tu documento de identidad.
                        </span>
                    </x-mary-alert>
                    <h3 class="text-2xl font-semibold">Datos del representante legal</h3>
                    <x-mary-input label="Nombres" wire:model='form.name' />
                    <div class="grid grid-cols-2 gap-3">
                        <x-mary-input label="Primer Apellido" wire:model='form.firstLastname' />
                        <x-mary-input label="Segundo Apellido" wire:model='form.secondLastname' />
                    </div>
                    <div class="grid gap-3 lg:grid-cols-2">
                        <x-mary-choices-offline label="Tipo de Documento" :options="$documentTypesExceptRuc"
                            wire:model='form.documentType' single />
                        <x-mary-input label="Número de documento" wire:model='form.documentNumber'
                            x-mask:dynamic="(value) => {
                        if ($wire.form.documentType == 1) {
                            return '99999999';
                        }else {
                            return '************';
                        }
                    }" />
                        <x-mary-choices-offline label="Nacionalidad" wire:model='form.nacionality' :options="$this->countries"
                            single searchable />
                        <x-mary-choices-offline label="Tipo de representación" wire:model='form.representationType'
                            :options="$representationTypes" single searchable />
                    </div>
                </div>
                <!--Fotos del documento-->
                <div class="grid gap-3 my-10 md:grid-cols-2">
                    <x-mary-file wire:model="form.identityDocumentFront" accept="image/*" change-text="Cambiar"
                        crop-after-change crop-text="Recortar" crop-title-text="Recortar imagen"
                        crop-cancel-text="Cancelar" crop-save-text="Recortar">
                        <div class="h-52">
                            <div class="h-32 rounded-t-md bg-violet-100">
                                <h3 class="pt-4 pb-1 text-lg font-semibold text-center text-violet-400">Lado Frontal
                                </h3>
                                <img src="{{ asset('images/defaults/document_front.png') }}" class="h-24 m-auto" />
                            </div>
                            <div class="h-20 px-4 pt-4 align-middle rounded-b-md bg-violet-300">
                                <div
                                    class="content-center w-full h-12 font-semibold text-center bg-white rounded-sm text-violet-500">
                                    <x-mary-icon name="m-camera" />
                                    <span>Foto del documento</span>
                                </div>
                            </div>
                        </div>
                    </x-mary-file>
                    <x-mary-file wire:model="form.identityDocumentBack" accept="image/*" change-text="Cambiar"
                        crop-after-change crop-text="Recortar" crop-title-text="Recortar imagen"
                        crop-cancel-text="Cancelar" crop-save-text="Recortar">
                        <div class="h-52">
                            <div class="h-32 rounded-t-md bg-violet-100">
                                <h3 class="pt-4 pb-1 text-lg font-semibold text-center text-violet-400">Lado
                                    Reverso
                                </h3>
                                <img src="{{ asset('images/defaults/document_back.png') }}" class="h-24 m-auto" />
                            </div>
                            <div class="h-20 px-4 pt-4 align-middle rounded-b-md bg-violet-300">
                                <div
                                    class="content-center w-full h-12 font-semibold text-center bg-white rounded-sm text-violet-500">
                                    <x-mary-icon name="m-camera" />
                                    <span>Foto del documento</span>
                                </div>
                            </div>
                        </div>
                    </x-mary-file>
                </div>
                <!--Datos de PEP-->
                <div class="space-y-6">
                    <div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" wire:model='form.isPEP'>
                            <div
                                class="relative w-16 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 rounded-full peer peer-checked:after:translate-x-8 peer-checked:before:-translate-x-5 rtl:peer-checked:before:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all after:duration-500
                                before:content-['No'] peer-checked:before:content-['Sí'] before:font-semibold before:top-[.25rem] before:start-[2rem] before:text-white before:absolute before:transition-all before:duration-500 peer-checked:bg-violet-600">
                            </div>
                            <span class="font-medium text-gray-900 text-md ms-3">¿Es usted PEP?</span>
                        </label>
                        <p class="text-xs text-justify text-gray-800">
                            Personas expuestas políticamente (PEP): personas naturales, nacionales o extranjeras, que
                            cumplen o que en los últimos cinco (5) años hayan cumplido funciones públicas destacadas o
                            funciones prominentes en una organización internacional, sea en el territorio nacional o
                            extranjero, y cuyas circunstancias financieras puedan ser objeto de un interés público. Para
                            más información revisar el Anexo – Resolución SBS N° 4349-2016, Lista de funciones y cargos
                            ocupados por personas expuestas políticamente (PEP) en materia de prevención del lavado de
                            activos y del financiamiento del terrorismo.
                            <a target="_blank" class="text-violet-700"
                                href="https://www.sbs.gob.pe/prevencion-de-lavado-activos/listas-de-interes">
                                Disponible aquí
                            </a>
                        </p>
                        <p class="mt-2 text-xs font-semibold text-violet-700"
                            x-show="$wire.form.isPEP && !($wire.form.wifeIsPEP || $wire.form.relativeIsPEP)"
                            x-transition>
                            Completar todos los puntos de la página 1 del formato.
                        </p>
                    </div>
                    <div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" wire:model='form.wifeIsPEP'>
                            <div
                                class="relative w-16 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 rounded-full peer peer-checked:after:translate-x-8 peer-checked:before:-translate-x-5 rtl:peer-checked:before:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all after:duration-500
                                before:content-['No'] peer-checked:before:content-['Sí'] before:font-semibold before:top-[.25rem] before:start-[2rem] before:text-white before:absolute before:transition-all before:duration-500 peer-checked:bg-violet-600">
                            </div>
                            <span class="font-medium text-gray-900 text-md ms-3">¿Su cónyuge/concubino es PEP?</span>
                        </label>
                        <p class="text-xs text-gray-800">
                            Aquel varón o mujer que mantiene una unión de hecho por dos años, de acuerdo con lo
                            establecido en el artículo 326 del Código Civil.
                        </p>
                        <p class="mt-2 text-xs font-semibold text-violet-700"
                            x-show="$wire.form.wifeIsPEP && !($wire.form.isPEP || $wire.form.relativeIsPEP)"
                            x-transition>
                            Completar sólo el punto 1. del formato con los datos del cónyuge/concubino.
                        </p>
                        <p class="mt-2 text-xs font-semibold text-violet-700"
                            x-show="$wire.form.wifeIsPEP && $wire.form.isPEP && !$wire.form.relativeIsPEP"
                            x-transition>
                            Completar todos los puntos de la página 1 del formato con los datos del titular.<br>
                            Completar la página 2 del formato con los datos del cónyuge/concubino.
                        </p>
                    </div>
                    <div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" wire:model='form.relativeIsPEP'>
                            <div
                                class="relative w-16 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 rounded-full peer peer-checked:after:translate-x-8 peer-checked:before:-translate-x-5 rtl:peer-checked:before:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all after:duration-500
                                before:content-['No'] peer-checked:before:content-['Sí'] before:font-semibold before:top-[.25rem] before:start-[2rem] before:text-white before:absolute before:transition-all before:duration-500 peer-checked:bg-violet-600">
                            </div>
                            <span
                                class="font-medium text-gray-900 max-w-52 min-[425px]:max-w-72 md:max-w-[100%] min-[375px]:max-w-64 text-md ms-3">
                                ¿Tiene un familiar hasta 2do grado de consanguinidad y/o de afinidad que sea PEP?</span>
                        </label>
                        <p class="mt-2 text-xs font-semibold text-violet-700"
                            x-show="!$wire.form.isPEP && $wire.form.relativeIsPEP && !$wire.form.wifeIsPEP"
                            x-transition>
                            Completar el punto 1. del formato con los datos del 1er familiar PEP.<br>
                            En caso de tener más de 1 familiar PEP completar la página 2 según corresponda.
                        </p>
                        <p class="mt-2 text-xs font-semibold text-violet-700"
                            x-show="$wire.form.isPEP && $wire.form.relativeIsPEP && !$wire.form.wifeIsPEP"
                            x-transition>
                            Completar todos los puntos de la página 1 del formato con los datos del titular.<br>
                            Completar la página 2 del formato de acuerdo al número de familiares PEP que tenga.
                        </p>
                        <p class="mt-2 text-xs font-semibold text-violet-700"
                            x-show="$wire.form.wifeIsPEP && $wire.form.relativeIsPEP && !$wire.form.isPEP"
                            x-transition>
                            Completar el punto 1. del formato con los datos del cónyuge/concubino.<br>
                            Completar la página 2 del formato de acuerdo al número de familiares PEP que tenga.
                        </p>
                        <p class="mt-2 text-xs font-semibold text-violet-700"
                            x-show="$wire.form.wifeIsPEP && $wire.form.isPEP && $wire.form.relativeIsPEP" x-transition>
                            Completar todos los puntos de la página 1 del formato con los datos del titular.<br>
                            Completar la página 2 del formato con los datos del cónyuge/concubino, y de acuerdo al
                            número de
                            familiares PEP que tenga.
                        </p>
                    </div>
                </div>
                <div x-data="{ uploading: false, uploaded: false, progress: 0 }" x-on:livewire-upload-start="uploading = true, uploaded = false"
                    x-on:livewire-upload-finish="uploading = false, uploaded = true"
                    x-on:livewire-upload-cancel="uploading = false, uploaded = false"
                    x-on:livewire-upload-error="uploading = false, uploaded = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                    x-show="$wire.form.isPEP || $wire.form.wifeIsPEP || $wire.form.relativeIsPEP" x-transition>
                    <p class="text-sm font-medium text-center text-violet-800">
                        <a href="{{ asset('pdfs/Formato PEP AlserCambio.pdf') }}" download>
                            Descargar el formato PEP
                        </a>
                    </p>
                    <p class="mt-6 text-center cursor-pointer select-none text-violet-800"
                        x-on:click="$refs.pdfPEP.click()">
                        <span class="px-4 py-2 mr-2 border rounded-lg">
                            Subir documento PEP
                            <i class="fa-solid fa-upload"></i>
                        </span>
                    </p>

                    <p class="mt-3 text-sm text-center text-gray-900">
                        Asegúrate de llenar correctamente el documento PEP
                    </p>
                    @error('form.pdfPEP')
                        <div class="p-1 pt-2 text-red-500 label-text-alt">{{ $message }}</div>
                    @enderror

                    <input x-ref="pdfPEP" type="file" class="hidden" wire:model='form.pdfPEP'
                        accept="application/pdf">

                    <div x-show="uploading">
                        <x-mary-loading class="text-primary loading-lg" />
                    </div>
                    <div x-show="uploaded">
                        <p class="mt-6 text-center select-none text-violet-800">
                            <span class="px-4 pt-2 pb-3 border-2 border-dashed border-violet-600">
                                <x-icons.pdf />
                                Archivo PEP listo
                            </span>
                        </p>
                    </div>
                </div>
                <x-slot:actions>
                    <x-mary-button label="Guardar"
                        class="w-full text-lg text-white transition-colors duration-300 bg-violet-800 hover:bg-violet-900"
                        type="submit" spinner="save" />
                </x-slot:actions>
            </x-mary-form>
        @else
            <x-legal-representative-form :legal-representative="$form->legalRepresentative" :verification-link-sent="$verificationLinkSent" :user="$this->user" />
        @endif

    </x-mary-card>
</div>
