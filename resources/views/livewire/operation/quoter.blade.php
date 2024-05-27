<div class="bg-white border border-gray-200 rounded-lg shadow w-96" x-data="quoter">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg select-none justify-evenly bg-gray-50"
        role="tablist">
        <li class="me-2">
            <button type="button" @click="purchase = true" role="tab" id="tab-purchase"
                class="inline-block pt-4 font-black border-b border-indigo-700 rounded-ss-lg text-home-primary">
                Dólar Compra <br> <span class="font-bold text-md" x-text="$wire.purchaseFactor"></span>
            </button>
        </li>
        <li class="me-2">
            <button type="button" @click="purchase = false" role="tab" id="tab-sales"
                class="inline-block pt-4 font-black text-gray-600 rounded-ss-lg">
                Dólar Venta <br> <span class="font-bold text-md" x-text="$wire.salesFactor"></span>
            </button>
        </li>
    </ul>
    <div class="flex justify-center p-4 text-center h-96">
        <div class="w-full">
            <h1 class="text-xs font-semibold text-gray-700">Monto Mínimo:
                <span x-show="purchase">$ 1.00</span>
                <span x-show="!purchase">S/.3.80</span>
            </h1>
            <div class="relative p-4">
                <div class="grid grid-cols-5 border border-indigo-700 rounded-2xl">
                    <div class="flex items-center justify-center col-span-2 rounded-l-2xl bg-indigo-50">
                        <span class="font-bold text-home-primary">
                            <span x-show="!purchase">Soles</span>
                            <span x-show="purchase">Dólares</span>
                        </span>
                    </div>
                    <div class="col-span-3 text-indigo-900">
                        <h1 class="pt-2 mr-4 text-xs text-right text-gray-700">Envio</h1>
                        <div class="flex items-center text-xl font-medium text-indigo-900">
                            <div class="w-16 pl-4 text-left">
                                <span x-show="purchase">$</span>
                                <span x-show="!purchase">S/.</span>
                            </div>
                            <div>
                                <input id="inputDolar"
                                    class="pt-0 text-lg text-right border-none rounded-2xl w-28 md:w-32"
                                    x-model="dolarAmount" @input="updateSolAmount" style="box-shadow: none"
                                    type="text" x-mask:dynamic="$money($input)" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--icon exnchage-->
                <div class="absolute flex items-center content-center justify-center cursor-pointer top-16 left-28"
                    @click="purchase = !purchase">
                    <div
                        class="transition-all duration-300 rounded-full bg-home-primary w-14 h-14 hover:rotate-180 hover:bg-violet-900">
                        <i class="mt-2 text-4xl text-white fa-solid fa-rotate"></i>
                    </div>
                </div>
                <div class="grid grid-cols-5 mt-6 border border-home-primary rounded-2xl">
                    <div class="flex items-center justify-center col-span-2 rounded-l-2xl bg-indigo-50">
                        <span class="font-bold text-home-primary">
                            <span x-show="purchase">Soles</span>
                            <span x-show="!purchase">Dólares</span>
                        </span>
                    </div>
                    <div class="col-span-3 text-indigo-900">
                        <h1 class="pt-2 mr-4 text-xs text-right text-gray-700">Recibo</h1>
                        <div class="flex items-center text-xl font-medium text-indigo-900">
                            <div class="w-16 pl-4 text-left">
                                <span x-show="!purchase">$</span>
                                <span x-show="purchase">S/.</span>
                            </div>
                            <div>
                                <input x-model="solAmount" @input="updateDolarAmount"
                                    class="pt-0 text-lg text-right border-none rounded-2xl w-28 md:w-32"
                                    style="box-shadow: none" type="text" x-mask:dynamic="$money($input)" />
                            </div>
                        </div>
                    </div>
                </div>
                <a class="block w-full px-6 py-4 my-6 text-lg text-white transition-colors duration-300 rounded-sm bg-home-primary hover:bg-violet-900"
                    wire:navigate href="{{ route('new-operation') }}">
                    Iniciar operación
                </a>
                <span class="block text-gray-500 text-md">
                    Para montos mayores a $5,000 o S/15,000. Hacer clic <a wire:navigate
                        href="{{ route('home.companies') }}" class="font-bold">aquí</a>
                </span>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        Alpine.data('quoter', () => ({
            purchase: true,
            dolarAmount: 1000,
            solAmount: 0,
            purchasePrice: {{ $purchaseFactor }},
            salesPrice: {{ $salesFactor }},

            init() {
                this.solAmount = (1000 * this.purchasePrice).toFixed(2);
                this.togglePurchaseClass(true);
                this.$watch('purchase', value => {
                    this.updateSolAmount();
                    this.togglePurchaseClass(value);
                    document.getElementById("inputDolar").focus();
                });
            },

            updateSolAmount() {
                const dolarAmount = parseFloat(this.dolarAmount.replace(/,/g, ''));
                this.solAmount = isNaN(dolarAmount) ? 0 : (this.purchase ? (dolarAmount * this.purchasePrice)
                    .toFixed(
                        2) : (dolarAmount / this.salesPrice).toFixed(2));
            },

            updateDolarAmount() {
                const solAmount = parseFloat(this.solAmount.replace(/,/g, ''));
                this.dolarAmount = isNaN(solAmount) ? 0 : (this.purchase ? (solAmount / this.purchasePrice)
                    .toFixed(
                        2) : (solAmount * this.salesPrice).toFixed(2));
            },

            togglePurchaseClass(purchase) {
                if (purchase) {
                    //active tab-purchase
                    document.getElementById('tab-purchase').classList.add(
                        'text-home-primary');
                    document.getElementById('tab-purchase').classList.add('border-b');
                    document.getElementById('tab-purchase').classList.add(
                        'border-indigo-700');
                    document.getElementById('tab-purchase').classList.remove(
                        'border-gray-600');
                    //inactive tab-sales
                    document.getElementById('tab-sales').classList.remove(
                        'text-home-primary');
                    document.getElementById('tab-sales').classList.remove('border-b');
                    document.getElementById('tab-sales').classList.remove(
                        'border-indigo-700');
                    document.getElementById('tab-sales').classList.add(
                        'border-gray-600');
                } else {
                    //inactive tab-purchase
                    document.getElementById('tab-purchase').classList.remove(
                        'text-home-primary');
                    document.getElementById('tab-purchase').classList.remove('border-b');
                    document.getElementById('tab-purchase').classList.remove(
                        'border-indigo-700');
                    document.getElementById('tab-purchase').classList.add(
                        'border-gray-600');
                    //active tab-sales
                    document.getElementById('tab-sales').classList.add(
                        'text-home-primary');
                    document.getElementById('tab-sales').classList.add('border-b');
                    document.getElementById('tab-sales').classList.add(
                        'border-indigo-700');
                    document.getElementById('tab-sales').classList.remove(
                        'border-gray-600');
                }
            }
        }));
    </script>
@endscript
