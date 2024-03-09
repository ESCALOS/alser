<?php
use function Laravel\Folio\name;

name('home');
?>

<x-guest-layout>
    @include('partials.home.banner')
    @include('partials.home.process')
    @include('partials.home.securities')
    @include('partials.home.sbs-full')
    <livewire:mail-suscription />
</x-guest-layout>
