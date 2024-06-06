<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <p>
                @if (!$paginator->onFirstPage())
                    <button class="px-4 py-2 text-sm font-bold text-white rounded-md bg-violet-700"
                        wire:click="previousPage" wire:loading.attr="disabled" rel="prev">Anterior</button>
                @endif
            </p>

            <p>
                @if (!$paginator->onLastPage())
                    <button class="px-4 py-2 text-sm font-bold text-white rounded-md bg-violet-700" wire:click="nextPage"
                        wire:loading.attr="disabled" rel="next">Siguiente</button>
                @endif
            </p>
        </nav>
    @endif
</div>
