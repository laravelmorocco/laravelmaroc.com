<div>
    @section('title', __('Home'))
    <section class="relative bg-red-600 text-white items-center h-screen">

        <div class="anime max-w-6xl mx-auto px-4 sm:px-6 pt-32 pb-12 md:pt-40 md:pb-20">
            <div class="text-center md:text-left pb-12 md:pb-16">
                <h1 h1 class="section-title mt-3 text-6xl sm:text-4xl lg:text-8xl font-extrabold text-white">
                    {{ $this->home_section->title }}
                </h1>
                <div class="max-w-3xl mx-auto md:mx-0">
                    <p class="text-lg text-gray-400 leading-relaxed mb-4 md:mb-8" id="home_section-description">
                        {!! $this->home_section->content !!}
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="mx-auto py-20 h-auto text-left bg-gray-50" id="dev">
        <h3
            class="py-10 text-3xl md:text-4xl lg:text-5xl px-10 text-left leading-tight text-red-600 font-bold tracking-tighter uppercase cursor-pointer">
            <span class="hover:underline transition duration-200 ease-in-out">{{__('Developers')}} </span>
        </h3>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 space-y-2 px-6 items-center">
            @foreach ($this->developers as $partner)
                <p class="p-5 relative bg-gray-100">
                    <img class="mx-auto w-full h-24 my-4 rounded-xl filter grayscale transition duration-300 hover:grayscale-0"
                        src="" alt="{{ $partner->name }}">
                </p>
            @endforeach
        </div>
    </section>

    <section class="mx-auto px-10 py-20 h-auto bg-gray-100" id="about">
        <div class="flex flex-wrap items-center">
            <div class="w-3/4">
                <h3
                    class="pb-10 text-3xl md:text-4xl lg:text-5xl text-left leading-tight text-red-600 font-bold tracking-tighter uppercase cursor-pointer">
                    <span class="hover:underline transition duration-200 ease-in-out">{{ $this->about_section->title }}
                    </span>
                </h3>

                <div class="mb-8 max-w-3xl w-full">
                    <p class="text-base text-gray-800">
                        {!! $this->about_section->description !!}
                    </p>
                </div>
            </div>

            <div class="w-1/4">
                <div class="flex justify-center items-center pin bg-no-repeat md:bg-left w-full bg-center bg-cover h-screen"
                    style="background-image: url({{ asset('uploads/sections/' . $this->about_section->image) }});">
                </div>
            </div>
        </div>
    </section>
</div>
