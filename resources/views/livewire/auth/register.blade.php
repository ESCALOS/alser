<div>
    <div class="grid grid-cols-1 md:grid-cols-2" style="height: calc(100vh - 81px)">
        <div class="hidden text-white border-r md:block bg-home-primary">
            <div class="flex flex-col items-center justify-center h-full px-6 space-y-5 text-center">
                <h1 class="text-4xl font-black text-yellow-600">Cambia dólares para tu empresa</h1>
                <h2>Compra y vende con el mejor <span class="font-bold">tipo de cambio</span></h2>
                <div>
                    <a href="https://bit.ly/4ac783W" target="_blank"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center transition-colors duration-300 bg-white border border-white rounded-lg hover:bg-gray-100 text-home-primary focus:ring-4 focus:ring-gray-400">
                        <span class="mr-2">Contactar con un asesor</span> <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
        <x-authentication-card>
            <x-slot name="logo">
                <h1 class="text-2xl font-bold text-gray-700">Crea tu cuenta</h1>
            </x-slot>
            <x-validation-errors class="mb-8" />
            <form wire:submit='register' x-data="{
                accountType: $wire.entangle('form.account_type'),
                init() {
                    this.toggle(this.accountType);
                    this.$watch('accountType', (value) => {
                        this.toggle(value);
                    });
                },
                toggle(value) {
                    if (value == 1) {
                        document
                            .getElementById('tab_personal').classList.add('bg-home-primary');
                        document.getElementById('tab_personal').classList.add('text-white');
                        document
                            .getElementById('tab_personal').classList.remove('text-gray-700');
                        document
                            .getElementById('tab_business').classList.remove('bg-home-primary');
                        document
                            .getElementById('tab_business').classList.remove('text-white');
                        document
                            .getElementById('tab_business').classList.add('text-gray-700');
                        document
                            .getElementById('tab_container').classList.add('-translate-y-4');
                        document.getElementById('ruc').value = '';
                        document.getElementById('name').value = '';
                    } else {
                        document
                            .getElementById('tab_personal').classList.remove('bg-home-primary');
                        document
                            .getElementById('tab_personal').classList.remove('text-white');
                        document
                            .getElementById('tab_personal').classList.add('text-gray-700');
                        document
                            .getElementById('tab_business').classList.add('bg-home-primary');
                        document.getElementById('tab_business').classList.add('text-white');
                        document
                            .getElementById('tab_business').classList.remove('text-gray-700');
                    }
                }
            }">
                <div wire:ignore class="flex justify-center w-full transition-all" id="tab_container">
                    <div class="flex justify-between bg-white border-2 border-gray-300 rounded-full select-none w-96">
                        <div id="tab_personal"
                            class="w-1/2 py-2 text-lg font-semibold text-center rounded-full cursor-pointer"
                            x-on:click="$wire.form.account_type = 1;">
                            Personal</div>
                        <div id="tab_business"
                            class="w-1/2 py-2 text-lg font-medium text-center rounded-full cursor-pointer"
                            x-on:click="$wire.form.account_type = 2;">
                            Empresarial
                        </div>
                    </div>
                </div>

                <div x-show="accountType == 2" x-transition wire:key='business-fields' class="mt-4">
                    <x-label for="ruc" value="RUC" />
                    <x-input id="ruc" class="block w-full mt-1" type="text" name="ruc"
                        wire:model='form.document_number'
                        x-mask:dynamic="$input.startsWith('1') ? '10999999999' : ($input.startsWith('2') ? '20999999999' : ' ')"
                        x-bind:required="accountType == 2" />
                </div>
                <div x-show="accountType == 2" x-transition class="mt-4">
                    <x-label for="name" value="{{ __('Business Name') }}" />
                    <x-input id="name" class="block w-full mt-1" type="text" name="name"
                        wire:model='form.name' x-bind:required="accountType == 2" autocomplete="name" />
                </div>
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block w-full mt-1" type="email" name="email"
                        wire:model='form.email' required autocomplete="username" />
                </div>
                <div class="mt-4" x-data="{ show: true }">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        for="password">{{ __('Password') }}
                    </label>

                    <div class="relative">
                        <input
                            class="block w-full px-3 py-2 mt-1 text-base border border-gray-300 rounded-md shadow-sm focus:outline-none"
                            :type="show ? 'password' : 'text'" name="password" id="password"
                            autocomplete="new-password" type="password" wire:model='form.password' required>

                        <div class="absolute cursor-pointer top-1/2 right-4" style="transform: translateY(-50%);">
                            <svg class="block h-4 text-gray-700" fill="none" @click="show = !show"
                                :class="{ 'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512">
                                <path fill="currentColor"
                                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                </path>
                            </svg>

                            <svg class="hidden h-4 text-gray-700" fill="none" @click="show = !show"
                                :class="{ 'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512">
                                <path fill="currentColor"
                                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-4" x-data="{ show: true }">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        for="password">{{ __('Confirm Password') }}
                    </label>

                    <div class="relative">
                        <input
                            class="block w-full px-3 py-2 mt-1 text-base border border-gray-300 rounded-md shadow-sm focus:outline-none"
                            :type="show ? 'password' : 'text'" name="password" id="confirm_password"
                            autocomplete="new-password" type="password" wire:model='form.password_confirmation'
                            required>

                        <div class="absolute cursor-pointer top-1/2 right-4" style="transform: translateY(-50%);">
                            <svg class="block h-4 text-gray-700" fill="none" @click="show = !show"
                                :class="{ 'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512">
                                <path fill="currentColor"
                                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                </path>
                            </svg>

                            <svg class="hidden h-4 text-gray-700" fill="none" @click="show = !show"
                                :class="{ 'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512">
                                <path fill="currentColor"
                                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" wire:model='form.terms' id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ms-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</div>
