<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Category') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="grid grid-cols-2 gap-2">
                    <div class="w-full">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.lazy="category.name" />
                        <x-input-error :messages="$errors->get('category.name')" for="category.name" class="mt-2" />
                    </div>
                   
                </div>
                <div class="w-full">
                    <x-label for="description" :value="__('Description')" />
                    <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                        wire:model.lazy="category.description" />
                    <x-input-error :messages="$errors->get('category.description')" for="category.description" class="mt-2" />
                </div>

                <div class="w-full my-2">
                    <x-label for="image" :value="__('Race Image')" />
                    <x-media-upload title="{{ __('Race Image') }}" name="image" wire:model="image" :file="$image"
                        single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                </div>

                <div class="w-full">
                    <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
