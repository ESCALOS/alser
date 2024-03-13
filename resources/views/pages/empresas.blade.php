<?php
use function Laravel\Folio\name;

name('home.companies');
?>

<x-guest-layout>
    <x-home.banner-default content-height="h-80 md:h-64">
        <x-slot:top-text>Tipo de cambio preferencial</x-slot>
        <x-slot:title>para tu empresa</x-slot>
        <p>cambiando a partir de $ 5,000 ó S/15,000</p>
        <p>de lunes a viernes en el horario de 8:00 am – 6:00 pm.</p>
    </x-home.banner-default>
    @include('partials.home.process')
    @include('partials.home.securities')
    @include('partials.home.sbs-full')
</x-guest-layout>
