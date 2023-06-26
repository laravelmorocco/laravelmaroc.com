<div>
    <div class="container mx-auto my-5">
        <x-button primary type="button" wire:click="popupModal">
            {{ __('Create') }}
        </x-button>

        <x-table>
            <x-slot name="thead">
                <x-table.th>
                    {{ __('Name') }}
                </x-table.th>
                <x-table.th>
                    {{ __('Created at') }}
                </x-table.th>
                <x-table.th>
                    {{ __('Actions') }}
                </x-table.th>
            </x-slot>

            <x-table.tbody>
                @forelse ($popups as $popup)
                    <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $popup->id }}">
                        <x-table.td>
                            {{ $popup->name }}
                        </x-table.td>
                        <x-table.td>
                            {{ $popup->created_at }}
                        </x-table.td>
                        <x-table.td>
                            @if ($popup->is_default == false)
                                <x-button type="button" success wire:click="setDefault( {{ $popup->id }})">
                                    {{ __('Set as Default') }}</x-button>
                            @endif
                            <x-button type="button" secondary wire:click="popupModal({{ $popup->id }})">
                                {{ __('Edit') }}
                            </x-button>
                            <x-button type="button" danger wire:click="delete{{ $popup->id }})">
                                {{ __('Delete') }}
                            </x-button>
                        </x-table.td>
                    </x-table.tr>
                @empty
                    <x-table.tr>
                        <x-table.td colspan="10" class="text-center">
                            {{ __('No entries found.') }}
                        </x-table.td>
                    </x-table.tr>
                @endforelse
            </x-table.tbody>
        </x-table>

        @if ($popupModal)
            <x-modal wire:model="popupModal">
                <x-slot name="title">
                    <h3>
                        {{ $editing ? __('Update') : __('Create') }}
                    </h3>
                </x-slot>
                <x-slot name="content">
                    <form wire:submit.prevent="{{ $editing ? 'save(' . $popup->id . ')' : 'create' }}">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="delay">{{ __('Name') }}</label>
                                <x-input wire:model="name" type="text" name="name" />
                                <x-input-error :messages="$errors->get('name')" for="name" class="mt-2" />
                            </div>
                            <div>
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="width">{{ __('Width') }}</label>
                                <select wire:model="width" name="width"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="">
                                        {{ __('Select Width') }}
                                    </option>
                                    <option value="sm">{{ __('Small') }}</option>
                                    <option value="md">{{ __('Medium') }}</option>
                                    <option value="lg">{{ __('Large') }}</option>
                                    <option value="xl">{{ __('Extra Large') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('width')" for="width" class="mt-2" />
                            </div>

                            <div>
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="frequency">{{ __('Frequency') }}</label>
                                <select wire:model="frequency" name="frequency"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="">
                                        {{ __('Select Frequency') }}
                                    </option>
                                    <option value="once">{{ __('Once') }}</option>
                                    <option value="multiple">{{ __('Multiple') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('frequency')" for="frequency" class="mt-2" />
                            </div>

                            <div>
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="timing">{{ __('Timing') }}</label>
                                <select wire:model="timing" name="timing"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="">
                                        {{ __('Select Timing') }}
                                    </option>
                                    <option value="delay">{{ __('Delay') }}</option>
                                    <option value="interval">{{ __('Interval') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('timing')" for="timing" class="mt-2" />
                            </div>

                            <div x-show="timing == 'delay' || timing == 'interval'">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="delay">{{ __('Delay/Interval (seconds)') }}</label>
                                <x-input wire:model="delay" type="number" name="delay" />
                                <x-input-error :messages="$errors->get('delay')" for="delay" class="mt-2" />
                            </div>

                            <div x-show="timing == 'duration'">
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="duration">{{ __('Duration (seconds)') }}</label>
                                <x-input wire:model="duration" type="number" name="duration" />
                                <x-input-error :messages="$errors->get('duration')" for="duration" class="mt-2" />
                            </div>

                            <div>
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="color">{{ __('Background Color') }}</label>
                                <x-input wire:model="backgroundColor" type="color" name="backgroundColor" />
                                <x-input-error :messages="$errors->get('backgroundColor')" for="backgroundColor" class="mt-2" />
                            </div>

                            <div>
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="ctaText">{{ __('CTA Text') }}</label>
                                <x-input wire:model="ctaText" type="text" name="ctaText" />
                                <x-input-error :messages="$errors->get('ctaText')" for="ctaText" class="mt-2" />
                            </div>

                            <div>
                                <label class="block font-bold mb-2 text-gray-700"
                                    for="ctaUrl">{{ __('CTA URL') }}</label>
                                <input wire:model="ctaUrl" type="text"
                                    class="block w-full px-4 py-2 leading-tight text-gray-700 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" />
                                <x-input-error :messages="$errors->get('ctaUrl')" for="ctaUrl" class="mt-2" />
                            </div>
                        </div>
                        <div class="w-full py-2">
                            <label class="x block font-bold mb-2 text-gray-700"
                                for="content">{{ __('Content') }}</label>
                            <textarea wire:model="content" name="content"
                                class="block w-full px-4 py-2 leading-tight text-gray-700 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                rows="5"></textarea>
                            <x-input-error :messages="$errors->get('content')" for="content" class="mt-2" />
                        </div>
                        <div class="text-center py-4">
                            <!-- Create form -->
                            <x-button type="submit" primary>
                                {{ $editing ? __('Update') : __('Create') }}
                            </x-button>
                        </div>

                    </form>
                </x-slot>
            </x-modal>

            <!-- Popup Modal -->

        @endif

    </div>
</div>
