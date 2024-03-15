<section class="py-8 bg-gray-100 md:py-12">
    <div class="w-full px-4 text-center">
        <h2 class="text-2xl font-bold text-home-primary ">Variación del tipo de cambio a lo largo del día.</h2>
    </div>
    <div class="grid max-w-screen-xl grid-cols-1 gap-4 px-6 pt-6 mx-auto md:grid-cols-2">
        <livewire:graphics.dollar-fluctuation :prices="$prices" :isPurchase="true" :lastPrice="$lastPrice" />
        <livewire:graphics.dollar-fluctuation :prices="$prices" :isPurchase="false" :lastPrice="$lastPrice" />
    </div>
</section>
