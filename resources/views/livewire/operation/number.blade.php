<x-mary-card x-data="number">
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
    <div id="transferencias">
        <template x-for="(transaction, index) in transactions" :key="index">
            <div class="flex mb-2 space-x-2">
                <input type="text" class="w-full py-2 rounded-md" placeholder="Número de operación"
                    :id="'transactions.' + index + '.number'" x-model="transaction.number" />

                <input type="text" class="w-full py-2 rounded-md" placeholder="Monto de la operación"
                    :id="'transactions.' + index + '.amount'" x-model="transaction.amount" />
            </div>
        </template>
    </div>
    <button class="px-4 py-2 mt-10 mb-4 text-sm font-bold rounded-sm bg-violet-100 text-violet-700"
        x-on:click="addMoreWire">
        Agregar más transferencias
        <x-mary-icon name="s-plus-circle" />
    </button>
    <hr class="my-4 border-t-2 border-gray-300 border-dotted">
    <div class="flex justify-between">
        <x-mary-button type="button"
            class="px-4 py-2 text-sm font-bold text-gray-400 bg-white border border-gray-400 rounded-sm hover:bg-white"
            x-on:click="$wire.dispatch('operation-cancelled')">
            Cancelar Operación
        </x-mary-button>
        <x-mary-button type="button"
            class="px-4 py-2 text-sm font-bold text-white border rounded-sm bg-violet-700 hover:bg-violet-800"
            wire:click='save' spinner='save'>
            Enviar Operación
        </x-mary-button>
    </div>
</x-mary-card>
@script
    <script>
        Alpine.data('number', () => ({
            transactions: $wire.entangle('form.transactions'),
            totalAmount: $wire.totalAmount,
            init() {
                this.transactions = [{
                    number: '',
                    amount: this.totalAmount
                }];
            },
            addMoreWire() {
                this.transactions.push({
                    number: '',
                    amount: ''
                });
            }
        }))
    </script>
@endscript
