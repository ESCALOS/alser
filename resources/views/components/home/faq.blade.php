<section {{ $attributes->merge(['class' => 'bg-gray-100']) }}>
    <div class="max-w-screen-xl px-6 mx-auto md:px-24">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex items-center justify-center {{ $imgLeft ? '' : 'hidden' }}">
                <img src="{{ asset('storage/images/' . $img) }}" alt="Imagen" class="hidden w-full px-6 lg:block">
            </div>
            <div>
                @foreach ($faqs as $faq)
                    <div class="w-full text-pretty">
                        <h2 class="mb-4 text-2xl font-bold">{{ $faq->question }}</h2>
                        <p class="{{ !$loop->last ? 'mb-8' : '' }} text-lg">{{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-center {{ $imgLeft ? 'hidden' : '' }}">
                <img src="{{ asset('storage/images/' . $img) }}" alt="Imagen" class="hidden w-full px-6 lg:block">
            </div>
        </div>
    </div>
</section>
