<?php
use function Laravel\Folio\name;

name('home.companies');
?>

<x-guest-layout>
    @include('partials.home.process')
    @include('partials.home.securities')
    @include('partials.home.sbs-full')
</x-guest-layout>
