@section('title', $page->title)
<x-app-layout>
    <section>
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose prose-xl mx-auto py-8">
            <img src="{{ asset('images/page' . $page->image) }}" alt="{{ $page->title }}"
                class="object-cover object-top w-full" />
            <h1 class="mt-6 text-3xl text-center font-bold text-white md:text-5xl">
                {{ $page->title }}
            </h1>
            <div class="py-10">
                @livewire('editorjs', [
                    'editorId' => 'myEditor',
                    'value' => $description,
                    'readOnly' => true,
                ])
            </div>
        </article>
    </section>
    @once
        @push('scripts')
            <script src="{{ asset('vendor/livewire-editorjs/editorjs.js') }}"></script>
        @endpush
    @endonce
</x-app-layout>
