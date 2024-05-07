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
            <div class="flex justify-end">
                <button class="px-8 py-2 border border-violet-700 text-violet-700 hover:bg-violet-700 hover:text-white"
                    x-on:click="$wire.form.bankAccountId = 0; $wire.form.accountNumber = ''; $wire.form.name = ''; $wire.showDrawer = true">
                    <span class="hidden sm:inline">Añadir una cuenta bancaria</span>
                    <x-mary-icon class="w-8 h-8 sm:hidden" name="o-plus" />
                </button>
            </div>
        </div>
        <div class="space-y-2">
            @foreach ($todos as $item)
                <livewire:bank-account :$item :key="$item->id" lazy />
            @endforeach
        </div>
    </div>
    <x-mary-drawer wire:model="showDrawer" title="Nueva Cuenta Bancaria"
        subtitle="Añade la cuenta bancaria desde donde quieres enviar o recibir tu dinero" right separator
        class="w-11/12 lg:w-3/5">
        <x-mary-form wire:submit="save">
            <div class="grid gap-3 md:grid-cols-2">
                <input type="hidden" wire:model='form.bankAccountId' />
                <x-mary-choices-offline label="Departamento" wire:model="form.locationDepartmentId" :options="$departments"
                    single searchable no-result-text="Departamento no encontrado." />
                <x-mary-choices-offline label="Entidad bancaria" wire:model="form.bankId" :options="$banks" single />
                <x-mary-choices-offline label="Tipo de cuenta" wire:model="form.bankAccountType" :options="$bankAccountTypes"
                    single />
                <x-mary-choices-offline label="Tipo de moneda" wire:model="form.currencyType" :options="$currencies"
                    single />
                <div class="col-span-1 md:col-span-2">
                    <x-mary-input label="Número de cuenta" wire:model="form.accountNumber" />
                </div>
                <div class="col-span-1 md:col-span-2">
                    <x-mary-input label="Alias de la cuenta" wire:model="form.name" />
                </div>
            </div>

            <x-slot:actions>
                <x-mary-button label="Cancelar" x-on:click="$wire.showDrawer = false" />
                <x-mary-button label="Guardar" class="btn-primary" type="submit" icon="o-check" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-drawer>
</div>
