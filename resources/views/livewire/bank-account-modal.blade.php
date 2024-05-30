<div x-data="modal">
    <x-mary-drawer wire:model="showDrawer" title="Nueva Cuenta Bancaria"
        subtitle="Añade la cuenta bancaria desde donde quieres enviar o recibir tu dinero" right separator
        class="w-11/12 lg:w-2/3">
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
@script
    <script>
        Alpine.data('modal', () => ({
            showDrawer: $wire.showDrawer,
            init() {
                this.$watch('', value => {
                    if (value) {
                        let inputErrrors = document.getElementsByClassName('input-error');
                        let errors = document.getElementsByClassName('text-red-500');
                        for (let i = 0; i < inputErrrors.length; i++) {
                            inputErrrors[i].classList.remove('input-error');
                        }
                        for (let i = 0; i < errors.length; i++) {
                            errors[i].classList.add('hidden');
                        }
                    }
                })
            }
        }))
        Livewire.on('openModal', (currency) => {
            $wire.form.bankAccountId = 0
            $wire.form.accountNumber = ''
            $wire.form.name = ''
            $wire.form.currencyType = currency
            $wire.showDrawer = true
        })
    </script>
@endscript
