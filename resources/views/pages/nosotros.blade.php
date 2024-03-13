<?php
use function Laravel\Folio\name;

name('home.about');
?>

<x-guest-layout>
    <x-home.banner-default topText="LA MEJOR EXPERIENCIA DE CAMBIO" title="Nosotros">
        <p>Cambiar dólares era rápido, ahora es inmediato.</p>
    </x-home.banner-default>
    @include('partials.home.experience')
    <x-home.banner-default topText="Tipo de cambio preferencial" title="para tu empresa">
        <p>cambiando a partir de $ 5,000 ó S/15,000</p>
        <p>de lunes a viernes en el horario de 8:00 am – 6:00 pm.</p>
    </x-home.banner-default>
    @include('partials.home.sbs-full')
</x-guest-layout>
