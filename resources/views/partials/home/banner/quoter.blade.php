<div class="py-4 md:pb-12">
    <div class="animate-zoom-in" x-data="toggle">
        <div class="flex justify-center w-full">
            <div class="flex justify-between bg-white border-2 border-gray-300 rounded-full select-none w-96">
                <div id="toggle-quoter" class="w-1/2 py-2 text-lg font-semibold text-center rounded-full cursor-pointer"
                    @click="active = true">Cotizador</div>
                <div id="toggle-promo" class="w-1/2 py-2 text-lg font-medium text-center rounded-full cursor-pointer"
                    @click="active = false"><span class="font-extrabold">ALSER</span> promos
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="flex justify-center w-full mt-2" id="container-quoter" x-show="active"
                x-transition:enter="transition-all ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition-all ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 translate-x-full">
                <livewire:quoter />
            </div>
            <div class="absolute flex justify-center w-full mt-2 -z-10" id="container-promo" x-show="!active"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-full"
                x-transition:enter-end="opacity-100  translate-x-0" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 translate-x-full">
                <x-home.promo />
            </div>
        </div>
    </div>
</div>
