@php
    $bg = isset($bg) ? $bg : 'bg-white';
    $colorTitle = isset($colorTitle) ? $colorTitle : 'text-gray-900';
    $colorDescription = isset($colorDescription) ? $colorDescription : 'text-gray-700';
@endphp
<section class="pt-6 pb-12 {{ $bg }}">
    <div class="max-w-screen-xl px-6 py-20 mx-auto md:px-24">
        <div class="flex flex-col items-center justify-center text-center">
            <img class="py-6" src="{{ asset('images/logos/sbs.svg') }}" alt="sbs">
            <p class="text-2xl font-bold {{ $colorTitle }}">Registrada como casa de cambio en la SBS</p>
            <p class="text-lg {{ $colorDescription }}">(Superintendencia de Banca, Seguros y AFP)</p>
        </div>
    </div>
</section>
