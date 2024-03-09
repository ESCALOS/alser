<div class="flex items-center h-16 justify-evenly">
    @foreach ($banks as $bank)
    <div class="flex flex-col items-center justify-center py-2">
        <img src="storage/images/bancos/{{ $bank }}.svg" alt="img-{{ $bank }}" class="py-2">
        <h1 class="text-center text-white">Todo el Perú</h1>
    </div>
    @endforeach
</div>
