<x-mary-card>
    <div class="flex items-center">
        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-lime-500">
            <p class="font-bold text-white text-md">1</p>
        </div>
        <span class="ml-2 font-bold text-md text-violet-900">Transfiere</span>
        <h2 class="ml-4 text-2xl font-bold text-violet-900">
            @if ($isPurchase)
                US$
            @else
                S/.
            @endif
            {{ number_format($amount, 2) }}
        </h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
        <div class="flex items-center w-full p-3 bg-gray-100 rounded-sm">
            <p class="w-1/4 font-semibold text-violet-900 text-md">Hacia</p>
            <p class="w-3/4 text-sm font-semibold text-gray-700">Tu cuenta</p>
        </div>
        <div class="w-full p-3 text-sm bg-gray-100 rounded-sm">
            <p class="font-semibold text-gray-500">{{ $bank }}</p>
            <p class="font-semibold text-gray-800">N° {{ $account }}</p>
        </div>
        <div class="flex items-center w-full p-3 bg-gray-100 rounded-sm">
            <p class="w-1/4 font-semibold text-violet-900 text-md">Hacia</p>
            <div class="w-3/4 font-semibold">
                <p class="text-md text-violet-900">ALSER CAMBIO</p>
                <p class="text-xs text-gray-700">RUC 20608348329</p>
            </div>
        </div>
        <div class="w-full p-3 text-sm bg-gray-100 rounded-sm">
            <p class="font-semibold text-gray-500">Banco de Crédito del Perú corriente Dólares</p>
            <p class="font-semibold text-gray-800">N° {{ $account }}</p>
        </div>
    </div>
</x-mary-card>
