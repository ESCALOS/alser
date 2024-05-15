<div>
    <div class="space-y-4">
        <x-mary-input label="{{ __('Email') }}" class="rounded-lg" value="{{ auth()->user()->email }}" disabled />
        <p class="pt-2 text-pretty">Por resolución de la SBS, necesitas llenar los siguientes
            datos.
        </p>
        <x-mary-input label="RUC" value="{{ auth()->user()->document_number }}" readonly />
        <div class="grid grid-cols-2 gap-3">
            <x-mary-input label="Razón Social" value="{{ auth()->user()->name }}" readonly />
            <x-mary-input label="Celular" value="{{ auth()->user()->celphone }}" readonly />
        </div>
        <x-mary-alert icon="o-exclamation-circle" class="text-white bg-amber-600">
            <span class="font-bold text-md text-pretty">Sus datos están siendo validados.</span>
        </x-mary-alert>
        <h3 class="text-2xl font-semibold">Datos del representante legal</h3>
        <x-mary-input label="Nombres" value="{{ $legalRepresentative->name }}" readonly />
        <div class="grid grid-cols-2 gap-3">
            <x-mary-input label="Primer Apellido" value="{{ $legalRepresentative->first_lastname }}" readonly />
            <x-mary-input label="Segundo Apellido" value="{{ $legalRepresentative->second_lastname }}" readonly />
        </div>
        <div class="grid gap-3 lg:grid-cols-2">
            <x-mary-input label="Tipo de Documento" value="{{ $legalRepresentative->document_type->getLabel() }}"
                readonly />
            <x-mary-input label="Número de documento" value="{{ $legalRepresentative->document_number }}" readonly />
            <x-mary-input label="Nacionalidad" value="{{ $legalRepresentative->country->name }}" readonly />
            <x-mary-input label="Tipo de representación"
                value="{{ $legalRepresentative->representation_type->getLabel() }}" readonly />
        </div>
    </div>
    <div class="grid gap-3 my-10 md:grid-cols-2">
        <x-identity-document-viewer-status :status="$legalRepresentative->identity_document_status" />
    </div>
    <!--Datos de PEP-->
    <div class="space-y-6">
        <div>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer" @checked($legalRepresentative->is_PEP) disabled>
                <div
                    class="relative w-16 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 rounded-full peer peer-checked:after:translate-x-8 peer-checked:before:-translate-x-5 rtl:peer-checked:before:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all after:duration-500
                    before:content-['No'] peer-checked:before:content-['Sí'] before:font-semibold before:top-[.25rem] before:start-[2rem] before:text-white before:absolute before:transition-all before:duration-500 peer-checked:bg-violet-600">
                </div>
                <span class="font-medium text-gray-900 text-md ms-3">¿Es usted PEP?</span>
            </label>
            <p class="text-xs text-justify text-gray-800">Personas expuestas políticamente (PEP): personas
                naturales,
                nacionales o extranjeras, que cumplen o que en los últimos cinco (5) años hayan cumplido
                funciones públicas destacadas o funciones prominentes en una organización internacional, sea
                en
                el territorio nacional o extranjero, y cuyas circunstancias financieras puedan ser objeto de
                un
                interés público. Para más información revisar el Anexo – Resolución SBS N° 4349-2016, Lista
                de
                funciones y cargos ocupados por personas expuestas políticamente (PEP) en materia de
                prevención
                del lavado de activos y del financiamiento del terrorismo.
                <a target="_blank" class="text-violet-700"
                    href="https://www.sbs.gob.pe/prevencion-de-lavado-activos/listas-de-interes">
                    Disponible aquí
                </a>
            </p>
        </div>
        <div>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer" @checked($legalRepresentative->wife_is_PEP) disabled>
                <div
                    class="relative w-16 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 rounded-full peer peer-checked:after:translate-x-8 peer-checked:before:-translate-x-5 rtl:peer-checked:before:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all after:duration-500
                    before:content-['No'] peer-checked:before:content-['Sí'] before:font-semibold before:top-[.25rem] before:start-[2rem] before:text-white before:absolute before:transition-all before:duration-500 peer-checked:bg-violet-600">
                </div>
                <span class="font-medium text-gray-900 text-md ms-3">¿Su cónyuge/concubino es PEP?</span>
            </label>
            <p class="text-xs text-gray-800">Aquel varón o mujer que mantiene una unión de hecho por dos
                años,
                de
                acuerdo con lo establecido en el artículo 326 del Código Civil.</p>
        </div>
        <div>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer" @checked($legalRepresentative->relative_is_PEP) disabled>
                <div
                    class="relative w-16 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 rounded-full peer peer-checked:after:translate-x-8 peer-checked:before:-translate-x-5 rtl:peer-checked:before:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all after:duration-500
                    before:content-['No'] peer-checked:before:content-['Sí'] before:font-semibold before:top-[.25rem] before:start-[2rem] before:text-white before:absolute before:transition-all before:duration-500 peer-checked:bg-violet-600">
                </div>
                <span
                    class="font-medium text-gray-900 max-w-52 min-[425px]:max-w-72 md:max-w-[100%] min-[375px]:max-w-64 text-md ms-3">¿Tiene
                    un
                    familiar
                    hasta 2do grado de
                    consanguinidad y/o de afinidad que sea PEP?</span>
            </label>
        </div>
    </div>
</div>
