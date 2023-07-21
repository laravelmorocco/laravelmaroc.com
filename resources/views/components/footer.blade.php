<section class="mx-auto py-10 px-5 bg-green-900">
    <div class="flex flex-wrap -mx-4 pb-2 lg:pb-4 border-b border-gray-400">
        <div class="w-full lg:w-3/5 px-4 mb-10">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 px-4 mb-10 lg:mb-0">
                    <h3 class="mb-8 text-xl font-bold font-heading text-white border-b border-red-400 text-left">
                        {{ __('Information') }}</h3>
                    <ul>
                        <li class="mb-6"><a class="text-white hover:text-red-400 hover:underline" href="#">
                                {{ __('About') }}
                            </a>
                        </li>
                        <li class="mb-6"><a class="text-white hover:text-red-400 hover:underline" href="#">
                                {{ __('Blog') }}
                            </a>
                        </li>
                        @foreach (\App\Helpers::getActivePages() as $page)
                            <li>
                                <a href="{{ route('front.dynamicPage', $page->slug) }}"
                                    class="text-white hover:text-red-400 hover:underline">
                                    {{ $page->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-full md:w-1/2 px-4 mb-10 lg:mb-0">
                    <h3 class="mb-8 text-xl font-bold font-heading text-white border-b border-red-400 text-left">
                        {{ __('Open Source') }}</h3>
                    <ul>
                        <li class="mb-6">
                            <a class="text-white hover:text-red-400 hover:underline" href="#">
                                {{ __('Philosophy') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-2/5 px-4 order-first lg:order-1 mb-100">
            <livewire:front.newsletters-form />
            <div class="w-full md:w-auto flex flex-wrap justify-between">
                <a class="inline-flex items-center justify-center w-12 h-12 mr-2 rounded-full"
                    href="{{ Helpers::settings('social_facebook') }}" target="_blank">
                    <i class="fab fa-facebook-f text-xl text-white"></i>
                </a>
                <a class="inline-flex items-center justify-center w-12 h-12 mr-2 rounded-full"
                    href="{{ Helpers::settings('social_instagram') }}" target="_blank">
                    <i class="fab fa-instagram text-xl text-white"></i>
                </a>
                <a class="inline-flex items-center justify-center w-12 h-12 rounded-full"
                    href="{{ Helpers::settings('social_twitter') }}" target="_blank">
                    <i class="fab fa-twitter text-xl text-white"></i>
                </a>
                <a class="inline-flex items-center justify-center w-12 h-12 rounded-full"
                    href="{{ Helpers::settings('social_linkedin') }}" target="_blank">
                    <i class="fab fa-linkedin-in text-xl text-white"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="pt-10 flex items-center justify-center">
        <a class="inline-block mr-4 text-white text-2xl font-bold font-heading" href="#">
            <img class="h-7 w-full" src="{{ asset('images/' . Helpers::settings('site_logo')) }}"
                alt="{{ Helpers::settings('site_title') }}" width="auto">
        </a>
        <p class="inline-block text-sm text-gray-200">
            Copyright 2022 - {{ Helpers::settings('site_title') }}
        </p>
    </div>
</section>
