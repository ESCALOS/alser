<x-guest-layout>
    <div class="pt-4 bg-home-primary dark:bg-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <img src="{{ asset('storage/images/logo-alser.png') }}" alt="logo" style="height: 48px">
                </a>
            </div>

            <div
                class="w-full p-6 mt-6 overflow-hidden prose bg-white shadow-md sm:max-w-2xl dark:bg-gray-800 sm:rounded-lg dark:prose-invert">
                {!! $policy !!}
            </div>
        </div>
    </div>
</x-guest-layout>
