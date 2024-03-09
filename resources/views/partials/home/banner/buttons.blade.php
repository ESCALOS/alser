<div class="flex flex-col space-y-4 sm:flex-row sm:justify-start sm:space-y-0 sm:space-x-4">
    <a wire:navigate.hover href="{{ route('home.companies') }}"
        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center bg-white border rounded-lg text-home-primary hover:border-white hover:text-white hover:bg-home-primary focus:ring-4 focus:ring-gray-300 dark:focus:ring-blue-900">
        ¿Eres empresa?
    </a>
    <a wire:navigate.hover href="{{ route('home.help') }}"
        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-white rounded-lg hover:text-home-primary hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
        <span class="mr-2">Contactenos</span> <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>
