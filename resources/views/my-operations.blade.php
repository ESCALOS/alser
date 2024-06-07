<x-app-layout>
    <div class="px-6 py-12 mx-auto max-w-7xl lg:px-8">
        <div class="grid grid-cols-3 gap-8">
            <div class="col-span-3 md:col-span-1">
                <livewire:my-operations.operation-list />
            </div>
            <div class="col-span-3 md:col-span-2">
                <livewire:my-operations.operation-detail />
            </div>
        </div>
    </div>
</x-app-layout>
