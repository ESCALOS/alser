<?php
use function Laravel\Folio\name;

name('home');
?>

<x-guest-layout>
    <x-section-home />
    <x-section-home-securities />
    <x-section-home-process />
</x-guest-layout>
