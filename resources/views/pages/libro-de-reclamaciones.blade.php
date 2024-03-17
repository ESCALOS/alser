<?php
use function Laravel\Folio\name;

name('home.complaints-book');
?>

<x-guest-layout>
    <x-home.banner-default content-height="h-152 sm:h-136 md:h-80 lg:h-64" :contactButton="false">
        <x-slot:top-text>ALSER CAMBIO E.I.R.L. | RUC: 20608348329</x-slot>
        <x-slot:title>Libro de reclamaciones</x-slot:title>
        <p class="leading-5 text-balance">
            En cumplimiento de lo dispuesto por la Ley N° 29733, Ley de Protección de Datos Personales, informamos al
            usuario que los datos personales que nos ha proporcionado serán utilizados y/o tratados por ALSER CAMBIO
            E.I.R.L. para dar trámite al reclamo y/o queja presentada. Los datos personales serán almacenados en el
            Banco de Datos Personales denominado “Consultas, Reclamos y requerimientos” de titularidad de ALSER CAMBIO
            E.I.R.L. inscrito en el registro de la Dirección de Protección de Datos Personales (Código de Registro:
            XXXX). Asimismo, se informa al usuario que podrá ejercer su derecho de revocatoria y/o cualquier otro
            derecho previsto en la Ley N° 29733, tales como derechos de acceso, rectificación, cancelación y oposición
            (ARCO), enviando un correo electrónico a la siguiente dirección: privacidad@alsercambio.com. Más información
            en nuestra Política de Privacidad.
        </p>
    </x-home.banner-default>
    <section class="py-12 bg-white">
        <div class="max-w-screen-xl px-6 mx-auto md:px-24">
            <livewire:complaint-book lazy />
        </div>
    </section>
</x-guest-layout>
