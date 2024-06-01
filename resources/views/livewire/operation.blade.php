<div>
    <div wire:loading.delay><x-loader /></div>
    <div class="py-8">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            @if ($this->status->value === 1)
                <livewire:operation.pending :operation="$lastOperation" />
            @else
                <livewire:operation.without />
            @endif
        </div>
    </div>
</div>
