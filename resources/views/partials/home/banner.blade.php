<section class="bg-gradient-to-b from-home-primary to-violet-800" x-data="{ open: true }"
    :class="open ? ' h-[74rem] md:h-[51rem]' : 'h-[68rem] md:h-[48rem]'">
    @include('partials.home.banner.toast')
    <div class="max-w-screen-xl px-6 mx-auto text-center"
        :class="open ? 'translate-y-36 md:translate-y-16 min-[425px]:translate-y-32 min-[425px]:mb-32 md:mb-24 mb-40' :
            'transition-all translate-y-4 mb-4 duration-500'">
        @include('partials.home.banner.main')
    </div>
</section>
