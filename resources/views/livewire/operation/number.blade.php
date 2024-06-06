<x-mary-card x-data="number">
    <div class="flex items-center">
        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-lime-500">
            <p class="font-bold text-white text-md">2</p>
        </div>
        <span class="ml-2 font-bold text-md text-violet-900">Ingresa el N° de operación</span>
    </div>
    <div class="my-4">
        <p class="text-gray-700">Ubica el N° de operación de la transferencia realizada e ingrésalo a continuación</p>
        <span class="font-semibold underline cursor-pointer text-violet-700" x-on:click="howFoundMessage">¿Cómo lo
            encuentro?</span>
    </div>
    <div id="transferencias">
        <template x-for="(transaction, index) in transactions" :key="index">
            <div class="flex mb-2 space-x-2">
                <div class="w-full">
                    <input type="number" class="w-full py-2 rounded-md" placeholder="Número de operación"
                        :id="'transactions.' + index + '.number'" x-model="transaction.number" />
                </div>
                <div class="w-full" x-show="transactions.length > 1">
                    <input type="number" class="w-full py-2 rounded-md" placeholder="Monto de la operación"
                        :id="'transactions.' + index + '.amount'" x-model="transaction.amount"
                        @input="calculateTotal" />
                </div>
                <div x-show="index !== 0">
                    <x-mary-icon name="o-trash" class="m-2 text-red-600 cursor-pointer h-7"
                        x-on:click="removeTransaction(index)" />
                </div>
        </template>
    </div>
    <div class="mt-4 font-bold text-violet-700" x-show="transactions.length > 1">
        <span>Total: {{ $this->currencySymbol }} </span>
        <span
            :class="accumulatedAmount < totalAmount ? 'text-red-700' : (accumulatedAmount > totalAmount ? 'text-amber-700' :
                'text-violet-700')"
            x-text="accumulatedAmount"></span>
        <span>/ {{ $operation->amount_to_send }}</span>
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
        <div x-show="accumulatedAmount === totalAmount" x-cloak>
            <x-mary-button type="button"
                class="px-4 py-2 text-sm font-bold text-white border rounded-sm bg-violet-700 hover:bg-violet-800"
                wire:click='save' spinner='save'>
                Enviar Operación
            </x-mary-button>
        </div>
        <div x-show="accumulatedAmount < totalAmount" x-cloak>
            <div
                class="px-4 py-2 font-bold text-white bg-red-700 border rounded-sm cursor-not-allowed text-md hover:bg-red-800">
                Montos insuficientes
            </div>
        </div>
        <div x-show="accumulatedAmount > totalAmount" x-cloak>
            <div
                class="px-4 py-2 font-bold text-white border rounded-sm cursor-not-allowed text-md bg-amber-700 hover:bg-amber-800">
                Montos excesivos
            </div>
        </div>
    </div>
</x-mary-card>
@script
    <script>
        Alpine.data('number', () => ({
            transactions: $wire.entangle('form.transactions'),
            totalAmount: $wire.totalAmount,
            accumulatedAmount: $wire.totalAmount,
            init() {
                this.transactions = [{
                    number: '',
                    amount: this.totalAmount
                }];
            },
            addMoreWire() {
                if (this.transactions.length === 1) {
                    this.transactions[0].amount = ''
                    this.accumulatedAmount = 0
                }
                this.transactions.push({
                    number: '',
                    amount: ''
                })
            },
            removeTransaction(index) {
                if (index === 0) {
                    return;
                }
                this.transactions.splice(index, 1);
                this.calculateTotal();
            },
            calculateTotal() {
                this.accumulatedAmount = this.transactions.reduce((total, transaction) => {
                    let amount = parseFloat(transaction.amount);
                    return total + (isNaN(amount) ? 0 : amount);
                }, 0);
            },
            howFoundMessage() {
                Swal.fire({
                    title: "<strong>¿Cómo encuentro mi N° de operación?</strong>",
                    text: "Para obtener el número de operación de la transferencia a la cuenta de Alser Cambio indicada en el paso 1 mediante la app o banca por internet de tu banco. Una vez realizada la transferencia, podrás visualizar dicho código en la confirmación de ésta en la plataforma de tu banco.",
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            }
        }))
    </script>
@endscript
