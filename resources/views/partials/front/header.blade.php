
<div class="menu-toggle">
    <div class="icon"></div>
</div>

<div class="follow-us"> {{ __('FOLLOW US') }} </div>

<div class="main-menu">

    <div class="contant-info">
        <div><a href="mailto:{{ $email }}">{{ $email }}</a></div>
        <div>{{ $phone_number }}</div>
    </div>
    <div class="menu-links">
        <ul>
            <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
            <li><a href="{{ route('front.project') }}">{{ __('Work') }}</a></li>
            <li><a href="{{ route('front.blogs') }}">{{ __('Blog') }}</a></li>
            <li><a href="{{ route('front.contact') }}">{{ __('Contact') }}</a></li>
        </ul>
    </div>
</div>
<nav class="container-fluid cnav">
    <div class="flex flex-wrap">
        <div class="flex-grow">
            <div class="logo-holder">
                <a href="{{ route('front.index') }}"><img class="logo"
                        src="{{ asset('images/logo.svg') }}" alt="{{ $website_title }}"></a>
            </div>
        </div>
        <div class="flex-grow text-right">
            <div class="right_header_languages">
                <div
                    class="translate cursor-pointer languages text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <img src="{{ flagImageUrl(\Illuminate\Support\Facades\App::getLocale()) }}">
                    @if (count($langs) > 1)
                        <x-heroicon-o-chevron-down class="flex-shrink-0 w-5 h-5 text-white" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
