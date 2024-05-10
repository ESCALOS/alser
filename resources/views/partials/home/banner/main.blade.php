<div class="grid grid-cols-1 pt-4 md:grid-cols-2">
    <div class="order-2 pt-4 pb-4 md:order-1 md:pb-12" x-cloak>
        @include('partials.home.banner.title')
    </div>
    <div class="order-1 pb-4 md:pb-12 md:order-2 h-128">
        @include('partials.home.banner.quoter')
    </div>
    <div
        class="grid order-3 grid-cols-1 col-span-1 divide-x-0 divide-y md:col-span-2 md:divide-y-0 md:divide-x md:grid-cols-2">
        @include('partials.home.banner.banks')
    </div>
</div>
