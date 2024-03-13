<?php
use function Laravel\Folio\name;

name('home.exchange-rate');
?>

<x-guest-layout>
    <x-home.banner-default topText="EL MEJOR" title="Tipo de cambio">
        <p>Cambiar dólares era rápido, ahora es inmediato.</p>
    </x-home.banner-default>
    @include('partials.home.graphics-dollar-price')
    @include('partials.home.process')
    @include('partials.home.securities')
    @include('partials.home.sbs-full')
</x-guest-layout>
