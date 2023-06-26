<div>
@section('title', $blog?->title)


    <section class="relative items-center w-full px-5 py-10 mx-auto md:px-12 lg:px-24 max-w-7xl">
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose mx-auto py-10">
            <img src="{{ asset('images/blog' . $blog->image) }}" alt="{{ $blog->title }}"
                class="object-cover object-top w-full" />
            <meta itemprop="image" content="{{ asset('images/blog' . $blog->image) }}" />
            <meta itemprop="author" content="{{ $blog->user?->name }}" />
            <meta itemprop="datePublished" content="{{ $blog->updated_at }}" />
            <meta itemprop="dateModified" content="{{ $blog->updated_at }}" />
            <meta itemprop="headline" content="{{ $blog->title }}" />
            <meta itemprop="description" content="{{ $blog->description }}" />
            <meta itemprop="articleSection" content="{{ $blog->category?->title }}" />
            {{-- <meta itemprop="keywords" content="{{ $blog->keywords }}" /> --}}
            <meta itemprop="url" content="{{ route('front.blogPage', $blog->slug) }}" />

            <h1
                class="text-5xl md:text-6xl lg:text-7xl px-10 text-center leading-tight text-green-600 font-bold tracking-tighter mt-20">
                <span class="hover:underline transition duration-200 ease-in-out uppercase">
                    {{ $blog->title }}
                </span>
            </h1>

            <h4 class="mt-2 text-sm text-gray-500">{{ $blog->category?->title }}</h4>
            <h4 class="mt-2 text-sm text-gray-500">{{ $blog->updated_at }}</h4>

            <div class="mt-6 prose prose-green prose-lg text-black mx-auto">
                {!! $blog->content !!}
            </div>

        </article>
    </section>
</div>