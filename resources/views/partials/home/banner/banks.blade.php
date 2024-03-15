<div class="grid grid-cols-1 col-span-1 divide-x-0 divide-y md:col-span-2 md:divide-y-0 md:divide-x md:grid-cols-2">
    <div class="flex flex-col justify-center h-48 pb-4 pr-0 md:pr-4">
        <div class="flex items-start justify-center pb-8">
            <h1 class="text-lg text-white">Operaciones en máximo 30 min.</h1>
        </div>
        @include('partials.home.banner.icon-banks', ['banks' => ['bcp', 'inter']])
    </div>
    <div class="flex flex-col justify-center h-48 pb-4 pl-0 md:pl-4">
        <div class="flex items-start justify-center pb-8">
            <h1 class="text-lg text-white">
                Op<span class="inline lg:hidden">.</span><span class="hidden lg:inline">eraciones</span>
                Interbancarias (hasta 1 día útil)
            </h1>
        </div>
        @include('partials.home.banner.icon-banks', ['banks' => ['bbva', 'scotia']])
    </div>
</div>
