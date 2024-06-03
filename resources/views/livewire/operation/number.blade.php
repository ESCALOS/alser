<x-mary-card>
    <div class="flex items-center">
        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-lime-500">
            <p class="font-bold text-white text-md">2</p>
        </div>
        <span class="ml-2 font-bold text-md text-violet-900">Ingresa el N° de operación</span>
    </div>
    <div class="my-4">
        <p class="text-gray-700">Ubica el N° de operación de la transferencia realizada e ingrésalo a continuación</p>
        <span class="font-semibold underline cursor-pointer text-violet-700">¿Cómo lo encuentro?</span>
    </div>
    <div>
        <input type="text" class="w-full py-2 rounded-md" placeholder="Número de operación" />
    </div>
    <button class="bg-violet-100 text-violet-700 font-bold text-sm py-2 px-4 mt-10 mb-4 rounded-sm">
        Agregar más transferencias
        <x-mary-icon name="s-plus-circle" />
    </button>
    <hr class="border-t-2 border-gray-300 border-dotted my-4">
    <div class="flex justify-between">
        <x-mary-button type="button"
            class="py-2 px-4 border text-sm rounded-sm border-gray-400 text-gray-400 bg-white font-bold hover:bg-white"
            x-on:click="$wire.dispatch('operation-cancelled')">
            Cancelar Operación
        </x-mary-button>
        <x-mary-button type="button"
            class="py-2 px-4 border text-sm rounded-sm bg-violet-700 hover:bg-violet-800 text-white font-bold ">
            Enviar Operación
        </x-mary-button>
    </div>
</x-mary-card>
