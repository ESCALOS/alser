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
                    x-on:click="$wire.form.bankAccountId = 0; $wire.form.accountNumber = ''; $wire.form.name = ''; $wire.showDrawer = true">
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
    <div x-data="{ showDrawer: @entangle('showDrawer') }" x-init="$watch('showDrawer', () => {
        let inputErrrors = document.getElementsByClassName('input-error');
        let errors = document.getElementsByClassName('text-red-500');
        for (let i = 0; i < inputErrrors.length; i++) {
            inputErrrors[i].classList.remove('input-error');
        }
        for (let i = 0; i < errors.length; i++) {
            errors[i].classList.add('hidden');
        }
    })">
        <x-mary-drawer wire:model="showDrawer" title="Nueva Cuenta Bancaria"
            subtitle="Añade la cuenta bancaria desde donde quieres enviar o recibir tu dinero" right separator
            class="w-11/12 lg:w-2/3">
            <x-mary-form wire:submit="save">
                <div class="grid gap-3 md:grid-cols-2">
                    <input type="hidden" wire:model='form.bankAccountId' />
                    <x-mary-choices-offline label="Departamento" wire:model="form.locationDepartmentId"
                        :options="$departments" single searchable no-result-text="Departamento no encontrado." />
                    <x-mary-choices-offline label="Entidad bancaria" wire:model="form.bankId" :options="$banks"
                        single />
                    <x-mary-choices-offline label="Tipo de cuenta" wire:model="form.bankAccountType" :options="$bankAccountTypes"
                        single />
                    <x-mary-choices-offline label="Tipo de moneda" wire:model="form.currencyType" :options="$currencies"
                        single />
                    <div class="col-span-1 md:col-span-2">
                        <x-mary-input label="Número de cuenta" wire:model="form.accountNumber"
                            x-mask:dynamic="(value) => {
                                switch ($wire.form.bankId) {
                                    case 1:
                                        return '999-99999999-9-99';
                                    case 2:
                                        return '999-9999999999';
                                    default:
                                        return '9999999999999999999999999';
                                }
                            }" />
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
</div>
