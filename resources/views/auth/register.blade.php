<x-auth-layout>
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

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" x-data="toggleAccountType">
                @csrf
                <div class="flex justify-center w-full transition-all" id="tab_container">
                    <div class="flex justify-between bg-white border-2 border-gray-300 rounded-full select-none w-96">
                        <div id="tab_personal"
                            class="w-1/2 py-2 text-lg font-semibold text-center transition-colors duration-300 rounded-full cursor-pointer"
                            @click="accountType = 1">
                            Personal</div>
                        <div id="tab_business"
                            class="w-1/2 py-2 text-lg font-medium text-center transition-colors duration-300 rounded-full cursor-pointer"
                            @click="accountType = 2">
                            Empresarial
                        </div>
                    </div>
                </div>
                <input type="hidden" name="account_type" x-model="accountType">
                <div x-show="accountType == 2" x-transition class="mt-4">
                    <x-label for="ruc" value="RUC" />
                    <x-input id="ruc" class="block w-full mt-1" type="text" name="ruc" :value="old('ruc')"
                        x-mask:dynamic="$input.startsWith('1') ? '10999999999' : ($input.startsWith('2') ? '20999999999' : ' ')"
                        x-bind:required="accountType == 2" />
                </div>
                <div x-show="accountType == 2" x-transition class="mt-4">
                    <x-label for="name" value="{{ __('Business Name') }}" />
                    <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                        x-bind:required="accountType == 2" autocomplete="name" />
                </div>
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

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
                @endif

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
</x-auth-layout>
