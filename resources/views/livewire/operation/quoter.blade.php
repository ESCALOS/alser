<div class="w-full bg-white border border-gray-200 rounded-lg shadow" x-data="quoter">
    <div class="flex justify-center p-6 text-center h-96">
        <div class="w-full">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold">Nueva Operación</h1>
                <div wire:poll.15s='getPrices'>
                    <span class="pb-1 mr-4 font-semibold border-b-2 cursor-pointer hover:text-violet-600 text-md"
                        :class="$wire.isPurchase ? 'border-violet-500' : 'border-gray-300'"
                        x-on:click="$wire.isPurchase = true">
                        Dólar compra: {{ number_format($purchaseFactor, 4) }}
                    </span>
                    <span class="pb-1 mr-4 font-semibold border-b-2 cursor-pointer hover:text-violet-600 text-md"
                        :class="$wire.isPurchase ? 'border-gray-300' : 'border-violet-500'"
                        x-on:click="$wire.isPurchase = false">
                        Dólar venta: {{ number_format($salesFactor, 4) }}
                    </span>
                </div>
            </div>
            <div>
                <div class="grid grid-cols-2 gap-4 py-4">
                    <div>
                        <h3 class="text-xl font-semibold">
                            Envío
                            <span x-show="$wire.isPurchase">dólares</span>
                            <span x-show="!$wire.isPurchase">soles</span>
                        </h3>
                        <p class="text-xs text-gray-400">
                            Monto mínimo
                            <span x-show="$wire.isPurchase">$1.00</span>
                            <span x-show="!$wire.isPurchase">S/.4.00</span>
                        </p>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none">
                                <span class="text-gray-500 sm:text-2xl">
                                    <span x-show="$wire.isPurchase">$</span>
                                    <span x-show="!$wire.isPurchase">S/.</span>
                                </span>
                            </div>
                            <input id="input" type="text" wire:model='amountToSend'
                                x-on:input="updateAmountToReceive" x-mask:dynamic="$money($input)"
                                class="block w-full py-4 pr-4 text-2xl text-center border border-gray-300 rounded-lg pl-7 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    <div>
                        <h3 class="py-2 text-xl font-semibold">
                            Recibo
                            <span x-show="!$wire.isPurchase">dólares</span>
                            <span x-show="$wire.isPurchase">soles</span>
                        </h3>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none">
                                <span class="text-gray-500 sm:text-2xl">
                                    <span x-show="!$wire.isPurchase">$</span>
                                    <span x-show="$wire.isPurchase">S/.</span>
                                </span>
                            </div>
                            <input id="input" type="text" wire:model='amountToReceive'
                                x-on:input="updateAmountToSend" x-mask:dynamic="$money($input)"
                                class="block w-full py-4 pr-4 text-2xl text-center border border-gray-300 rounded-lg pl-7 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>
                <div>
                    <select class="w-full" name="algo" id="algo">
                        <option value="1">Mi primera cuenta</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        Alpine.data('quoter', () => ({
            isPurchase: $wire.entangle('isPurchase'),
            amountToSend: $wire.entangle('amountToSend'),
            amountToReceive: $wire.entangle('amountToReceive'),
            purchaseFactor: $wire.entangle('purchaseFactor'),
            salesFactor: $wire.entangle('salesFactor'),
            factor: 1,
            version: $wire.entangle('version'),

            init() {
                this.factor = this.isPurchase ? this.purchaseFactor : 1 / this.salesFactor
                this.$watch('isPurchase', value => {
                    this.factor = value ? this.purchaseFactor : 1 / this.salesFactor
                    this.updateAmountToReceive()
                });
                this.$watch('version', () => {
                    this.factor = this.isPurchase ? this.purchaseFactor : 1 / this.salesFactor
                    this.updateAmountToReceive()
                })
            },

            updateAmountToReceive() {
                const amountToSend = parseFloat(this.amountToSend.replace(/,/g, ''))
                this.amountToReceive = isNaN(amountToSend) ? 0 : (amountToSend * this.factor)
                    .toFixed(2);
            },
            updateAmountToSend() {
                const amountToReceive = parseFloat(this.amountToReceive.replace(/,/g, ''))
                this.amountToSend = isNaN(amountToReceive) ? 0 : (amountToReceive * this.factor).toFixed(
                    2);
            }
        }));
    </script>
@endscript
