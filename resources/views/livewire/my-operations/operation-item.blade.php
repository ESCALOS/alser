<div class="w-full p-4 bg-white border-r-2 cursor-pointer border-violet-700"
    x-on:click="$dispatch('show-operation-detail',{ date: '{{ $this->createdAtFormatted }}', status: '{{ $operation->status->getLabel() }}' } )">
    <p class="text-sm font-bold text-gray-700">{{ $this->createdAtFormatted }}</p>
    <div class="flex justify-between pt-2">
        <p class="font-bold text-gray-500">{{ $currencySymbolSend }} {{ number_format($operation->amount_to_send, 2) }}
        </p>
        <p><i class="fa-solid fa-arrow-right text-violet-900"></i></p>
        <p class="font-bold {{ $operation->status->getIconColor() }}">{{ $currencySymbolReceive }}
            {{ number_format($operation->amount_to_receive, 2) }}
            <x-mary-icon name="{{ $operation->status->getIcon() }}" class="{{ $operation->status->getIconColor() }}" />

        </p>
    </div>
</div>
