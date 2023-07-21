<div>
    <div class="relative items-center w-full px-5 py-10 mx-auto md:px-12 lg:px-24 max-w-7xl">
        <h1
            class="text-5xl md:text-6xl lg:text-7xl px-10 text-center leading-tight text-red-600 font-bold tracking-tighter mt-20 cursor-pointer">
            <span class="hover:underline transition duration-200 ease-in-out uppercase">{{ __('Tutorial') }}</span>
        </h1>
        <p class="text-2xl font-light text-gray-400 text-center my-4">{{ __('Browse the latest news & tutorial tutorials') }}</p>
        <div class="container mx-auto py-4">
            <div class="flex justify-center gap-4 mt-2">
                {{-- <button
                    class="px-4 py-2 text-sm font-semibold text-red-500 border-2 border-red-500 rounded-full hover:bg-red-500 hover:text-white focus:outline-none focus:bg-red-500 focus:text-white"
                    wire:click="$emit('categorySelected', null)">
                    {{ __('All') }}
                </button>
                @foreach ($this->categories as $category)
                    <button
                        class="px-4 py-2 text-sm font-semibold text-red-500 border-2 border-red-500 rounded-full hover:bg-red-500 hover:text-white focus:outline-none focus:bg-red-500 focus:text-white"
                        wire:click="$emit('categorySelected', {{ $category->id }})">
                        {{ $category->title }}
                    </button>
                @endforeach --}}
            </div>

            <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($tutorials as $tutorial)
                    <div
                        class="bg-white border-2 border-red-600 text-white hover:bg-red-400 hover:text-red-800 transition duration-300 max-w-sm rounded overflow-hidden shadow-lg py-4 px-8">
                        <a href="{{ route('front.tutorialPage', $tutorial->slug) }}">
                            <h4 class="text-lg mb-3 font-semibold">{{ $tutorial->title }}</h4>
                        </a>
                        <p class="mb-2 text-sm text-black">
                            {!! $tutorial->content !!}
                        </p>

                        <img src="{{ asset('images/tutorial' . $tutorial->image) }}" class="w-100" alt="{{ $tutorial->title }}">
                    </div>
                @empty
                    <div class="text-center">
                        <p>{{ __('No entries found.') }}</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $tutorials->links() }}
            </div>
        </div>
    </div>
</div>
