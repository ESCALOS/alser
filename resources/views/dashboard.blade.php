<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('New operation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            @include('partials.home.banner.quoter')
        </div>
    </div>
</x-app-layout>
