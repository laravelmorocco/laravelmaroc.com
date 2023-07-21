<div>
@section('title', $tutorial?->title)


    <section class="relative items-center w-full px-5 py-10 mx-auto md:px-12 lg:px-24 max-w-7xl">
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose mx-auto py-10">
            <img src="{{ asset('images/tutorial' . $tutorial->image) }}" alt="{{ $tutorial->title }}"
                class="object-cover object-top w-full" />
            <meta itemprop="image" content="{{ asset('images/tutorial' . $tutorial->image) }}" />
            <meta itemprop="author" content="{{ $tutorial->user?->name }}" />
            <meta itemprop="datePublished" content="{{ $tutorial->updated_at }}" />
            <meta itemprop="dateModified" content="{{ $tutorial->updated_at }}" />
            <meta itemprop="headline" content="{{ $tutorial->title }}" />
            <meta itemprop="description" content="{{ $tutorial->description }}" />
            {{-- <meta itemprop="articleSection" content="{{ $tutorial->category?->title }}" /> --}}
            {{-- <meta itemprop="keywords" content="{{ $tutorial->keywords }}" /> --}}
            <meta itemprop="url" content="{{ route('front.tutorialPage', $tutorial->slug) }}" />

            <h1
                class="text-5xl md:text-6xl lg:text-7xl px-10 text-center leading-tight text-red-600 font-bold tracking-tighter mt-20">
                <span class="hover:underline transition duration-200 ease-in-out uppercase">
                    {{ $tutorial->title }}
                </span>
            </h1>

            {{-- <h4 class="mt-2 text-sm text-gray-500">{{ $tutorial->category?->title }}</h4> --}}
            <h4 class="mt-2 text-sm text-gray-500">{{ $tutorial->updated_at }}</h4>

            <div class="mt-6 prose prose-green prose-lg text-black mx-auto">
                {!! $tutorial->content !!}
            </div>

        </article>
    </section>
</div>