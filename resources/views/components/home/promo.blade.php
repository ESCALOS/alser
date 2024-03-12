<div class="bg-white border border-gray-200 rounded-lg shadow w-96 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-wrap items-center text-sm font-medium text-center text-gray-900 border-b border-gray-200 rounded-t-lg justify-evenly bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
        style="height: 58px">
        <h1 class="text-lg font-bold">Ninguna promo activa</h1>
    </div>
    <div class="flex flex-col items-center justify-around p-4 h-96">
        <img class="h-20 mb-4" src="{{ asset('storage/images/surprise.png') }}">
        <div>
            <div class="text-base text-gray-900 text-pretty">
                Los <b>ALSERPROMOS</b> te permiten acceder a un tipo de cambio insuperable, específicos
                y
                por monto mínimo.
            </div>
            <div class="py-4 text-gray-500 text-md">
                Estas promociones son por tiempo limitado.
            </div>
            <a class="block w-full px-6 py-4 text-xl text-white transition-colors duration-300 rounded-sm bg-home-primary hover:bg-violet-900"
                wire:navigate href="{{ route('dashboard') }}">
                Ir al cotizador
            </a>
        </div>
    </div>
</div>
