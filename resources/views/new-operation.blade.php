<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New operation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="animate-zoom-in" x-cloak x-data="toggle">
                <div class="flex justify-center w-full">
                    <div
                        class="flex justify-between w-full max-w-3xl bg-white border-2 border-gray-300 rounded-full select-none">
                        <div id="toggle-quoter"
                            class="w-1/2 py-2 text-lg font-semibold text-center rounded-full cursor-pointer"
                            @click="active = true">Cotizador</div>
                        <div id="toggle-promo"
                            class="w-1/2 py-2 text-lg font-medium text-center rounded-full cursor-pointer"
                            @click="active = false"><span class="font-extrabold">ALSER</span> promos
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="flex justify-center w-full max-w-3xl mt-2" id="container-quoter" x-show="active"
                        x-transition:enter="transition-all ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-full"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition-all ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 translate-x-full">
                        <livewire:operation.quoter />
                    </div>
                    <div class="absolute flex justify-center w-full max-w-3xl mt-2 -z-10" id="container-promo"
                        x-show="!active" x-transition:enter="transition-all ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-full"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition-all ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 translate-x-full">
                        <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
                            <div class="flex flex-wrap items-center text-sm font-medium text-center text-gray-900 border-b border-gray-200 rounded-t-lg justify-evenly bg-gray-50"
                                style="height: 58px">
                                <h1 class="text-lg font-bold">Ninguna promo activa</h1>
                            </div>
                            <div class="flex flex-col items-center justify-around p-4 text-center h-96">
                                <img class="h-20 mb-4" src="{{ asset('images/promos/surprise.png') }}">
                                <div>
                                    <div class="text-base text-gray-900 text-pretty">
                                        Los <b>ALSERPROMOS</b> te permiten acceder a un tipo de cambio insuperable,
                                        específicos y por monto mínimo.
                                    </div>
                                    <div class="py-4 text-gray-500 text-md">
                                        Estas promociones son por tiempo limitado.
                                    </div>
                                    <span
                                        class="block w-full px-6 py-4 text-xl text-white transition-colors duration-300 rounded-sm cursor-pointer bg-home-primary hover:bg-violet-900"
                                        @click="active = true">
                                        Ir al cotizador
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
