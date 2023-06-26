<div>
    <div class="x-full h-screen">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form wire:submit.prevent="register">

            <div class="flex flex-wrap space-y-2 mx-2">
                <!-- Name -->
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-input-label for="name" :value="__('Name')" required />

                    <x-text-input id="name" wire:model.lazy="name" class="block mt-1 w-full" type="text"
                    autocomplete="name"
                        name="name" :value="old('name')" required autofocus />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-input-label for="email" :value="__('Email')" required />

                    <x-text-input id="email" wire:model.lazy="email" class="block mt-1 w-full" type="email"
                    autocomplete="email"
                        name="email" :value="old('email')" required />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-input-label for="phone" :value="__('Phone')" required />

                    <x-text-input id="phone" wire:model.lazy="phone" class="block mt-1 w-full" type="number"
                    autocomplete="mobile"
                        name="phone" :value="old('phone')" required />

                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Country -->
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="country" :value="__('Country')" required />

                    <x-input id="country" class="block mt-1 w-full" wire:model.lazy="country" type="text"
                        name="country" :value="old('country')" disabled />
                </div>

                <!-- City -->
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="city" :value="__('City')" required />

                    <x-input id="city" class="block mt-1 w-full" wire:model.lazy="city" type="text"
                        name="city" :value="old('city')" required />
                </div>

                <!-- Password -->
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-input-label for="password" :value="__('Password')" required />

                    <x-text-input id="password" wire:model.lazy="password" class="block mt-1 w-full" type="password""
                        name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" required />

                    <x-text-input id="password_confirmation" wire:model.lazy="passwordConfirmation"
                        class="block mt-1 w-full" type="password" name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex px-4 items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('auth') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button type="submit" primary class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
