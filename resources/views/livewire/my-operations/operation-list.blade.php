<div>
    <p class="text-lg font-bold">Operaciones recientes</p>
    <div class="space-y-4">
        @foreach ($operations as $key => $operation)
            <livewire:my-operations.operation-item :$operation :$key />
        @endforeach
    </div>
    {{ $operations->links() }}
</div>
