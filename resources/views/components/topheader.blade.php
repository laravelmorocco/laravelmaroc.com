<div class="px-6 py-2 bg-orange-600 text-white">
    <div class="flex items-center justify-center md:justify-between">
        <p class="text-xs text-center font-semibold font-heading hover:text-gray-400 hover:underline">
            LaravelMaroc
        </p>
        @if (Auth::check())
            <x-dropdown align="right" width="56">
                <x-slot name="trigger">
                    <div class="flex items-center text-white px-4">
                        <i class="fa fa-caret-down ml-2"></i> {{ Auth::user()->name }}
                    </div>
                </x-slot>

                <x-slot name="content">
                    {{-- if admin show dashboard and settings else show logout --}}
                    @if (Auth::user()->isAdmin())
                        <x-dropdown-link href="{{ route('admin.dashboard') }}">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('admin.settings.index')">
                            {{ __('Settings') }}
                        </x-dropdown-link>
                    @else
                        <x-dropdown-link href="{{ route('front.myaccount') }}">
                            {{ __('My account') }}
                        </x-dropdown-link>
                    @endif

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        @else
            <button class="flex-shrink-0 hidden md:block px-4">
                <div class="flex items-center text-white space-x-2">
                    <a href="{{ route('auth') }}"
                        class="mr-2 text-xs text-center font-semibold font-heading hover:text-gray-400 hover:underline">{{ __('Login') }}
                    </a>
                    <a href="{{ route('auth') }}"
                        class="ml-2 text-xs text-center font-semibold font-heading hover:text-gray-400 hover:underline">
                        {{ __('Register') }}</a>
                </div>
            </button>
        @endif
    </div>
</div>
