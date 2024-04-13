<div class="grid grid-cols-5">
    <div class="col-span-1">
        <img class="h-10 md:h-12" src="{{ asset('images/' . $img) }}" alt="{{ $title }}">
    </div>
    <div class="col-span-4">
        <h3 class="text-2xl font-bold">{{ $title }}</h3>
        {{ $slot }}
    </div>
</div>
