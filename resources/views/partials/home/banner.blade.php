<section class="bg-home-primary lg:py-12" x-data="{ open: true }">
    @include('partials.home.banner.toast')
    <div class="max-w-screen-xl px-6 mx-auto text-center bg-home-primary"
        :class="open ? 'translate-y-40 md:translate-y-24 min-[425px]:translate-y-32 md:mb-24 mb-36' :
            'transition-all translate-y-4 duration-500'">
        @include('partials.home.banner.main')
    </div>
</section>
