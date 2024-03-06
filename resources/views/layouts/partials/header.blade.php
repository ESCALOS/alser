<?php
    $routes = [
        [
            'name' => 'Inicio',
            'route' => 'home'
        ],
        [
            'name' => 'Nosotros',
            'route' => 'home.about'
        ],
        [
            'name' => 'Empresas',
            'route' => 'home.companies'
        ],
        [
            'name' => 'Ayuda',
            'route' => 'home.help'
        ],
        [
            'name' => 'Iniciar Sesión',
            'route' => 'login'
        ],
        [
            'name' => 'Registrase',
            'route' => 'register'
        ]
    ];
?>

<nav class="bg-white border-gray-200 dark:bg-gray-900 home-nav" x-data="{ isHidden: true }">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto md:justify-around">
        <a wire:navigate href="{{ route('home') }}" class="flex items-center">
            <img src="storage/images/logo-alser.png" class="h-8 mr-3" alt="Logo" />
        </a>
        <div class="flex items-center md:order-2">
            <button @click="isHidden = !isHidden" type="button" class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Abrir Menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between w-full md:flex md:w-auto md:order-1" :class="isHidden ? 'hidden' : 'animate-zoom-in'">
            <ul class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                @foreach ($routes as $route)
                    <li>
                        <a wire:navigate.hover href="{{ route($route['route']) }}" class="home-nav-link {{ request()->routeIs($route['route']) ? 'home-nav-link-active' : 'home-nav-link-inactive'}}" aria-current="page">{{ $route['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
