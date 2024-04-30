<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Bank Accounts') }}
        </h2>
    </x-slot>
    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg-px-8">
        <div class="grid grid-cols-2 px-6">
            <p class="text-2xl font-semibold">Mis cuentas bancarias</p>
            <div class="flex justify-end">
                <button class="px-4 py-2 border border-violet-700 text-violet-700 hover:bg-violet-700 hover:text-white"
                    x-on:click="$wire.showDrawer = true">
                    <span class="hidden sm:inline">Añadir una cuenta bancaria</span><x-mary-icon class="sm:hidden"
                        name="o-plus" />
                </button>
            </div>
        </div>
    </div>
    <x-mary-drawer wire:model="showDrawer" title="Nueva Cuenta Bancaria"
        subtitle="Añade la cuenta bancaria desde donde quieres enviar o recibir tu dinero" right separator
        class="w-11/12 lg:w-1/3">
        <x-mary-form wire:submit="save">
            <div class="grid grid-cols-2 gap-3">
                <x-mary-choices-offline label="Departamento" wire:model="form.location_department_id" :options="$this->departments"
                    single searchable no-result-text="Departamento no encontrado." />
                <x-mary-choices-offline label="Entidad bancaria" wire:model="form.bank_id" :options="$this->banks" single />
                <x-mary-choices-offline label="Tipo de cuenta" wire:model="form.bank_account_type" :options="$bankAccountTypes"
                    single />
                <x-mary-choices-offline label="Tipo de moneda" wire:model="form.currency_type" :options="$currencies"
                    single />
                <div class="col-span-2">
                    <x-mary-input label="Número de cuenta" wire:model="form.account_number" />
                </div>
                <div class="col-span-2">
                    <x-mary-input label="Alias de la cuenta" wire:model="form.name" />
                </div>
            </div>
            <x-slot:actions>
                <x-mary-button label="Cancel" x-on:click="$wire.showDrawer = false" />
                <x-mary-button label="Confirm" class="btn-primary" type="submit" icon="o-check" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-drawer>
</div>
