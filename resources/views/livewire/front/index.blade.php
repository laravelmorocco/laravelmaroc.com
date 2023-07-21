<div>
    @section('title', __('Home'))
    <section class="relative bg-red-600 text-white items-center h-screen">
        <div class="anime max-w-6xl mx-auto px-4 sm:px-6 pt-32 pb-12 md:pt-40 md:pb-20">
            <div
                class="mt-4 flex flex-col max-w-[1400px] items-center mx-auto text-center relative z-10 px-24 sm:px-18 lg:px-24">
                <h1 h1 class="section-title mt-3 text-6xl sm:text-4xl lg:text-8xl font-extrabold text-white">
                    {{ $this->home_section->title }}
                </h1>
                <div class="mb-4 text-3xl md:text-4xl font-heading font-bold text-white leading-normal lg:text-sm">
                    {{ $this->home_section->subtitle }}
                </div>
                <p class="pb-10 text-md text-white leading-normal lg:text-sm lg:pt-0">
                    {!! $this->home_section->description !!}
                </p>
            </div>
        </div>
    </section>

    <section class="mx-auto relative py-24 bg-white text-left" id="dev">
        <div class="relative container px-4 mx-auto">
            <h3 class="pb-10 text-3xl md:text-5xl leading-tight text-gray-900 font-bold tracking-tighter  text-center">
                {{ __('Our community developers are the best in the world. They are the ones who make the difference in our community.') }}
            </h3>
            <div class="flex flex-wrap -mx-4 mt-4">
                @foreach ($this->developers as $developer)
                    <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-4 mb-10">
                        <div class="text-center max-w-xs mx-auto">
                            <img class="w-24 h-24 mx-auto mb-6 rounded-full"
                                src="{{ asset('uploads/developers/' . $developer->image) }}"
                                alt="{{ $developer->name }}">
                            <h3 class="mb-1 text-lg text-gray-900 font-semibold">{{ $developer->name }}</h3>
                            <span class="inline-block mb-6 text-sm leading-tight font-light text-red-500">
                                {!! Str::limit($developer->description, 100) !!}
                            </span>
                            <div class="flex items-center justify-center">
                                <a class="inline-block mr-5 text-gray-300 hover:text-gray-900" href="#">
                                    <svg width="10" height="18" viewbox="0 0 10 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.63494 17.7273V9.76602H9.3583L9.76688 6.66246H6.63494V4.68128C6.63494 3.78301 6.88821 3.17085 8.20297 3.17085L9.87712 3.17017V0.394238C9.5876 0.357335 8.59378 0.272728 7.43708 0.272728C5.0217 0.272728 3.3681 1.71881 3.3681 4.37391V6.66246H0.636475V9.76602H3.3681V17.7273H6.63494Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                                <a class="inline-block mr-5 text-gray-300 hover:text-gray-900" href="#">
                                    <svg width="19" height="16" viewbox="0 0 19 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18.8181 2.14597C18.1356 2.44842 17.4032 2.65355 16.6336 2.74512C17.4194 2.27461 18.0208 1.5283 18.3059 0.641757C17.5689 1.07748 16.7553 1.39388 15.8885 1.56539C15.1943 0.824879 14.2069 0.363636 13.1118 0.363636C11.0108 0.363636 9.30722 2.06718 9.30722 4.16706C9.30722 4.46488 9.34083 4.75576 9.40574 5.03391C6.24434 4.87512 3.44104 3.36048 1.56483 1.05894C1.23686 1.61985 1.05028 2.27342 1.05028 2.97109C1.05028 4.29106 1.72243 5.45573 2.74225 6.13712C2.11877 6.11627 1.53237 5.94476 1.01901 5.65967V5.70718C1.01901 7.54979 2.33086 9.08761 4.07031 9.43761C3.75161 9.52336 3.41555 9.57088 3.06789 9.57088C2.82222 9.57088 2.58464 9.54655 2.35171 9.50018C2.8361 11.0125 4.24067 12.1123 5.90483 12.1424C4.6034 13.1622 2.96243 13.7683 1.1801 13.7683C0.873008 13.7683 0.570523 13.7498 0.272705 13.7162C1.95655 14.7974 3.95561 15.4278 6.10416 15.4278C13.1026 15.4278 16.928 9.63115 16.928 4.60397L16.9153 4.11145C17.6627 3.57833 18.3094 2.90851 18.8181 2.14597Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                                <a class="inline-block text-gray-300 hover:text-gray-900" href="#">
                                    <svg width="20" height="20" viewbox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.6007 0.181818H14.3992C17.3874 0.181818 19.8184 2.61281 19.8182 5.60074V14.3993C19.8182 17.3872 17.3874 19.8182 14.3992 19.8182H5.6007C2.61276 19.8182 0.181885 17.3873 0.181885 14.3993V5.60074C0.181885 2.61281 2.61276 0.181818 5.6007 0.181818ZM14.3993 18.0759C16.4267 18.0759 18.0761 16.4266 18.0761 14.3993H18.076V5.60074C18.076 3.57348 16.4266 1.92405 14.3992 1.92405H5.6007C3.57343 1.92405 1.92412 3.57348 1.92412 5.60074V14.3993C1.92412 16.4266 3.57343 18.0761 5.6007 18.0759H14.3993ZM4.85721 10.0001C4.85721 7.16424 7.16425 4.85714 10.0001 4.85714C12.8359 4.85714 15.1429 7.16424 15.1429 10.0001C15.1429 12.8359 12.8359 15.1429 10.0001 15.1429C7.16425 15.1429 4.85721 12.8359 4.85721 10.0001ZM6.62805 10C6.62805 11.8593 8.14081 13.3719 10.0001 13.3719C11.8593 13.3719 13.3721 11.8593 13.3721 10C13.3721 8.14058 11.8594 6.6279 10.0001 6.6279C8.14069 6.6279 6.62805 8.14058 6.62805 10Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto px-10 py-20 h-auto bg-black" id="about">
        <div class="flex flex-wrap items-center">
            <div class="w-3/4">
                <h3
                    class="pb-10 text-3xl md:text-4xl lg:text-5xl text-left leading-tight text-red-500 font-bold tracking-tighter uppercase cursor-pointer">
                    <span class="text-white hover:underline transition duration-200 ease-in-out">{{ $this->about_section->title }}
                    </span>
                </h3>

                <div class="mb-8 max-w-3xl w-full">
                    <p class="text-base text-white">
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

    <section class="py-24 bg-white">
        <div class="container px-4 mx-auto">
            <div class="md:max-w-5xl mx-auto mb-16 text-center">
                <h3 class="mb-4 text-3xl md:text-5xl leading-tight text-gray-900 font-bold tracking-tighter">
                    {{ __('Our mission is to make knowledge and news accessible for everyone') }}.</h3>
                {{-- <p class="text-lg md:text-xl text-gray-500 font-medium">
                    
                </p> --}}
            </div>
            <div class="flex flex-row px-6 gap-2 mb-12">
                @foreach ($this->blogs as $blog)
                    <div class="w-full lg:w-1/3 md:w-1/2 px-4 mb-8 bg-white rounded-lg">
                        <a class="block mb-6 overflow-hidden rounded-md" href="{{ route('front.blogPage', $blog->id) }}"
                            <img class="w-full" src="{{ asset('uploads/blogs/' . $blog->image) }}"
                            alt="{{ $blog->title }}">
                        </a>
                        <a class="inline-block mb-4 text-2xl leading-tight text-gray-900 hover:text-gray-400 font-bold hover:underline"
                            href="#">
                            {{ $blog->title }}
                        </a>
                        <p class="mb-4 text-base md:text-sm text-gray-400 font-medium">
                            {!! $blog->description !!}
                        </p>
                        <a class="inline-flex items-center text-base md:text-lg text-red-500 hover:text-red-600 font-semibold"
                            href="{{ route('front.blogPage', $blog->id) }}">
                            <span class="mr-3">{{ __('Read Post') }}</span>
                            <svg width="8" height="10" viewbox="0 0 8 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.94667 4.74665C7.91494 4.66481 7.86736 4.59005 7.80666 4.52665L4.47333 1.19331C4.41117 1.13116 4.33738 1.08185 4.25617 1.04821C4.17495 1.01457 4.08791 0.997253 4 0.997253C3.82246 0.997253 3.6522 1.06778 3.52667 1.19331C3.46451 1.25547 3.4152 1.32927 3.38156 1.41048C3.34792 1.4917 3.33061 1.57874 3.33061 1.66665C3.33061 1.84418 3.40113 2.01445 3.52667 2.13998L5.72667 4.33331H0.666667C0.489856 4.33331 0.320286 4.40355 0.195262 4.52858C0.070238 4.6536 0 4.82317 0 4.99998C0 5.17679 0.070238 5.34636 0.195262 5.47138C0.320286 5.59641 0.489856 5.66665 0.666667 5.66665H5.72667L3.52667 7.85998C3.46418 7.92196 3.41458 7.99569 3.38074 8.07693C3.34689 8.15817 3.32947 8.24531 3.32947 8.33331C3.32947 8.42132 3.34689 8.50846 3.38074 8.5897C3.41458 8.67094 3.46418 8.74467 3.52667 8.80665C3.58864 8.86913 3.66238 8.91873 3.74361 8.95257C3.82485 8.98642 3.91199 9.00385 4 9.00385C4.08801 9.00385 4.17514 8.98642 4.25638 8.95257C4.33762 8.91873 4.41136 8.86913 4.47333 8.80665L7.80666 5.47331C7.86736 5.40991 7.91494 5.33515 7.94667 5.25331C8.01334 5.09101 8.01334 4.90895 7.94667 4.74665Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24 2xl:py-44 font-medium bg-gray-900 text-white rounded-t-10xl">
        <div class="container px-4 mx-auto">
            <div class="max-w-5xl mx-auto text-center">
                <span
                    class="inline-block py-3 px-7 mb-10 font-medium text-xl leading-5 text-white border border-red-500 rounded-6xl">{{ __('Join the community today') }}</span>
                <h2
                    class="mb-14 xl:mb-16 font-heading text-9xl md:text-10xl xl:text-11xl leading-tight text-white dropshadow-lg">
                    {{ __('Get inspired from the all developers') }}</h2>
                <a href="/login"
                    class="inline-block py-5 px-10 text-xl leading-6 text-white font-medium tracking-tighter font-heading bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 rounded-xl">
                    {{ __('Join now') }}
                </a>
            </div>
        </div>
    </section>
</div>
