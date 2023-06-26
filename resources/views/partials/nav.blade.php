<nav
    class="flex items-center justify-between p-2 border-b dark:border-blue-800 bg-zinc-100 md:flex-row md:flex-nowrap md:justify-start">
    <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap px-2">
       
        <button @click="sidebarOpen = true" class="text-zinc500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>

        @if (auth()->user()->isAdmin())
        <div class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
           
            {{-- @livewire('admin.cache') --}}
        </div>
        @endif    

        <ul class="hidden items-center md:flex flex-wrap list-none">
            <li class="inline-block relative">
                <a class="text-black block py-1 px-3 cursor-pointer">
                    <span
                        class="absolute -top-1 text-xs font-semibold inline-flex rounded-full h-5 min-w-5 leading-5 justify-center">
                        <button onClick="window.location.reload();"><i class="fa fa-sync"></i></button>
                    </span>
                </a>
            </li>

            <li class="inline-block relative">
                <a class="inline-flex items-center text-black py-1 px-3 cursor-pointer" 
                    onclick="openDropdown(event,'language-dropdown')"
                    aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'">
                    <img src="{{flagImageUrl(\Illuminate\Support\Facades\App::getLocale())}}" class="px-2">
                    @if (count($languages) > 1)
                        <i class="fa fa-angle-down"></i>
                    @endif
                </a>
                @if (count($languages) > 1)
                    <ul id="language-dropdown"
                        class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48 hidden"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" 
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(617px, 58px);">
                        @foreach ($languages as $language)
                            @if (\Illuminate\Support\Facades\App::getLocale() !== $language->code)
                                <li class="flex">
                                    <a class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-slate-100 cursor-pointer text-slate-700"
                                        href="{{ route('change_language', $language->code) }}"
                                        title="{{ $language->name }}">
                                        {{ $language->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
            
            

        </ul>
        <ul class="flex-col md:flex-row list-none items-center md:flex">
            
            <a class="text-black block cursor-pointer" onclick="openDropdown(event,'user-dropdown')"
             aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'">
             <span class="inline-flex rounded-md">
                <button type="button"
                    class="inline-flex items-center px-3 py-2 text-xs bg-blue-900 text-white hover:text-blue-800 hover:bg-blue-100 active:bg-blue-200 focus:ring-blue-300 font-medium uppercase rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150">
                    {{ Auth::user()->name }}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </span>
                
            </a>
            <div data-popper-placement="bottom-start" id="user-dropdown"
            class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48 hidden"
            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(617px, 58px);"
                >
                @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.profile') }}"
                    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-slate-100 cursor-pointer text-slate-700">
                    {{ __('Profil') }}
                </a>
                <a href="{{ url('admin/settings') }}"
                    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-slate-100 cursor-pointer text-slate-700">
                    {{ __('Settings') }}
                </a>
                @endif  
                <a class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-slate-100 cursor-pointer text-slate-700"
                    href="{{ url('/logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
                @forelse(auth()->user()->alerts()->latest()->take(10)->get() as $alert)
                    <a
                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-slate-100 cursor-pointer text-slate-700 {{ $alert->pivot->seen_at ? 'text-slate-400' : 'text-slate-700' }}">
                        <i class="fas fa-bell fa-fw mr-1"></i>
                        {{ $alert->message }}
                    </a>
                @empty
                    <span
                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-slate-100 cursor-pointer text-slate-700">
                        {{ __('No Alerts') }}
                    </span>
                @endforelse
            </div>
        </ul>
    </div>
</nav>
