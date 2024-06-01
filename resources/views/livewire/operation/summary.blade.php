<div>
    <x-mary-card>
        <div class="flex justify-between">
            <p class="text-xl font-bold">
                Operación
            </p>
            <div class="flex border rounded-sm text-md border-lime-500">
                <div class="w-24 pl-2">
                    @if ($operation->is_purchase)
                        Compra
                    @else
                        Venta
                    @endif
                </div>
                <div class="w-20 pl-2 font-semibold text-white bg-lime-500">
                    {{ $operation->factor }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 mt-6 mb-1 border border-gray-300 rounded-md">
            <div class="py-1 pl-2 bg-gray-200">
                <p>Enviarás <i class="rotate-45 fa-solid fa-arrow-up text-violet-900"></i> </p>
                <p class="font-bold">$ 3.746.00</p>
            </div>
            <div class="py-1 pl-2">
                <p>Recibirás <i class="fa-solid fa-arrow-down text-lime-500"></i></p>
                <p class="font-bold text-lime-500">S/. 13,901.41</p>
            </div>
        </div>
    </x-mary-card>
</div>
