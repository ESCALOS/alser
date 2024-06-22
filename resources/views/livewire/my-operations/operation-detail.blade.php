<div class="p-6 rounded-lg bg-base-100">
    @if ($areThereOperations)
        @if ($status !== '')
            <p class="text-gray-500">Detalle de la operación</p>
            <div class="flex justify-between mb-4">
                <p class="text-2xl font-bold text-gray-500">{{ $status }}</p>
                <p class="text-gray-500">{{ $date }}</p>
            </div>
            <hr>
        @else
            <p>Sin Operación</p>
        @endif
    @else
        <p>No tienes operaciones</p>
    @endif
    <div wire:loading.delay><x-loader /></div>
</div>
