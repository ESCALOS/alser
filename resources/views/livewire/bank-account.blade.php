<div>
    <x-mary-card title="{{ $item->name }}" subtitle="{{ $item->bank->name }} - {{ $item->currency_type->getLabel() }}"
        separator progress-indicator>
        <x-slot:menu>
            <x-mary-button tooltip="Editar" icon="o-pencil"
                wire:click="$dispatch('fill-fields', { bankAccountId: {{ $item->id }} })"
                class="text-amber-500 btn-circle btn-sm btn-outline hover:border-amber-500 hover:bg-amber-500 hover:text-white" />
            <x-mary-button tooltip="Eliminar" icon="o-trash"
                class="text-red-500 btn-circle btn-outline btn-sm hover:bg-red-500 hover:border-red-500 hover:text-white"
                wire:click="$dispatch('delete', { bankAccountId: {{ $item->id }} })"
                wire:confirm="¿Desea eliminar la cuenta {{ $item->name }}?" />
        </x-slot:menu>
    </x-mary-card>
</div>
