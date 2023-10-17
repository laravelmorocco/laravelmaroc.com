<div>
    <!-- Create Modal -->
    <x-modal wire:model="createModal">
        <x-slot name="title">
            {{ __('Create Project') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="grid grid-cols-2 gap-4">
                    <div class="">
                        <x-label for="language_id" :value="__('Language')" />
                        <select wire:model="project.language_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 lang"
                            name="language_id">
                            <option value="" selected>{{ __('Select a Language') }}</option>
                            @foreach ($this->languages as $index => $lang)
                                <option value="{{ $index }}">{{ $lang }}</option>
                            @endforeach
                        </select>
                        {{-- <x-input-error for="language_id" /> --}}
                    </div>

                    <div class="">
                        <x-label for="title" :value="__('Title')" />
                        <x-input type="text" wire:model.lazy="project.title" name="title"
                            placeholder="{{ __('Title') }}" />
                        <x-input-error :messages="$errors->get('project.title')" for="title" class="mt-2" />
                    </div>
                    <div class="">
                        <x-label for="client_name" :value="__('Client Name')" />
                        <x-input type="text" wire:model.lazy="project.client_name" name="client_name"
                            placeholder="{{ __('Client Name') }}" />
                        <x-input-error :messages="$errors->get('project.client_name')" for="client_name" class="mt-2" />
                    </div>

                    <div class="">
                        <x-label for="service_id" :value="__('Category')" />
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required id="service_id" name="service_id" wire:model.lazy="project.service_id">
                            <option value="" selected>{{ __('Select a Service') }}</option>
                            @foreach ($this->services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project.service_id')" for="service_id" class="mt-2" />
                    </div>

                    <div class="">
                        <x-label for="link" :value="__('Link')" />
                        <x-input type="text" wire:model.lazy="project.link" name="link"
                            placeholder="{{ __('Live Link') }}" />
                        <x-input-error :messages="$errors->get('project.link')" for="link" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-label for="description" :value="__('Description')" />
                    <x-trix name="description" wire:model.lazy="description" class="mt-1" />
                    <x-input-error :messages="$errors->get('description')" for="description" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="image" :value="__('Gallery')" />
                        <x-fileupload wire:model="image" multiple :file="$image"
                            accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('project.image')" for="image" class="mt-2" />
                        <p class="help-block text-info">
                            {{ __('Upload 710X400 (Pixel) Size image for best quality. Only jpg, jpeg, png image is allowed.') }}
                        </p>
                    </div>
                    <div class="w-full">
                        <x-label for="images" :value="__('Gallery')" />
                        <x-fileupload wire:model="images" :file="$images"
                            accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('project.images')" for="images" class="mt-2" />
                        <p class="help-block text-info">
                            {{ __('Upload 710X400 (Pixel) Size image for best quality. Only jpg, jpeg, png image is allowed.') }}
                        </p>
                    </div>

                    <div class="w-full">
                        <x-label for="meta_title" :value="__('Meta Keywords')" />
                        <x-input type="text" wire:model.lazy="project.meta_title" name="meta_title"
                            placeholder="{{ __('Meta Keywords') }}" />
                        <x-input-error :messages="$errors->get('project.meta_title')" for="meta_title" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="meta_description" :value="__('Meta Description')" />
                        <textarea
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="project.meta_description" name="meta_description" placeholder="{{ __('Meta Description') }}"
                            rows="4">{{ old('meta_description') }}</textarea>
                        <x-input-error :messages="$errors->get('project.meta_description')" for="meta_description" class="mt-2" />
                    </div>
                </div>

                <div class="w-full text-center py-4">
                    <x-button type="submit" primary>
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
