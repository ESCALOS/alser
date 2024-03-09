@props(['icon' => ''])

<div class="flex flex-col items-center justify-around max-w-sm px-6 py-20 mb-4 bg-white rounded-lg shadow h-96 dark:bg-white">
    <div class="flex items-center justify-center mb-4 rounded-full bg-violet-100 w-14 h-14">
        <svg class="w-10 h-10 pt-2 mb-3 font-bold text-home-primary dark:text-home-primary" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            {{ $icon }}
        </svg>
    </div>
    <div>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-center text-home-primary dark:text-home-primary">{{ $title }}</h5>
        <p class="font-normal text-center text-gray-700 dark:text-gray-700">{{ $description }}</p>
    </div>

</div>
