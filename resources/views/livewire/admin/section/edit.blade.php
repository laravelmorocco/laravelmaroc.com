<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Section') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="update">
                <div class="grid grid-cols-2 gap-4 px-2">
                    <div>
                        <x-label for="language_id" :value="__('Language')" />
                        <select
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="language_id" name="language_id" wire:model="section.language_id">
                            @foreach ($this->languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('section.language_id')" for="section.language_id" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="page" :value="__('Page')" />
                        <select wire:model="section.page_id"
                            class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500  lang"
                            name="page">
                            <option value="">{{ __('Select a page') }}</option>
                            <option value="home" {{ old('page') == 'home' ? 'selected' : '' }}>{{ __('Home') }}
                            </option>
                            <option value="about" {{ old('page') == 'about' ? 'selected' : '' }}>{{ __('About') }}
                            </option>
                            <option value="contact" {{ old('page') == 'contact' ? 'selected' : '' }}>{{ __('Contact') }}
                            </option>
                            <option value="service" {{ old('page') == 'service' ? 'selected' : '' }}>
                                {{ __('Service') }}</option>
                            <option value="portfolio" {{ old('page') == 'portfolio' ? 'selected' : '' }}>
                                {{ __('Portfolio') }}
                            </option>
                            <option value="team" {{ old('page') == 'team' ? 'selected' : '' }}>{{ __('Team') }}
                            </option>
                            <option value="testimonial" {{ old('page') == 'testimonial' ? 'selected' : '' }}>
                                {{ __('Testimonial') }}
                            </option>
                            <option value="blog" {{ old('page') == 'blog' ? 'selected' : '' }}>{{ __('Blog') }}
                            </option>
                            <option value="faq" {{ old('page') == 'faq' ? 'selected' : '' }}>{{ __('FAQ') }}
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('section.page')" for="section.page" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="title" :value="__('Title')" />
                        <x-input type="text" name="title" wire:model.lazy="section.title"
                            placeholder="{{ __('Title') }}" value="{{ old('title') }}" />
                        <x-input-error :messages="$errors->get('section.title')" for="section.title" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="subtitle" :value="__('Subtitle')" />
                        <x-input type="text" name="subtitle" wire:model.lazy="section.subtitle"
                            placeholder="{{ __('Subtitle') }}" value="{{ old('subtitle') }}" />
                        <x-input-error :messages="$errors->get('section.subtitle')" for="section.subtitle" class="mt-2" />
                    </div>
                </div>

                <div class="w-full px-2">
                    <x-label for="description" :value="__('Description')" />
                    <x-trix name="description" wire:model.lazy="description" class="mt-1" />
                    <x-input-error :messages="$errors->get('section.description')" for="section.description" class="mt-2" />
                </div>
                <div class="grid grid-cols-2 gap-4 py-10 px-2">
                    <div class="w-full">
                        <img class="w-52 rounded-full" src="{{ asset('uploads/sections/' . $image) }}" alt="">
                    </div>
                    <div class="w-full">
                        <x-label for="image" :value="__('Image')" />
                        <x-fileupload wire:model="image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('section.image')" for="section.image" class="mt-2" />
                    </div>
                </div>
                <div class="text-center py-4">
                    <x-button type="submit" primary>
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>

</div>
