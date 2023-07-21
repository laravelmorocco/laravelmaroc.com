<div>
    <div class="space-y-4 flex flex-col items-center justify-center my-4">
        @foreach ($options as $index => $option)
            <div class="flex flex-row w-full items-center space-x-4">
                <select wire:model.lazy="options.{{ $index }}.type"
                    class="block w-full bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                    <option value="">{{ __('Choose an option') }}</option>
                </select>
                <input type="text" wire:model.lazy="options.{{ $index }}.value">
                <x-button danger type="button" wire:click="removeOption({{ $index }})">{{ __('Remove') }}
                </x-button>
            </div>
        @endforeach
        <x-button primary type="button" wire:click="addOption">{{ __('Add Option') }}</x-button>
    </div>
</div>
