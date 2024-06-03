<div class="w-full bg-white border border-gray-200 rounded-lg shadow" x-data="quoter">
    <div class="flex justify-center p-6">
        <div class="w-full">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold">Nueva Operación</h1>
                {{-- <div wire:poll.15s='getPrices'> --}}
                <div>
                    <span class="pb-1 mr-4 font-semibold border-b-2 cursor-pointer hover:text-violet-600 text-md"
                        :class="$wire.form.isPurchase ? 'border-violet-500' : 'border-gray-300'"
                        x-on:click="$wire.form.isPurchase = true">
                        Dólar compra: {{ number_format($purchaseFactor, 4) }}
                    </span>
                    <span class="pb-1 mr-4 font-semibold border-b-2 cursor-pointer hover:text-violet-600 text-md"
                        :class="$wire.form.isPurchase ? 'border-gray-300' : 'border-violet-500'"
                        x-on:click="$wire.form.isPurchase = false">
                        Dólar venta: {{ number_format($salesFactor, 4) }}
                    </span>
                </div>
            </div>
            <div>
                <div class="grid grid-cols-2 gap-4 py-4">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold">
                            Envío
                            <span x-show="$wire.form.isPurchase">dólares</span>
                            <span x-show="!$wire.form.isPurchase">soles</span>
                        </h3>
                        <p class="text-xs text-gray-400">
                            Monto mínimo
                            <span x-show="$wire.form.isPurchase">$1.00</span>
                            <span x-show="!$wire.form.isPurchase">S/.4.00</span>
                        </p>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none">
                                <span class="text-gray-500 sm:text-2xl">
                                    <span x-show="$wire.form.isPurchase">$</span>
                                    <span x-show="!$wire.form.isPurchase">S/.</span>
                                </span>
                            </div>
                            <input id="input" type="text" wire:model='form.amountToSend'
                                x-on:input="updateAmountToReceive" x-mask:dynamic="$money($input)"
                                class="block w-full py-4 pr-4 text-2xl text-center border border-gray-300 rounded-lg pl-7 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="py-2 text-xl font-semibold">
                            Recibo
                            <span x-show="!$wire.form.isPurchase">dólares</span>
                            <span x-show="$wire.form.isPurchase">soles</span>
                        </h3>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none">
                                <span class="text-gray-500 sm:text-2xl">
                                    <span x-show="!$wire.form.isPurchase">$</span>
                                    <span x-show="$wire.form.isPurchase">S/.</span>
                                </span>
                            </div>
                            <input id="input" type="text" wire:model='form.amountToReceive'
                                x-on:input="updateAmountToSend" x-mask:dynamic="$money($input)"
                                class="block w-full py-4 pr-4 text-2xl text-center border border-gray-300 rounded-lg pl-7 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-4">
                    <div class="h-32 transition-all"
                        :class="!$wire.form.isPurchase ? 'translate-y-0' : 'translate-y-32'">
                        <div x-show='$wire.solAccounts'>
                            <p class="my-2 text-sm font-semibold">
                                <span x-show='!$wire.form.isPurchase'>¿Desde que cuenta nos envías los soles?</span>
                                <span x-show='$wire.form.isPurchase'>¿En qué cuenta deseas recibir los soles?</span>
                            </p>
                            <x-mary-choices wire:model="form.solAccount" @change-selection="resetValidation()"
                                :options="$solAccounts" option-label="account_number" option-sub-label="name"
                                option-avatar="bank_logo" icon="o-credit-card" height="max-h-96" single />
                            <p class="my-4 text-sm font-semibold text-right cursor-pointer text-violet-700"
                                x-on:click="$wire.dispatch('openModal',1)">
                                Agregar nueva cuenta bancaria soles <x-mary-icon class="w-7" name="o-plus-circle" />
                            </p>
                        </div>
                        <div x-show='!$wire.solAccounts' class="pt-6">
                            <button type="button"
                                class="w-full py-6 text-lg font-semibold transition-colors duration-300 bg-white border rounded-md text-violet-900 border-violet-900"
                                x-on:click="$wire.dispatch('openModal',1)">
                                Agregar nueva cuenta bancaria soles <x-mary-icon class="w-7" name="o-plus-circle" />
                            </button>
                        </div>
                    </div>
                    <div class="h-32 transition-all"
                        :class="!$wire.form.isPurchase ? 'translate-y-0' : '-translate-y-32'">
                        <div x-show='$wire.dollarAccounts'>
                            <p class="my-2 text-sm font-semibold">
                                <span x-show='$wire.form.isPurchase'>¿Desde que cuenta nos envías los dólares?</span>
                                <span x-show='!$wire.form.isPurchase'>¿En qué cuenta deseas recibir los dólares?</span>
                            </p>
                            <x-mary-choices @change-selection="resetValidation()" wire:model="form.dollarAccount"
                                :options="$dollarAccounts" option-label="account_number" option-sub-label="name"
                                option-avatar="bank_logo" icon="o-credit-card" height="max-h-96" single />
                            <p class="my-4 text-sm font-semibold text-right cursor-pointer text-violet-700"
                                x-on:click="$wire.dispatch('openModal',2)">
                                Agregar nueva cuenta bancaria dólares <x-mary-icon class="w-7"
                                    name="o-plus-circle" />
                            </p>
                        </div>
                        <div x-show='!$wire.dollarAccounts' class="pt-6">
                            <button type="button"
                                class="w-full py-6 text-lg font-semibold transition-colors duration-300 bg-white border rounded-md text-violet-900 border-violet-900"
                                x-on:click="$wire.dispatch('openModal',2)">
                                Agregar nueva cuenta bancaria dólares <x-mary-icon class="w-7"
                                    name="o-plus-circle" />
                            </button>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->hasVerifiedEmail() && auth()->user()->isDataValidated())
                    <p class="my-4 text-left">
                        Declaro bajo juramento que los fondos involucrados en la operación provienen de actividades
                        lícitas
                        en conformidad con la normativa peruana y las regulaciones de prevención de lavado de activos en
                        el
                        país.
                    </p>
                    <x-mary-checkbox label="Afirmo y ratifico todo lo manifestado en la presente declaración jurada"
                        wire:model="form.terms" class="select-none" />
                    <x-mary-button label="Iniciar Operación"
                        class="w-full mt-8 text-lg text-white transition-colors duration-300 bg-violet-800 hover:bg-violet-900"
                        type="button" wire:click='save' spinner="save" />
                @else
                    <p class="text-sm text-red-600">
                        *Para iniciar una operación primero necesita:
                    </p>
                    <ul class="pl-6 text-sm list-disc">
                        @if (!auth()->user()->hasVerifiedEmail())
                            <li>Validar su correo</li>
                        @endif
                        @if (auth()->user()->isDataPending())
                            <li>Ingresar sus datos</li>
                        @endif
                        @if (auth()->user()->isDataUploaded())
                            <li>Esperar la validación de sus datos</li>
                        @endif
                    </ul>
                    <div class="flex justify-center gap-4 text-center">
                        @if (!auth()->user()->hasVerifiedEmail())
                            <button
                                class="w-full p-2 mt-8 text-lg text-white transition-colors duration-300 rounded-md cursor-pointer bg-sky-800 hover:bg-sky-900"
                                type="button" x-on:click="$wire.dispatch('send-verification-email')">
                                Valida tu correo
                            </button>
                        @endif
                        @if (auth()->user()->isDataPending())
                            <a wire:navigate href="{{ route('account') }}"
                                class="w-full p-2 mt-8 text-lg text-white transition-colors duration-300 rounded-md cursor-pointer bg-amber-800 hover:bg-amber-900">
                                Ingresa los datos de tu perfil
                            </a>
                        @endif
                        @if (auth()->user()->isDataUploaded())
                            <p class="w-full p-2 mt-8 text-lg text-white transition-colors duration-300 rounded-md cursor-pointer bg-amber-800 hover:bg-amber-900"
                                title="Le enviaremos un correo cuando el proceso concluya">
                                Sus datos están siendo validados.
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@script
    <script>
        Alpine.data('quoter', () => ({
            isPurchase: $wire.entangle('form.isPurchase'),
            amountToSend: $wire.entangle('form.amountToSend'),
            amountToReceive: $wire.entangle('form.amountToReceive'),
            purchaseFactor: $wire.entangle('purchaseFactor'),
            salesFactor: $wire.entangle('salesFactor'),
            factor: 1,
            version: $wire.entangle('version'),

            init() {
                this.factor = this.isPurchase ? this.purchaseFactor : 1 / this.salesFactor
                this.$watch('isPurchase', value => {
                    this.factor = value ? this.purchaseFactor : 1 / this.salesFactor
                    this.updateAmountToReceive()
                });
                this.$watch('version', () => {
                    this.factor = this.isPurchase ? this.purchaseFactor : 1 / this.salesFactor
                    this.updateAmountToReceive()
                })
            },

            updateAmountToReceive() {
                const amountToSend = parseFloat(this.amountToSend.replace(/,/g, ''))
                this.amountToReceive = isNaN(amountToSend) ? 0 : (amountToSend * this.factor)
                    .toFixed(2);
            },
            updateAmountToSend() {
                const amountToReceive = parseFloat(this.amountToReceive.replace(/,/g, ''))
                this.amountToSend = isNaN(amountToReceive) ? 0 : (amountToReceive * this.factor).toFixed(
                    2);
            },
            resetValidation() {
                let inputErrrors = document.getElementsByClassName('input-primary');
                let errors = document.getElementsByClassName('text-red-500');
                for (let i = 0; i < inputErrrors.length; i++) {
                    inputErrrors[i].classList.remove('input-error');
                }
                for (let i = 0; i < errors.length; i++) {
                    errors[i].classList.add('hidden');
                }
            }
        }));
    </script>
@endscript
