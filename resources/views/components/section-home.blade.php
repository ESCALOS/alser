<section class="bg-home-primary">
    <div class="max-w-screen-xl px-6 mx-auto text-center" x-data="{ open: true }">
        <div class="absolute left-0 items-center w-full max-w-screen-xl mx-auto md:w-3/5 md:left-1/4 md:mt-8 md:flex md:content-around md:justify-center"
            x-show="open" x-transition.duration.500ms>
            <div class="flex content-around w-full p-2 text-indigo-100 bg-violet-900 md:rounded-full"
                role="alert">
                <div class="flex-auto w-48 mr-2 text-lg md:w-64 text-pretty">¡Cambia dólares para tu <span class="text-2xl font-black text-yellow-500">Empresa</span>  con los mejores beneficios!</div>
                <div class="relative flex items-center justify-around w-48">
                    <a wire:navigate.hover href="{{ route('home.companies') }}" class="px-2 py-1 text-xs font-bold uppercase bg-white rounded-md text-home-primary md:text-md">Más información</a>
                    <svg @click="open = false" class="w-4 h-4 opacity-75 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg"
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
                <div class="pb-8 text-left">
                    <h4 class="text-xl font-extrabold text-white md:text-2xl lg:text-3xl">
                        Transacciones de manera
                    </h4>
                    <h3 class="text-3xl font-bold text-white md:text-4xl lg:text-6xl">
                        segura, rápida y con total confianza.
                    </h3>
                </div>

                <!--<p class="mb-8 text-lg font-normal text-gray-300 delay-900 lg:text-xl sm:px-16">
                    Ofrecemos el mejor tipo de cambio del mercado.</p>-->
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-start sm:space-y-0 sm:space-x-4">
                    <a wire:navigate.hover href="{{ route('home.companies') }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center bg-white border rounded-lg text-home-primary hover:border-white hover:text-white hover:bg-home-primary focus:ring-4 focus:ring-gray-300 dark:focus:ring-blue-900">
                        ¿Eres empresa?
                    </a>
                    <a wire:navigate.hover href="{{ route('home.help') }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-white rounded-lg hover:text-home-primary hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Contactenos
                    </a>
                </div>
            </div>
            <div class="py-4 md:pt-36 md:py-12">
                <livewire:quoter />
            </div>
        </div>
        <div class="grid grid-cols-1 py-4 divide-x-0 divide-y md:divide-y-0 md:divide-x md:grid-cols-2">
            <div class="h-48 pr-0 md:pr-4">
                <div class="flex items-start justify-center pb-8">
                    <h1 class="text-lg text-white">Operaciones en máximo 30 min.</h1>
                </div>
                <div class="flex items-center h-16 justify-evenly">
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/bcp.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Todo el Perú</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/inter.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Todo el Perú</h1>
                    </div>
                </div>
            </div>
            <div class="h-48 pt-4 pl-0 md:pl-4 md:pt-0">
                <div class="flex items-start justify-center pb-8">
                    <h1 class="text-lg text-white">Operaciones Interbancarias (hasta 1 día útil)</h1>
                </div>
                <div class="flex items-center h-16 justify-evenly">
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/bbva.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Todo el Perú</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center py-2">
                        <img src="storage/images/bancos/scotia.svg" alt="img-bcp" class="py-2">
                        <h1 class="text-center text-white">Todo el Perú</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
