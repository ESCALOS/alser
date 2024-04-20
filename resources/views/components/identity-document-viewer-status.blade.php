<div class="h-52" title="{{ $status->getLabel() }}">
    <div class="h-32 rounded-t-md bg-violet-100">
        <h3 class="pt-4 pb-1 text-lg font-semibold text-center text-violet-400">Lado Frontal</h3>
        <img src="{{ route('image.identity-document-current-user', ['type' => 'front']) }}" class="h-24 m-auto" />
    </div>
    <div class="h-20 px-4 pt-4 align-middle rounded-b-md bg-violet-300">
        <div
            class="content-center w-full h-12 font-semibold text-center bg-white rounded-sm {{ $status->getTextColorTailwind() }}">
            <x-mary-icon name="{{ $status->getIcon() }}" />
            <span>{{ $status->getLabel() }}</span>
        </div>
    </div>
</div>
<div class="h-52" title="Pendiente en validar">
    <div class="h-32 rounded-t-md bg-violet-100">
        <h3 class="pt-4 pb-1 text-lg font-semibold text-center text-violet-400">Lado Rerverso</h3>
        <img src="{{ route('image.identity-document-current-user', ['type' => 'back']) }}" class="h-24 m-auto" />
    </div>
    <div class="h-20 px-4 pt-4 align-middle rounded-b-md bg-violet-300">
        <div
            class="content-center w-full h-12 font-semibold text-center bg-white rounded-sm {{ $status->getTextColorTailwind() }}">
            <x-mary-icon name="{{ $status->getIcon() }}" />
            <span>{{ $status->getLabel() }}</span>
        </div>
    </div>
</div>
