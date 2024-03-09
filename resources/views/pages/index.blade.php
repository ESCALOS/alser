<?php
use function Laravel\Folio\name;

name('home');
?>

<x-guest-layout>
    @include('partials.home.banner')
    @include('partials.home.securities')
    <livewire:mail-suscription />
    @include('partials.home.process')
</x-guest-layout>
