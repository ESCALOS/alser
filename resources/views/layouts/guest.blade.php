<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="Alser Cambio, cambio de divisas, comprar dólares, comprar dolares, vender dólares, vender dolares, cambiar soles a dólares, cambiar soles a dolares, cambiar dólares a soles, cambiar dolares a soles, cambio de moneda online, tipo de cambio, transacciones monetarias, servicios financieros">
    <meta name="description"
        content="Alser Cambio es una marca registrada que ofrece servicios de cambio de divisas en línea, incluyendo compra y venta de dólares, así como el cambio de soles a dólares y viceversa.">
    <title>Alser Cambio - Servicios de cambio de divisas en línea</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,651;1,651&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @livewireStyles
    @vite(['resources/css/guest.css', 'resources/js/app.js'])
</head>

<body>

    @include('layouts.partials.header')

    <div class="font-sans antialiased text-gray-900">
        {{ $slot }}
    </div>

    @include('layouts.partials.footer')

    <x-mary-toast />

    @livewireScripts
    @livewireChartsScripts
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    @stack('scripts')
</body>

</html>
