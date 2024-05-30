<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Bank Accounts') }}
        </h2>
    </x-slot>
    <div wire:loading.delay><x-loader /></div>
    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg-px-8">
        <div class="grid grid-cols-2 p-6">
            <p class="text-2xl font-semibold">Mis cuentas bancarias</p>
            <div class="flex items-center justify-end">
                <button
                    class="px-2 py-1 border md:py-2 md:px-8 border-violet-700 text-violet-700 hover:bg-violet-700 hover:text-white"
                    x-on:click="$wire.dispatch('openModal', 1)">
                    <span class="hidden sm:inline">Añadir una cuenta bancaria</span>
                    <x-mary-icon class="w-4 h-4 sm:hidden" name="o-plus" />
                </button>
            </div>
        </div>
        @if (!$haveBothTypes)
            <div class="px-6 pb-2 text-orange-500">
                *Debes tener mínimo una cuenta bancaria en soles y una en dólares para hacer un cambio.
            </div>
        @endif
        <div class="mx-4 space-y-2">
            @foreach ($todos as $item)
                <livewire:bank-account :$item :key="$item->id" lazy />
            @endforeach
        </div>
    </div>
    <livewire:bank-account-modal />
</div>
