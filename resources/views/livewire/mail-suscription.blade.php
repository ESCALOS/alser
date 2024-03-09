<section class="py-8 bg-home-primary">
    <div class="max-w-screen-xl px-6 mx-auto text-center text-white md:px-24">
        <h3 class="text-2xl">Entérate de las fluctuaciones del precio del dólar en el Perú</h3>
        <h4>Suscríbete y recibe el Tipo de Cambio Online semanalmente.</h4>
        <form wire:submit='send'>
            <div class="grid grid-cols-1 gap-4 py-6 md:grid-cols-3">
                <div class="col-span-1 md:col-span-2">
                    <x-input-jet id="email" type="email" required class="block w-full text-gray-900" placeholder="Ingrese su correo electrónico" wire:model="email" />
                </div>
                <div>
                    <x-button type="submit" spinner="send" class="w-full" md icon="envelope" warning label="Suscribirme" />
                </div>
            </div>
        </form>
    </div>
    <x-notifications />
</section>
