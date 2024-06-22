<div>
    <x-mary-card separator progress-indicator>
        <div class="flex justify-between">
            <div>
                <x-mary-icon name="o-credit-card" class="w-8 mr-2 text-lime-500" />
                <span class="text-lg font-semibold text-blue-900">
                    {{ $item->name }}

                </span>
            </div>
            <div class="flex space-x-4">
                <div wire:click="$dispatch('fill-fields', { bankAccountId: {{ $item->id }} })">
                    <x-mary-icon name="s-pencil" class="w-5 cursor-pointer text-amber-500" />
                </div>
                <div wire:click="$dispatch('delete', { bankAccountId: {{ $item->id }} })"
                    wire:confirm="¿Desea eliminar la cuenta {{ $item->name }}?">
                    <x-mary-icon name="o-trash" class="w-5 text-red-600 cursor-pointer" />
                </div>
            </div>

        </div>
        <div class="grid grid-cols-1 pt-4 md:grid-cols-3">
            <div class="hidden text-sm text-blue-900 md:block">
                <span>N° de cuenta:</span>
                <span class="font-bold">{{ $item->account_number }}</span>
            </div>
            <div class="text-sm text-blue-900">
                <span>Entidad bancaria:</span>
                <span class="font-bold">{{ $item->bank->name }}</span>
            </div>
            <div class="text-sm text-blue-900">
                <span>Tipo de Moneda:</span>
                <span class="font-bold">{{ $item->currency_type->getLabel() }}</span>
            </div>
        </div>
    </x-mary-card>
</div>
