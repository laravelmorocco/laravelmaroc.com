<div>
    <div class="px-4">
        <x-auth-validation-errors class="mb-4 text-red-400 text-center" :errors="$errors" />
        <form wire:submit.prevent="newsletterform" class="flex items-center justify-center">
            <input type="email" wire:model="newsletter.email" id="email" name="email"
                autocomplete="email"
                placeholder="{{ __('Enter your email') }}" value="{{ old('email') }}"
                class="@error('email') is-invalid @enderror bg-gray-100 rounded-lg rounded-r-none leading-none text-gray-800 p-4 sm:text-sm text-md w-4/5 border border-transparent focus:outline-none focus:border-blue-500 shadow-md">
            <x-input-error :messages="$errors->get('email')" for="email" class="mt-2" />
            <button
                class="w-32 rounded-l-none bg-green-600 hover:bg-green-700 rounded font-medium leading-none text-white p-3 uppercase focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700 shadow-md">
                <span>{{ __('Subscribe now') }}</span>
            </button>
        </form>
    </div>
</div>
