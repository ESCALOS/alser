<?php
use function Laravel\Folio\name;

name('home.companies');
?>

<x-guest-layout>
    <x-home.banner-default topText="Tipo de cambio preferencial" title="para tu empresa">
        <p>cambiando a partir de $ 5000 ó S/15000</p>
        <p>de lunes a viernes en el horario de 8:00 am – 6:00 pm..</p>
    </x-home.banner-default>
    @include('partials.home.process')
    @include('partials.home.securities')
    @include('partials.home.sbs-full')
</x-guest-layout>
