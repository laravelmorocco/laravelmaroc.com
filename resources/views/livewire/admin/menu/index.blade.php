<div>
    <div class="flex flex-wrap">
        <div class="w-1/4 p-4 ">
            <x-button type="button" wire:click="predefinedMenu" primary class="w-full flex justify-center"
                wire:loading.attr="disabled">
                {{ __('Add Predefined Menu') }}
            </x-button>
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            <div class="border border-gray-300 rounded-md shadow-sm py-2 w-full">
                <form wire:submit.prevent="store" class="grid grid-cols gap-2 px-4">
                    <div class="w-full">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.lazy="name" />
                        <x-input-error :messages="$errors->get('menu.name')" for="name" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="type" :value="__('Type')" />
                        <select id="type" class="block mt-1 w-full" name="type" wire:model.lazy="type">
                            <option value="">{{ __('Select Type') }}</option>
                            @foreach (\App\Enums\MenuType::cases() as $case)
                                <option value="{{ $case->value }}" @if ($type === $case->value) selected @endif>
                                    {{ __($case->name) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('menu.type')" for="type" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="placement" :value="__('Placement')" />
                        <select id="placement" class="block mt-1 w-full" name="placement" wire:model.lazy="placement">
                            <option value="">{{ __('Select Placement') }}</option>
                            @foreach (\App\Enums\MenuPlacement::cases() as $case)
                                <option value="{{ $case->value }}" @if ($placement === $case->value) selected @endif>
                                    {{ __($case->name) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('menu.placement')" for="placement" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="label" :value="__('Label')" />
                        <x-input id="label" class="block mt-1 w-full" type="text" name="label"
                            wire:model.lazy="label" />
                        <x-input-error :messages="$errors->get('menu.label')" for="label" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-label for="url" :value="__('URL')" />
                        <x-input id="url" class="block mt-1 w-full" type="text" name="url"
                            wire:model.lazy="url" />
                        <x-input-error :messages="$errors->get('menu.url')" for="url" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-label for="parent_id" :value="__('Parent ID')" />
                        <select id="parent_id" class="block mt-1 w-full" name="parent_id" wire:model.lazy="parent_id">
                            <option value="">None</option>
                            @foreach ($this->menus as $menuItem)
                                <option value="{{ $menuItem['id'] }}">{{ $menuItem['name'] }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('menu.parent_id')" for="parent_id" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-label for="new_window" :value="__('New Window')" />
                        <label class="flex items-center mt-2">
                            <input id="new_window" name="new_window" type="checkbox" class="form-checkbox"
                                wire:model.lazy="new_window">
                            <span class="ml-2">{{ __('New Window') }}</span>
                        </label>
                        <x-input-error :messages="$errors->get('menu.new_window')" for="new_window" class="mt-2" />
                    </div>


                    <div class="w-full py-4">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-3/4 p-4" x-data="{ sortable: null }" x-init="sortable = new Sortable($refs.menuList, {
            handle: '.drag-handle',
            animation: 150,
            onEnd: function(e) {
                const items = Array.from(e.to.children);
                const ids = items.map(item => item.dataset.id);
                @this.updateMenuOrder(ids);
            }
        })">
            <div class="flex justify-center space-x-2 mb-4">
                @foreach (\App\Enums\MenuPlacement::cases() as $case)
                    <x-button type="button" wire:click="filterByPlacement('{{ $case->value }}')" :class="$placement === $case->value
                        ? 'bg-blue-500 text-white'
                        : 'bg-transparent text-blue-500 border border-blue-500'"
                        outline>
                        {{ __($case->name) }}
                    </x-button>
                @endforeach
                <x-button type="button" wire:click="filterByPlacement('')"
                    class="bg-blue-500 text-white' : 'bg-transparent text-blue-500 border border-blue-500"
                    primary-outline>
                    {{__('Clear')}}
                </x-button>
                {{-- <x-button type="button" wire:click="store"
                    class="bg-blue-500 text-white' : 'bg-transparent text-blue-500 border border-blue-500"
                    primary>
                    {{__('Save')}}
                </x-button> --}}
            </div>
            <div class="border border-gray-200 rounded-md shadow-sm mb-2 p-2 w-full" x-ref="menuList">
                @forelse($menus as $index => $menu)
                    <div class="border border-gray-300 rounded-md shadow-sm mb-2 p-2 w-full"
                        wire:loading.class.delay="opacity-50" wire:key="menu-{{ $index }}"
                        data-id="{{ $menu['id'] }}" x-data="{ isMenuOpen: false }">
                        <div class="flex justify-between ">
                            <div class="flex gap-4">
                                <div class="drag-handle cursor-move">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </div>
                                <button @click="isMenuOpen = !isMenuOpen">
                                    <i class="fa"
                                        :class="{
                                            'fa-caret-up': isMenuOpen,
                                            'fa-caret-down': !isMenuOpen
                                        }"
                                        aria-hidden="true">
                                    </i>
                                </button>
                            </div>
                            <button @click="isMenuOpen = !isMenuOpen">
                                <h3 class="text-center">{{ $menu['name'] }}</h3>
                            </button>
                            <button type="button" class="text-red-500 px-2"
                                wire:click="delete({{ $menu['id'] }})" danger><i
                                    class="fas fa-trash-alt"></i></button>
                        </div>

                        <div x-show="isMenuOpen"
                            x-transition:enter="transition ease-out duration-300 transform origin-top"
                            x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-200 opacity-0 transform origin-top"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="-translate-y-4 scale-95">
                            <form wire:submit.prevent="update({{ $menu['id'] }})">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="w-full">
                                        <x-label for="name" :value="__('Name')" />
                                        <x-input id="name{{ $index }}" class="block mt-1 w-full"
                                            type="text" name="name"
                                            wire:model.lazy="menus.{{ $index }}.name" />
                                        <x-input-error :messages="$errors->get('menu.name')" for="name" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <x-label for="type" :value="__('Type')" />
                                        <select id="type{{ $index }}" class="block mt-1 w-full"
                                            name="type" wire:model.lazy="menus.{{ $index }}.type">
                                            <option value="">{{ __('Select Type') }}</option>
                                            @foreach (\App\Enums\MenuType::cases() as $case)
                                                <option value="{{ $case->value }}"
                                                    @if ($menu['type'] === $case->value) selected @endif>
                                                    {{ __($case->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('menu.type')" for="type" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <x-label for="placement" :value="__('Placement')" />
                                        <select id="placement{{ $index }}" class="block mt-1 w-full"
                                            name="placement" wire:model.lazy="menus.{{ $index }}.placement">
                                            <option value="">{{ __('Select Placement') }}</option>
                                            @foreach (\App\Enums\MenuPlacement::cases() as $case)
                                                <option value="{{ $case->value }}"
                                                    @if ($menu['placement'] === $case->value) selected @endif>
                                                    {{ __($case->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('menu.placement')" for="placement" class="mt-2" />
                                    </div>

                                    <div class="w-full">
                                        <x-label for="label" :value="__('Label')" />
                                        <x-input id="label{{ $index }}" class="block mt-1 w-full"
                                            type="text" name="label"
                                            wire:model.lazy="menus.{{ $index }}.label" />
                                        <x-input-error :messages="$errors->get('menu.label')" for="label" class="mt-2" />
                                    </div>

                                    <div class="relative w-full" x-data="{ isOpen: false }">
                                        <x-label for="url" :value="__('URL')" />
                                        <div class="relative">
                                            <x-input id="url" class="block mt-1 w-full" type="text"
                                                name="url" wire:model.lazy="menus.{{ $index }}.url"  />
                                            <div
                                                class="absolute right-0 top-0 h-full w-8 flex items-center justify-center">
                                                <button @click="isOpen = !isOpen" type="button"
                                                    class="text-gray-500 focus:outline-none">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95"
                                            @click.away="isOpen = false"
                                            class="absolute w-full mt-2 bg-white shadow-lg rounded-md overflow-y-auto max-h-60 z-10">
                                            <ul>
                                                @foreach ($links as $link)
                                                    <li>
                                                        <button
                                                            @click="isOpen = false; $refs.url.focus(); $refs.url.value = '{{ $link }}';
                                                                $wire.set('url', '{{ $link }}')"
                                                            type="button"
                                                            class="w-full px-4 py-2 hover:bg-gray-100 text-left">
                                                            {{ $link }}
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <x-input-error :messages="$errors->get('menu.url')" for="url" class="mt-2" />
                                    </div>

                                    <div class="w-full">
                                        <x-label for="parent_id" :value="__('Parent ID')" />
                                        <select id="parent_id{{ $index }}" class="block mt-1 w-full"
                                            name="parent_id" wire:model.lazy="menus.{{ $index }}.parent_id">
                                            <option value="">None</option>
                                            @foreach ($this->menus as $menuItem)
                                                <option value="{{ $menuItem['id'] }}"
                                                    @if ($menuItem['parent_id'] == $menuItem['id']) selected @endif>
                                                    {{ $menuItem['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('menu.parent_id')" for="parent_id" class="mt-2" />
                                    </div>

                                    <div class="w-full">
                                        <x-label for="new_window" :value="__('New Window')" />
                                        <label class="flex items-center mt-2">
                                            <input id="new_window{{ $index }}" name="new_window"
                                                type="checkbox" class="form-checkbox" wire:model.lazy="new_window">
                                            <span class="ml-2">{{ __('New Window') }}</span>
                                        </label>
                                        <x-input-error :messages="$errors->get('menu.new_window')" for="new_window" class="mt-2" />
                                    </div>
                                    <p class="float-right">
                                        <x-button type="button" wire:click="update({{ $menu['id'] }})" primary>
                                            {{ __('Edit') }}
                                        </x-button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center">{{ __('No menus found') }}.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
