<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Brand') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="flex flex-wrap space-y-2 px-2">

                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.lazy="partner.name" />
                        <x-input-error :messages="$errors->get('partner.name')" for="partner.name" class="mt-2" />
                    </div>

                    <div class="w-full px-3">
                        <x-label for="description" :value="__('Description')" />
                        <x-input.textarea wire:model.lazy="partner.description" id="description" />
                        <x-input-error :messages="$errors->get('partner.description')" for="partner.description" class="mt-2" />
                    </div>

                    <div class="flex flex-col space-y-4 py-10 px-2">
                        <div class="block">
                            <img class="w-52 rounded-full" src="{{ asset('uploads/sections/' . $image) }}"
                                alt="">
                        </div>
                        <div class="block">
                            <x-label for="image" :value="__('Image')" />
                            <x-fileupload wire:model="image" accept="image/jpg,image/jpeg,image/png" />
                            <x-input-error :messages="$errors->get('section.image')" for="section.image" class="mt-2" />
                        </div>
                    </div>

                    <div class="w-full py-2 px-3">
                        <x-label for="Brand Logo" :value="__('Featured image')" />
                        <x-media-upload title="{{ __('Featured Image') }}" name="featured_image" :file="$featured_image"
                            :preview="$this->featuredimagepreview" single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                    </div>

                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
