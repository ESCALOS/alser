<?php
use function Laravel\Folio\name;

name('home.help');
?>

<x-guest-layout>
    <x-home.banner-default>
        <x-slot:top-text>¿NECESITAS AYUDA?</x-slot>
        <x-slot:title>Preguntas frecuentes</x-slot>
        <p>Encuentra las respuestas adecuadas a tus preguntas.</p>
    </x-home.banner-default>
    <x-home.faq class="pt-16 pb-4 lg:pb-8" img="crop-payroll-clerk-counting-money-while-sitting-at-table.jpg" />
    <x-home.faq class="pt-4 pb-16 lg:pt-8" start="2" quantity="3"
        img="heap-of-american-money-cash-and-vintage-light-box.jpg" :imgLeft="false" />
    @include('partials.home.process')
    <x-home.faq class="pt-16 pb-4 lg:pb-8" start="5"
        img="crop-woman-using-calculator-and-taking-notes-on-paper.jpg" />
    <x-home.faq class="pt-4 pb-16 lg:pt-8" start="5" img="heap-of-american-money-cash-and-vintage-light-box.jpg"
        :imgLeft="false" />
    @include('partials.home.sbs-full')
</x-guest-layout>
