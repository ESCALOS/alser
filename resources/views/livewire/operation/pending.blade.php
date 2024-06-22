<div class="grid grid-cols-3 gap-4">
    <div class="col-span-3 space-y-4 lg:col-span-1">
        <x-operation.summary :$operation />
        <x-operation.no-cash />
        <x-operation.important :originBank="$operation->originBank->name" :destinationBank="$operation->destinationBank->name" />
    </div>
    <div class="col-span-3 lg:col-span-2">
        <span class="text-gray-600 text-md">Mi cambio</span>
        <div class="flex flex-wrap justify-between mb-8 md:flex-nowrap">
            <div>
                <h2 class="text-2xl font-semibold leading-none text-violet-700">Transferencia bancaria</h2>
                <div class="grid w-40 grid-cols-3">
                    <div class="h-1 mt-2 rounded-lg w-11 bg-violet-700"></div>
                    <div class="h-1 mt-2 bg-gray-300 rounded-lg w-11"></div>
                    <div class="h-1 mt-2 bg-gray-300 rounded-lg w-11"></div>
                </div>
            </div>
            <livewire:operation.countdown :created-at="$operation->created_at" />
        </div>
        <x-operation.wire :bank="$operation->originBank" :account="$operation->account_from_send" :amount="$operation->amount_to_send" :is-purchase="$operation->isPurchase()" />
        <div class="mt-4">
            <livewire:operation.number :$operation />
        </div>
    </div>
</div>
