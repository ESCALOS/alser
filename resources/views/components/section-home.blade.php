<section class="bg-indigo-700">
    <div class="max-w-screen-xl px-6 mx-auto text-center" x-data="{ open: true }">
        <div class="absolute left-0 items-center w-full max-w-screen-xl mx-auto bg-indigo-900 md:w-3/5 md:left-1/4 md:mt-8 md:flex md:content-around md:justify-center"
            x-show="open" x-transition.duration.500ms>
            <div class="flex content-around w-full p-2 text-indigo-100 bg-indigo-900 md:rounded-full"
                role="alert">
                <div class="flex-auto w-48 mr-2 text-xl md:w-64 text-pretty">¡Cambia dólares para tu <span class="text-2xl font-black text-yellow-500">Empresa</span>  con los mejores beneficios!</div>
                <div class="relative flex items-center">
                    <a wire:navigate.hover href="{{ route('home.companies') }}" class="px-2 py-1 mx-4 text-xs font-bold text-indigo-700 uppercase bg-white rounded-md md:text-md">Más información</a>
                    <svg @click="open = false" class="absolute top-0 right-0 w-4 h-4 opacity-75 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 divide-y md:grid-cols-2 md:divide-y-0">
            <div class="md:py-12 md:pt-36 animate-swing-drop-in" :class="open ? 'pt-32 pb-4' : 'py-4'">
                <h1 class="mb-4 text-4xl font-extrabold text-white md:text-5xl lg:text-6xl">
                    Transacciones de manera segura, rápida y con total confianza.
                </h1>
                <!--<p class="mb-8 text-lg font-normal text-gray-300 delay-900 lg:text-xl sm:px-16">
                    Ofrecemos el mejor tipo de cambio del mercado.</p>-->
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                    <a wire:navigate.hover href="{{ route('home.companies') }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-indigo-700 bg-white border rounded-lg hover:border-white hover:text-white hover:bg-indigo-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-blue-900">
                        ¿Eres empresa?
                    </a>
                    <a wire:navigate.hover href="{{ route('home.help') }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-white rounded-lg hover:text-indigo-700 hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Contactenos
                    </a>
                </div>
                <p class="my-8 text-lg font-normal text-gray-300 delay-900 lg:text-xl sm:px-16">
                    Operaciones inmediatas o máximo 15 minutos.</p>
                <div class="flex flex-row justify-center">
                    <img decoding="async"
                        src="https://alsercambio.com/wp-content/uploads/2023/04/Interbank_logo.svg-1.png"
                        class="h-16 p-4 bg-green-500 rounded-sm" title="Interbank_logo.svg" alt="Interbank_logo.svg"
                        loading="lazy">
                </div>
                <p class="my-8 text-lg font-normal text-gray-300 delay-900 lg:text-xl sm:px-16">
                    Operaciones interbancarias. (hasta 1 día útil)</p>
            </div>
            <div class="py-4 md:pt-36 md:py-12">
                <livewire:quoter />
            </div>
        </div>
        <div class="grid grid-cols-1 py-4 divide-x-0 divide-y md:divide-y-0 md:divide-x md:grid-cols-2">
            <div class="pr-0 md:pr-4 md:h-48 h-96">
                <div class="flex items-start justify-center">
                    <h1 class="text-lg text-white">Operaciones Inmediatas (15min)</h1>
                </div>
                <div class="grid h-16 grid-cols-1 mt-4 md:grid-cols-4">
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/bcp.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Todo el Perú</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/inter.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Solo en Lima</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/banbif.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Solo en Lima</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/pich.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Solo en Lima</h1>
                    </div>
                </div>
            </div>
            <div class="pt-4 pl-0 md:pl-4 md:pt-0 md:h-48 h-96">
                <div class="flex items-start justify-center">
                    <h1 class="text-lg text-white">Operaciones Interbancarias (hasta 1 día útil)</h1>
                </div>
                <div class="grid h-16 grid-cols-1 mt-4 md:grid-cols-4">
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/bbva.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Todo el Perú</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/scotia.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Solo en Lima</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/mi_banco.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Solo en Lima</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/falabella.png" alt="img-bcp" class="w-24 py-2">
                        <h1 class="text-center text-white">Solo en Lima</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
