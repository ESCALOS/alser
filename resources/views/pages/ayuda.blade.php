<?php
use function Laravel\Folio\name;

name('home.help');
?>

<x-guest-layout>
    <x-home.banner-default topText="¿NECESITAS AYUDA?" title="Preguntas frecuentes">
        <p>Encuentra las respuestas adecuadas a tus preguntas.</p>
    </x-home.banner-default>
    @include('partials.home.process')
    @include('partials.home.sbs-full', ['bg' => 'bg-gray-100'])
</x-guest-layout>
