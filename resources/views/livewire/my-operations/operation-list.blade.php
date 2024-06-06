<div>
    <p class="text-lg font-bold">Operaciones recientes</p>
    <div class="my-4 space-y-4">
        @foreach ($operations as $key => $operation)
            <livewire:my-operations.operation-item :$operation :$key />
        @endforeach
    </div>
    {{ $operations->links('custom-pagination') }}
</div>
