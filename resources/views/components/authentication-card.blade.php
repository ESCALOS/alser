<div class="flex flex-col items-center min-h-screen pt-6 bg-home-primary sm:justify-center sm:pt-0 dark:bg-home-primary">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
