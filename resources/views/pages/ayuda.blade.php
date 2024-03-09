<?php
use function Laravel\Folio\name;

name('home.help');
?>

<x-guest-layout>
    @include('partials.home.process')
    @include('partials.home.sbs-full', ['bg' => 'bg-gray-100'])
</x-guest-layout>
