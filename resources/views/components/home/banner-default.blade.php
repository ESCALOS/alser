<section class="py-12 bg-gradient-to-b from-home-primary to-violet-800 md:py-14">
    <div class="flex flex-col items-center justify-between h-64 max-w-screen-xl px-6 mx-auto">
        <div>
            <h3 class="text-lg font-semibold text-gray-300 uppercase">{{ $topText }}</h3>
        </div>
        <div>
            <h2 class="text-5xl font-bold text-white">{{ $title }}</h2>
        </div>
        <div class="text-center text-gray-300">
            {{ $slot }}
        </div>
        <div>
            <a wire:navigate.hover href="{{ route('home.help') }}"
                class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center transition-colors duration-300 bg-white border border-white rounded-lg hover:bg-gray-100 text-home-primary focus:ring-4 focus:ring-gray-400">
                <span class="mr-2">Contactar con un asesor</span> <i class="fa-brands fa-whatsapp"></i>
            </a>
        </div>
    </div>
</section>
