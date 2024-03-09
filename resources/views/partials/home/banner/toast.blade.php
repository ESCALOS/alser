<div class="absolute left-0 items-center w-full max-w-screen-xl mx-auto md:w-3/5 md:left-1/4 md:mt-8 md:flex md:content-around md:justify-center"
            x-show="open" x-transition.duration.500ms>
    <div class="flex content-around w-full p-2 text-indigo-100 bg-violet-900 md:rounded-full"
        role="alert">
        <div class="flex-auto w-48 mr-2 text-lg md:w-64 text-pretty">¡Cambia dólares para tu <span class="text-2xl font-black text-yellow-500">Empresa</span>  con los mejores beneficios!</div>
        <div class="relative flex items-center justify-around w-48">
            <a wire:navigate.hover href="{{ route('home.companies') }}" class="px-2 py-1 text-xs font-bold uppercase bg-white rounded-md text-home-primary md:text-md">Más información</a>
            <svg @click="open = false" class="w-4 h-4 opacity-75 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z">
                </path>
            </svg>
        </div>
    </div>
</div>
