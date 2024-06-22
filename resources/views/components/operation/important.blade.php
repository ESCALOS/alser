<x-mary-card>
    <h2 class="text-2xl font-bold text-red-400">Importante</h2>
    <p class="my-4 text-sm">
        Has seleccionado una cuenta de <b>origen</b> {{ $originBank }}.
        Ten en consideración que:
    </p>
    <ul class="pl-6 text-sm list-disc">
        <li>
            <b>Si depositas el dinero en efectivo la solicitud será rechazada</b> y te devolveremos el dinero,
            descontando las comisiones cobradas por el banco.
        </li>
        <li>
            <b>Solo puede usar el canal web o app de {{ $originBank }} para realizar la transferencia.</b> De lo
            contrario, te
            devolveremos el dinero, descontando las comisiones cobradas por el banco.
        </li>
    </ul>
    <p class="my-4 text-sm">
        Has seleccionado una cuenta de <b>destino</b> {{ $destinationBank }} de provincia. Ten en consideración que:
    </p>
    <ul class="pl-6 text-sm list-disc">
        <li>
            Para esta operación recibirás tu dinero en un promedio de <b>15 minutos (hasta 45 minutos</b> para montos
            mayores a 5,000 dólares o tipo de cambio preferencial).
        </li>
    </ul>
</x-mary-card>
