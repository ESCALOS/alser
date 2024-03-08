 @php
$routes = [
    [
        'name' => 'Nosotros',
        'route' => 'home.about',
    ],
    [
        'name' => 'Empresas',
        'route' => 'home.companies',
    ],
    [
        'name' => 'Ayuda',
        'route' => 'home.help',
    ],
];
@endphp

<nav class="border-b border-indigo-200 shadow bg-home-primary dark:bg-gray-900" x-data="{ open: false, screenSize: window.matchMedia('(max-width: 767px)').matches }">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto md:justify-between">
        <a wire:navigate href="{{ route('home') }}" class="flex items-center">
            <img src="storage/images/logo-alser.png" class="h-8 mr-3" alt="Logo" />
        </a>
        <div>
            <div class="flex items-center md:order-2">
                <button @click="open = !open" @resize.window="screenSize = window.matchMedia('(max-width: 767px)').matches" type="button"
                    class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-white rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Abrir Menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div x-show="screenSize ? open : true"
                class="absolute right-0 z-10 w-full md:relative md:flex md:w-auto md:order-1"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg bg-home-primary md:p-0 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-home-primary dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    @foreach ($routes as $route)
                        <li class="{{ request()->routeIs($route['route']) ? 'md:border-b md:border-white' : 'md:hover:border-b md:hover:border-white'}}">
                            <a wire:navigate.hover href="{{ route($route['route']) }}"
                                class="home-nav-link {{ request()->routeIs($route['route']) ? 'home-nav-link-active' : 'home-nav-link-inactive' }}"
                                aria-current="page">{{ $route['name'] }}</a>
                        </li>
                    @endforeach
                    <li class="md:hover:border-b md:hover:border-white">
                        <a wire:navigate.hover href="{{ route('login') }}" class="home-nav-link home-nav-link-inactive"
                            aria-current="page">Iniciar Sesión</a>
                    </li>
                    <li class="md:hover:border-b md:hover:border-white">
                        <a wire:navigate.hover href="{{ route('register') }}" class="home-nav-link home-nav-link-inactive"
                            aria-current="page">Registrarse</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
