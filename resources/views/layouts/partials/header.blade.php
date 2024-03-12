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

 <nav class="border-b border-indigo-200 shadow bg-home-primary dark:bg-gray-900" x-data="{ open: false, screenSize: window.matchMedia('(max-width: 1023px)').matches }">
     <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto lg:justify-between">
         <a wire:navigate.hover href="{{ route('home') }}" class="flex items-center">
             <img src="{{ asset('storage/images/logo-alser.png') }}" class="h-8 mr-3" alt="Logo" />
         </a>
         <div>
             <div class="flex items-center lg:order-2">
                 <button @click="open = !open"
                     @resize.window="screenSize = window.matchMedia('(max-width: 1023px)').matches" type="button"
                     class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-white rounded-lg lg:hidden focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                     <span class="sr-only">Abrir Menu</span>
                     <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 17 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M1 1h15M1 7h15M1 13h15" />
                     </svg>
                 </button>
             </div>
             <div x-show="screenSize ? open : true"
                 class="absolute right-0 z-10 w-full lg:relative lg:flex lg:w-auto lg:order-1"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                 <ul
                     class="flex flex-col p-4 mt-4 space-y-2 font-medium border border-gray-100 rounded-lg lg:space-y-0 bg-home-primary lg:p-0 lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-home-primary dark:bg-gray-800 lg:dark:bg-gray-900 dark:border-gray-700">
                     @foreach ($routes as $route)
                         <li
                             class="{{ request()->routeIs($route['route']) ? 'lg:border-b lg:border-white' : 'lg:hover:border-b lg:hover:border-white' }}">
                             <a wire:navigate.hover href="{{ route($route['route']) }}"
                                 class="home-nav-link {{ request()->routeIs($route['route']) ? 'home-nav-link-active' : 'home-nav-link-inactive' }}"
                                 aria-current="page">{{ $route['name'] }}</a>
                         </li>
                     @endforeach
                     <li class="{{ request()->routeIs('login') ? 'hidden' : '' }}">
                         <a wire:navigate.hover href="{{ route('login') }}"
                             class="{{ !request()->routeIs('login') ? 'nav-link-login' : '' }}"
                             aria-current="page">Iniciar
                             Sesión</a>
                     </li>
                     <li class="{{ request()->routeIs('register') ? 'hidden' : '' }}">
                         <a wire:navigate.hover href="{{ route('register') }}"
                             class="{{ !request()->routeIs('register') ? 'nav-link-register' : '' }}"
                             aria-current="page">Crear
                             cuenta</a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </nav>
