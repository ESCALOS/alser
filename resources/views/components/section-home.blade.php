<section class="bg-blue-700">
    <div class="max-w-screen-xl px-6 mx-auto text-center">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="py-12 lg:py-48 animate-swing-drop-in">
                <h1 class="mb-4 text-4xl font-extrabold text-white md:text-5xl lg:text-6xl">
                    Transacciones de manera segura, rápida y con total confianza.
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-300 delay-900 lg:text-xl sm:px-16">
                    Ofrecemos el mejor tipo de cambio del mercado.</p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                    <a wire:navigate.hover href="{{ route('home.companies') }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-blue-700 bg-white border rounded-lg hover:border-white hover:text-white hover:bg-blue-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-blue-900">
                        ¿Eres empresa?

                    </a>
                    <a wire:navigate.hover href="{{ route('home.help') }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-white rounded-lg hover:text-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Contactenos
                    </a>
                </div>
                <p class="my-8 text-lg font-normal text-gray-300 delay-900 lg:text-xl sm:px-16">
                    Operaciones inmediatas o máximo 15 minutos.</p>
                <div class="flex flex-row justify-center">
                    <img decoding="async" src="https://alsercambio.com/wp-content/uploads/2023/04/Interbank_logo.svg-1.png" class="h-16 p-4 bg-green-500 rounded-sm" title="Interbank_logo.svg" alt="Interbank_logo.svg" loading="lazy">
                </div>
                    <p class="my-8 text-lg font-normal text-gray-300 delay-900 lg:text-xl sm:px-16">
                        Operaciones interbancarias. (hasta 1 día útil)</p>
            </div>
            <div class="hidden md:flex">
                <img fetchpriority="high" decoding="async"
                    src="https://alsercambio.com/wp-content/uploads/2021/06/accountant-1.png"
                    class="animate-blurred-fade-in" alt="fondo">
            </div>
        </div>
    </div>
</section>
