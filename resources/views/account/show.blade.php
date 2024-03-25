<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Personal data') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-mary-card title="{{ __('Personal data') }}" shadow>
                <x-mary-input inline label="{{ __('Email') }}" class="rounded-lg" disabled
                    value="{{ auth()->user()->email }}" />
                <p></p>
            </x-mary-card>
        </div>
    </div>
</x-app-layout>
