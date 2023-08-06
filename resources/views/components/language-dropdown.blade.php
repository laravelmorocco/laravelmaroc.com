<div>
    <x-dropdown>
        <x-slot name="trigger">
            <x-button type="button" secondary>
                <span class="mr-1">{{ strtoupper(app()->getLocale()) }}</span>
            </x-button>
        </x-slot>
        <x-slot name="content">
            @foreach (\App\Models\Language::all() as $language)
                <x-dropdown-link href="{{ route('changeLanguage', $language->code) }}">
                    {{ $language->name }}
                </x-dropdown-link>
            @endforeach
        </x-slot>
    </x-dropdown>
</div>

{{-- <li class="inline-block relative">
    <a class="inline-flex items-center p-2 transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 bg-white text-gray-500 hover:bg-gray-100 focus:ring-blue-500 dark:text-gray-400 dark:bg-dark-eval-1 dark:hover:bg-dark-eval-2 dark:hover:text-gray-200 rounded-md"
        onclick="openDropdown(event,'language-dropdown')" aria-haspopup="true"
        :aria-expanded="open ? 'true' : 'false'">
        <img src="{{ flagImageUrl(\Illuminate\Support\Facades\App::getLocale()) }}"
            class="px-2">
        @if (count($languages) > 1)
            <x-heroicon-o-chevron-down class="flex-shrink-0 w-4 h-4" aria-hidden="true" />
        @endif
    </a>
    @if (count($languages) > 1)
        <ul id="language-dropdown"
            class="bg-white text-gray-500 focus:ring focus:ring-offset-2 focus:ring-blue-500 dark:text-gray-400 dark:bg-dark-eval-1 transition-colors z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48 hidden"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(617px, 58px);">
            @foreach ($languages as $language)
                @if (\Illuminate\Support\Facades\App::getLocale() !== $language->code)
                    <li class="flex">
                        <a class="py-2 px-4 text-sm dark:hover:bg-gray-600 dark:hover:text-gray-200 w-full whitespace-nowrap"
                            href="{{ route('change_language', $language->code) }}"
                            title="{{ $language->name }}">
                            {{ $language->name }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</li> --}}
