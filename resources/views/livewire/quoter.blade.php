<div class="animate-zoom-in" x-data="{ active: true }">
    <div class="flex justify-center w-full">
        <div class="flex justify-between bg-white border-2 border-gray-300 rounded-full w-96">
            <div class="w-1/2 text-lg font-semibold text-center rounded-full cursor-pointer" @click="active = true"
                :class="active ? 'bg-indigo-700 text-white' : 'text-gray-700'">Cotizador</div>
            <div class="w-1/2 text-lg font-semibold text-center rounded-full cursor-pointer" @click="active = false"
                :class="!active ? 'bg-indigo-700 text-white' : 'text-gray-700'">Promo<span class="font-black">FLASH</span>
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="flex justify-center w-full mt-2"
            x-data="quoter"
            :class="!active ? 'absolute -z-10' : 'relative'"
            x-show="active"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">
        <div class="bg-white border border-gray-200 rounded-lg shadow w-96 dark:bg-gray-800 dark:border-gray-700">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg justify-evenly bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" role="tablist">
                <li class="me-2">
                    <button type="button" @click="purchase = true" role="tab" class="inline-block pt-4 font-black rounded-ss-lg" :class="purchase ? 'text-indigo-700 border-b border-indigo-700' : 'text-gray-600'">
                        Dólar Compra <br> <span class="font-bold text-md" x-text="$wire.purchaseFactor"></span>
                    </button>
                </li>
                <li class="me-2">
                    <button type="button" @click="purchase = false" role="tab" class="inline-block pt-4 font-black rounded-ss-lg" :class="!purchase ? 'text-indigo-700 border-b border-indigo-700' : 'text-gray-600'">
                        Dólar Venta <br> <span class="font-bold text-md" x-text="$wire.salesFactor"></span>
                    </button>
                </li>
            </ul>
            <div class="flex justify-center p-4 h-112">
                <div class="w-full">
                    <h1 class="text-xs font-semibold text-gray-700">Monto Mínimo:
                        <span x-show="purchase">$ 1.00</span>
                        <span x-show="!purchase">S/.3.80</span>
                    </h1>
                    <div class="relative p-4">
                        <div class="grid grid-cols-5 border border-indigo-700">
                            <div class="flex items-center justify-center col-span-2 bg-indigo-50">
                                <span class="font-bold text-indigo-700">
                                    <span x-show="!purchase">Soles</span>
                                    <span x-show="purchase">Dolares</span>
                                </span>
                            </div>
                            <div class="col-span-3 text-indigo-900">
                                <h1 class="pt-2 mr-4 text-xs text-right text-gray-700">Envio</h1>
                                <div class="flex items-center text-xl font-bold text-indigo-900">
                                    <div class="px-4">$ </div>
                                    <div>
                                        <input class="ml-4 text-lg text-right border-none w-28 md:w-32" x-model="dolarAmount" @input="updateSolAmount" style="box-shadow: none" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--icon exnchage-->
                        <div class="absolute flex items-center content-center justify-center cursor-pointer top-20 left-28" @click="purchase = !purchase">
                            <div class="transition duration-500 bg-indigo-700 rounded-full w-14 h-14 hover:rotate-180 hover:bg-indigo-500">
                                <i class="mt-2 text-4xl text-white fa-solid fa-rotate"></i>
                            </div>
                        </div>
                        <div class="grid grid-cols-5 mt-6 border border-indigo-700">
                            <div class="flex items-center justify-center col-span-2 bg-indigo-50">
                                <span class="font-bold text-indigo-700">
                                    <span x-show="purchase">Soles</span>
                                    <span x-show="!purchase">Dolares</span>
                                </span>
                            </div>
                            <div class="col-span-3 text-indigo-900">
                                <h1 class="pt-2 mr-4 text-xs text-right text-gray-700">Recibo</h1>
                                <div class="flex items-center text-xl font-bold text-indigo-900">
                                    <div class="px-4">S/. </div>
                                    <div>
                                        <input x-model="solAmount" @input="updateDolarAmount" class="text-lg text-right border-none w-28 md:w-32" style="box-shadow: none" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="block w-full px-6 py-4 my-10 text-lg text-white bg-indigo-700 rounded-sm hover:bg-indigo-600" wire:navigate href="{{ route('dashboard') }}">
                            Iniciar operación
                        </a>
                        <span class="block my-10 text-gray-500 text-md">
                            Para montos mayores a $5,000 o S/15,000. Hacer clic <a wire:navigate href="{{route('home.companies')}}" class="font-bold">aquí</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute flex justify-center w-full mt-2"
        :class="active ? 'absolute -z-10' : 'relative'"
        x-show="!active"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        <div class="bg-white border border-gray-200 rounded-lg shadow w-96 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-wrap items-center text-sm font-medium text-center text-gray-900 border-b border-gray-200 rounded-t-lg justify-evenly bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" style="height: 58px">
                <h1 class="text-lg font-bold">Todavia no hay una promoción</h1>
            </div>
            <div class="flex flex-col items-center justify-center p-4 h-112">
                <img class="mb-4" src="storage/images/promotion_search.svg">
                <div>
                    <div class="text-base text-gray-900 text-pretty">
                        Las PromoFLASH te permiten acceder a un tipo de cambio insuperable y están sujetas a condiciones como bancos específicos y monto mínimo
                    </div>
                    <div class="py-4 text-gray-500 text-md">
                        * Recuerda que estas promociones están disponibles solo por tiempo limitado.
                    </div>
                    <div class="pb-4 text-gray-500 text-md">
                        ¡Mantente atento!
                    </div>
                    <a class="block w-full px-6 py-4 text-xl text-white bg-indigo-700 rounded-sm hover:bg-indigo-600" wire:navigate href="{{ route('dashboard') }}">
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
                    purchase: true,
                    dolarAmount: 1000,
                    solAmount: 0,

                init() {
                    this.solAmount = 1000*{{ $purchaseFactor }};
                    this.$watch('purchase', () => this.updateSolAmount())
                },

                updateSolAmount() {
                    // Actualizar la cantidad de soles cuando cambia la cantidad de dólares
                    this.solAmount = this.purchase ? (this.dolarAmount * {{ $purchaseFactor }}).toFixed(2) : (this.dolarAmount / {{ $salesFactor }}).toFixed(2);
                },

                updateDolarAmount() {
                    // Actualizar la cantidad de dólares cuando cambia la cantidad de soles
                    this.dolarAmount = this.purchase ? (this.solAmount / {{ $purchaseFactor }}).toFixed(2) : (this.dolarAmount * {{ $salesFactor }}).toFixed(2);
                },
            }));
        })
    </script>
</div>
