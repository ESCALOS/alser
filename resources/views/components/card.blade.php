@props(['icon' => ''])

<div class="block max-w-sm p-6 mb-4 bg-white rounded-lg shadow dark:bg-white">
    {{ $icon }}
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-900">{{ $title }}</h5>
    <p class="font-normal text-gray-700 dark:text-gray-700 text-pretty">{{ $description }}</p>
</div>
