<section {{ $attributes->merge(['class' => 'bg-gray-100'])}}>
    <div class="max-w-screen-xl px-6 mx-auto md:px-24">
        <img src="{{ asset('storage/images/' . $img) }}" alt="Imagen"
            class="hidden {{ $imgPosition }} w-1/2 px-6 lg:block">
        @foreach ($faqs as $faq)
            <div class="w-full text-pretty">
                <h2 class="mb-4 text-2xl font-bold">{{ $faq->question }}</h2>
                <p class="{{ !$loop->last ? 'mb-8' : '' }} text-lg">{{ $faq->answer }}</p>
            </div>
        @endforeach
    </div>
</section>
