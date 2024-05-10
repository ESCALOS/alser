<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{placeholder};

name('home');
placeholder('<div>Loading...</div>');
?>

<x-guest-layout>
    @volt
        <div>
            @include('partials.home.banner')
            @include('partials.home.process')
            @include('partials.home.securities')
            @include('partials.home.sbs-full')
            <livewire:mail-suscription />
        </div>
    @endvolt
</x-guest-layout>
