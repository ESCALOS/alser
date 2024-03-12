<div>
    <div class="animate-zoom-in" x-data="quoter">
        <div class="flex justify-center w-full">
            <div class="flex justify-between bg-white border-2 border-gray-300 rounded-full select-none w-96">
                <div id="toggle-quoter"
                    class="w-1/2 py-2 text-lg font-semibold text-center text-white rounded-full cursor-pointer bg-home-primary"
                    @click="active = true">Cotizador</div>
                <div id="toggle-promo"
                    class="w-1/2 py-2 text-lg font-medium text-center text-gray-700 rounded-full cursor-pointer"
                    @click="active = false"><span class="font-extrabold">ALSER</span> promos
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="relative flex justify-center w-full mt-2" id="container-quoter" x-show="active"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                <div
                    class="bg-white border border-gray-200 rounded-lg shadow w-96 dark:bg-gray-800 dark:border-gray-700">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg select-none justify-evenly bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
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
                    <div class="flex justify-center p-4 h-96">
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
                                            <span x-show="purchase">Dolares</span>
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
                                                <input
                                                    class="pt-0 ml-2 text-lg text-right border-none rounded-2xl w-28 md:w-32"
                                                    x-model="dolarAmount" @input="updateSolAmount"
                                                    style="box-shadow: none" type="text" />
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
                                            <span x-show="!purchase">Dolares</span>
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
                                                    style="box-shadow: none" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="block w-full px-6 py-4 my-6 text-lg text-white transition-colors duration-300 rounded-sm bg-home-primary hover:bg-violet-900"
                                    wire:navigate href="{{ route('dashboard') }}">
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
            </div>
            <div class="absolute flex justify-center w-full mt-2 -z-10" id="container-promo" x-show="!active"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                <div
                    class="bg-white border border-gray-200 rounded-lg shadow w-96 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-wrap items-center text-sm font-medium text-center text-gray-900 border-b border-gray-200 rounded-t-lg justify-evenly bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
                        style="height: 58px">
                        <h1 class="text-lg font-bold">Ninguna promo activa</h1>
                    </div>
                    <div class="flex flex-col items-center justify-around p-4 h-96">
                        <img class="h-20 mb-4" src="storage/images/surprise.png">
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
            </div>
        </div>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('quoter', () => ({
                    active: true,
                    purchase: true,
                    dolarAmount: 1000,
                    solAmount: 0,

                    init() {
                        this.solAmount = 1000 * {{ $purchaseFactor }};
                        this.$watch('purchase', () => {
                            this.updateSolAmount();
                            document.getElementById('tab-purchase').classList.toggle(
                                'text-home-primary');
                            document.getElementById('tab-purchase').classList.toggle('border-b');
                            document.getElementById('tab-purchase').classList.toggle(
                                'border-indigo-700');
                            document.getElementById('tab-purchase').classList.toggle(
                                'border-gray-600');
                            document.getElementById('tab-sales').classList.toggle(
                                'text-home-primary');
                            document.getElementById('tab-sales').classList.toggle('border-b');
                            document.getElementById('tab-sales').classList.toggle(
                                'border-indigo-700');
                            document.getElementById('tab-sales').classList.toggle(
                            'border-gray-600');
                        });
                        this.$watch('active', () => {
                            document.getElementById('toggle-quoter').classList.toggle(
                                'bg-home-primary');
                            document.getElementById('toggle-quoter').classList.toggle('text-white');
                            document.getElementById('toggle-quoter').classList.toggle(
                                'tex-gray-700');
                            document.getElementById('toggle-promo').classList.toggle(
                                'bg-home-primary');
                            document.getElementById('toggle-promo').classList.toggle('text-white');
                            document.getElementById('toggle-promo').classList.toggle(
                            'tex-gray-700');
                            document.getElementById('container-quoter').classList.toggle(
                            'absolute');
                            document.getElementById('container-quoter').classList.toggle('-z-10');
                            document.getElementById('container-quoter').classList.toggle(
                            'relative');
                            document.getElementById('container-promo').classList.toggle('absolute');
                            document.getElementById('container-promo').classList.toggle('-z-10');
                            document.getElementById('container-promo').classList.toggle('relative');
                        });
                    },

                    updateSolAmount() {
                        // Actualizar la cantidad de soles cuando cambia la cantidad de dólares
                        this.solAmount = this.purchase ? (this.dolarAmount * {{ $purchaseFactor }}).toFixed(
                            2) : (this.dolarAmount / {{ $salesFactor }}).toFixed(2);
                    },

                    updateDolarAmount() {
                        // Actualizar la cantidad de dólares cuando cambia la cantidad de soles
                        this.dolarAmount = this.purchase ? (this.solAmount / {{ $purchaseFactor }}).toFixed(
                            2) : (this.dolarAmount * {{ $salesFactor }}).toFixed(2);
                    },
                }));

            })
        </script>
    </div>
</div>
