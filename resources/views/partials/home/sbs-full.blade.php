@php
    $bg = isset($bg) ? $bg : 'text-white'
@endphp
<section class="pt-6 pb-12 {{ $bg }}">
    <div class="max-w-screen-xl px-6 py-6 mx-auto md:px-24">
        <div class="flex flex-col items-center justify-center text-center">
            <img class="py-6" src="{{ asset('storage/images/sbs.svg')}}" alt="sbs">
            <p class="text-2xl font-bold text-gray-900">Registrada como casa de cambio en la SBS</p>
            <p class="text-lg text-gray-700">(Superintendencia de Banca, Seguros y AFP)</p>
        </div>
    </div>
</section>
