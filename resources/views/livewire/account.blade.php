<div>
    <div class="max-w-4xl py-10 mx-auto">
        @if (auth()->user()->account_type->value === 1)
            <livewire:account.personal lazy />
        @elseif (auth()->user()->account_type->value === 2)
            <livewire:account.business lazy />
        @else
            <h1>Hay un error</h1>
        @endif
    </div>
</div>
