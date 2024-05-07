<div>
    <x-mary-card title="{{ $item->name }}" subtitle="{{ $item->bank->name }} - {{ $item->currency_type->getLabel() }}"
        separator progress-indicator>
        <x-mary-button label="Editar" class="btn-warning"
            wire:click="$dispatch('fill-fields', { bankAccountId: {{ $item->id }} })" />
        <x-mary-button label="Eliminar" class="btn-error"
            wire:click="$dispatch('confirmDelete', { bankAccountId: {{ $item->id }}, name: '{{ $item->name }}' })" />
    </x-mary-card>
</div>
