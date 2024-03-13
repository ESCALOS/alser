<section class="py-8 bg-gray-100 md:py-12">
    <div class="w-full px-4 text-center">
        <h2 class="text-2xl font-bold text-home-primary ">Tendencia del precio del dólar hoy</h2>
    </div>
    <div class="grid max-w-screen-xl grid-cols-1 gap-4 px-6 pt-6 mx-auto md:grid-cols-2">
        <livewire:graphics.dollar-fluctuation :isPurchase="true" />
        <livewire:graphics.dollar-fluctuation :isPurchase="false" />
    </div>
</section>
