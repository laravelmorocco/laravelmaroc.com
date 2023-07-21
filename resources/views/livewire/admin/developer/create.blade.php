<div>
    <!-- Create Modal -->
    <x-modal wire:model="createModal">
        <x-slot name="title">
            {{ __('Create Project') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap space-y-2 px-2">
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.lazy="developer.name" />
                        <x-input-error :messages="$errors->get('developer.name')" for="developer.name" class="mt-2" />
                    </div>
                    
                    <div class="w-full px-2">
                        <x-label for="description" :value="__('Description')" />
                        <x-input.textarea wire:model.lazy="developer.description" id="description" />
                        <x-input-error :messages="$errors->get('developer.description')" for="developer.description" class="mt-2" />
                    </div>

                    <div class="w-full px-2">
                        <x-label for="image" :value="__('Brand Logo')" />
                        <x-media-upload title="{{ __('Brand Logo') }}" name="image" wire:model="image" :file="$image"
                            single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                    </div>

                    <div class="w-full px-2">
                        <x-label for="featured_image" :value="__('Featured image')" />
                        <x-media-upload title="{{ __('Featured Image') }}" name="featured_image"
                            wire:model="featured_image" :file="$featured_image" single types="PNG / JPEG / WEBP"
                            fileTypes="image/*" />
                    </div>

                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
