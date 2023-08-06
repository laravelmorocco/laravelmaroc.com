<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form class="py-10" enctype="multipart/form-data" wire:submit.prevent="submit">
        <div class="w-full">
            <x-label for="language_id" :value="__('Language')" />
            <select wire:model="team.language_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  lang"
                name="language_id">
                @foreach ($langs as $lang)
                    <option value="{{ $lang->id }}">
                        {{ $lang->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error for="team.language_id" />
        </div>
        <div class="flex flex-wrap">
            <div class="lg:w-1/2 sm:w-full pr-2">
                <x-label for="name" :value="__('Name')" />
                <input type="text" name="name" wire:model.lazy="team.name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                placeholder="{{ __('Name') }}" value="{{ old('name') }}">
                <x-input-error for="team.name" />
            </div>
            <div class="lg:w-1/2 sm:w-full pl-2">
                <x-label for="role" :value="__('Role')" />
                <input type="text" name="role" wire:model.lazy="team.role"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                placeholder="{{ __('Role') }}" value="{{ old('role') }}">
                <x-input-error for="team.role" />
            </div>
        </div>
        <div class="w-full">
            <x-label for="content" :value="__('Description')" />
            <x-trix name="description" wire:model.lazy="description" class="mt-1" />
                        <x-input-error :messages="$errors->get('description')" for="description" class="mt-2" />
        </div>
        <div class="flex flex-wrap py-10">
            <div class="lg:w-2/5 sm:w-full">
                @if (empty($team->image))
                            {{ __('No images') }}
                @else
                    <img class="w-52 rounded-full" src="{{ asset('uploads/teams/' . $team->image) }}" alt="">
                @endif
            </div>
            <div class="lg:w-3/5 sm:w-full">
                <x-label for="image" :value="__('Image')" />
                <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                <p class="help-block text-info">
                    {{ __('Upload 670X418 (Pixel) Size image for best quality. Only jpg, jpeg, png image is allowed.') }}
                </p>
                <x-input-error for="team.image" />
            </div>
            <div class="container">
                <label class="inline-flex items-center cursor-pointer">
                    <x-checkbox name="status" id="status" wire:model.lazy="team.status"> {{ __('Active') }}</x-checkbox>
                    <x-input-error for="team.status" />
                    <span class="ml-2 text-sm font-semibold text-gray-700">{{ __('Publication Status') }}</span>
                </label>
            </div>
        </div>
        <div class="float-right p-2 mb-4">
            <button type="submit"
                class="leading-4 md:text-sm sm:text-xs bg-blue-900 text-white hover:text-blue-800 hover:bg-blue-100 active:bg-blue-200 focus:ring-blue-300 font-medium uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-center">
                {{ __('Save') }}
            </button>
            <a href="{{ route('admin.teams.index') }}"
                class="leading-4 md:text-sm sm:text-xs bg-gray-400 text-black hover:text-blue-800 hover:bg-gray-100 active:bg-blue-200 focus:ring-blue-300 font-medium uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                {{ __('Go back') }}
            </a>
        </div>
    </form>
</div>

@push('scripts')
     <!-- Image Upload -->
     <script type="text/javascript"  src="{{ asset('js/image-upload.js') }}"></script>
@endpush