<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New operation') }}
        </h2>
    </x-slot>
    <div wire:loading.delay><x-loader /></div>
    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            @if ($this->status->value === 1)
                <livewire:operation.pending :operation="$lastOperation" />
            @else
                <livewire:operation.without />
            @endif
        </div>
    </div>
</div>
