<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile Data') }}
        </h2>
    </x-slot>
    <div class="max-w-4xl py-10 mx-auto sm:px-6 lg:px-8">
        @if (auth()->user()->account_type == 1)
            <livewire:account.personal />
        @else
            <livewire:account.business />
        @endif

    </div>
</div>
