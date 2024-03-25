 @php
     $routes = [
         [
             'name' => 'Empresas',
             'route' => 'home.companies',
         ],
         [
             'name' => 'Tipo de cambio',
             'route' => 'home.exchange-rate',
         ],
         [
             'name' => 'Ayuda',
             'route' => 'home.help',
         ],
         [
             'name' => 'Nosotros',
             'route' => 'home.about',
         ],
     ];
 @endphp

 <nav class="border-b border-indigo-200 shadow bg-home-primary" x-data="{ open: false, screenSize: window.matchMedia('(max-width: 1023px)').matches }">
     <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto lg:justify-between">
         <a wire:navigate.hover href="{{ route('home') }}" class="flex items-center">
             <img src="{{ asset('storage/images/logo-alser.png') }}" class="h-12 mr-3" alt="Logo" />
         </a>
         <div>
             <div class="flex items-center lg:order-2">
                 <button @click="open = !open"
                     @resize.window="screenSize = window.matchMedia('(max-width: 1023px)').matches" type="button"
                     class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-white rounded-lg lg:hidden focus:outline-none focus:ring-2 focus:ring-gray-200">
                     <span class="sr-only">Abrir Menu</span>
                     <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 17 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M1 1h15M1 7h15M1 13h15" />
                     </svg>
                 </button>
             </div>
             <div x-show="screenSize ? open : true"
                 class="absolute right-0 z-10 w-full bg-home-primary lg:relative lg:flex lg:w-auto lg:order-1"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                 <ul
                     class="flex flex-col p-4 mt-4 space-y-2 font-medium bg-transparent border border-gray-100 rounded-lg lg:space-y-0 lg:p-0 lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-home-primary">
                     @foreach ($routes as $route)
                         <li
                             class="{{ request()->routeIs($route['route']) ? 'lg:border-b lg:border-white' : 'lg:hover:border-b lg:hover:border-white' }} lg:content-center">
                             <a wire:navigate.hover href="{{ route($route['route']) }}"
                                 class="home-nav-link {{ request()->routeIs($route['route']) ? 'home-nav-link-active' : 'home-nav-link-inactive' }}"
                                 aria-current="page">{{ $route['name'] }}</a>
                         </li>
                     @endforeach
                     @if (auth()->check())
                         <div class="relative ms-3">
                             <x-dropdown align="right" width="48">
                                 <x-slot name="trigger">
                                     @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                         <button
                                             class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                             <img class="object-cover w-8 h-8 rounded-full"
                                                 src="{{ Auth::user()->profile_photo_url }}"
                                                 alt="{{ Auth::user()->name }}" />
                                         </button>
                                     @else
                                         <span class="inline-flex rounded-md">
                                             <button type="button"
                                                 class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700">
                                                 {{ Auth::user()->name ?? Bienvenido }}

                                                 <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                 </svg>
                                             </button>
                                         </span>
                                     @endif
                                 </x-slot>
                                 <x-slot name="content">
                                     <!-- Account Management -->
                                     <div class="block px-4 py-2 text-xs text-gray-400">
                                         {{ __('Manage Account') }}
                                     </div>

                                     <x-dropdown-link href="{{ route('profile.show') }}">
                                         {{ __('Profile') }}
                                     </x-dropdown-link>

                                     <x-dropdown-link href="{{ route('new-operation') }}">
                                         {{ __('New operation') }}
                                     </x-dropdown-link>

                                     @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                         <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                             {{ __('API Tokens') }}
                                         </x-dropdown-link>
                                     @endif

                                     <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                     <!-- Authentication -->
                                     <form method="POST" action="{{ route('logout') }}" x-data>
                                         @csrf

                                         <x-dropdown-link href="{{ route('logout') }}"
                                             @click.prevent="$root.submit();">
                                             {{ __('Log Out') }}
                                         </x-dropdown-link>
                                     </form>
                                 </x-slot>
                             </x-dropdown>
                         </div>
                     @else
                         <li class="{{ request()->routeIs('login') ? 'hidden' : '' }}">
                             <a wire:navigate.hover href="{{ route('login') }}"
                                 class="{{ !request()->routeIs('login') ? 'nav-link-login' : '' }}"
                                 aria-current="page">
                                 Iniciar Sesión
                             </a>
                         </li>
                         <li class="{{ request()->routeIs('register') ? 'hidden' : '' }}">
                             <a wire:navigate.hover href="{{ route('register') }}"
                                 class="{{ !request()->routeIs('register') ? 'nav-link-register' : '' }}"
                                 aria-current="page">
                                 Crear cuenta
                             </a>
                         </li>
                     @endif

                 </ul>
             </div>
         </div>
     </div>
 </nav>
