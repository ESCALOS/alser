<section class="py-20 bg-home-primary">
    <div class="max-w-screen-xl px-6 mx-auto text-center text-white md:px-24">
        <h3 class="text-2xl">Entérate de las fluctuaciones del precio del dólar en el Perú</h3>
        <h4>Suscríbete y recibe el Tipo de Cambio Online semanalmente.</h4>
        <form wire:submit='send'>
            <div class="grid grid-cols-1 gap-2 py-6 md:grid-cols-3">
                <div class="col-span-1 md:col-span-2">
                    <x-input id="email" type="email" required class="block w-full h-full text-gray-900"
                        placeholder="Ingrese un correo electrónico" wire:model="email" />
                </div>
                <div>
                    <x-mary-button type="submit"
                        class="w-full text-white transition-colors duration-500 bg-amber-500 hover:bg-amber-600"
                        icon="o-envelope" spinner="send" label="Suscribirme" />
                </div>
            </div>
        </form>
    </div>
</section>
