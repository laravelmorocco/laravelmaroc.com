<div>
    <section>
        <p class="text-center">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </p>
        <form wire:submit.prevent="submit">
            <div class="grid gap-2 sm:grid-cols-1 xl:grid-cols-2">
                <p>
                    <input type="text" wire:model.lazy="name" id="name" name="name"
                        placeholder="{{ __('Company name') }}" value="{{ old('name') }}" autocomplete="name"
                        class="@error('name') is-invalid @enderror w-full bg-zinc-100 bg-opacity-50 rounded border border-zinc-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-zinc-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    <x-input-error :messages="$errors->get('name')" for="name" class="mt-2" />
                </p>
                <p>
                    <input type="email" wire:model.lazy="email" id="email" name="email"
                        placeholder="{{ __('Company Email') }}" value="{{ old('email') }}" autocomplete="email"
                        class="@error('email') is-invalid @enderror w-full bg-zinc-100 bg-opacity-50 rounded border border-zinc-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-zinc-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    <x-input-error :messages="$errors->get('email')" for="email" class="mt-2" />
                </p>
                <p>
                    <input type="text" wire:model.lazy="phone_number" id="phone_number" name="phone_number"
                        placeholder="{{ __('Phone number') }}" value="{{ old('phone_number') }}" autocomplete="mobile"
                        class="@error('phone_number') is-invalid @enderror w-full bg-zinc-100 bg-opacity-50 rounded border border-zinc-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-zinc-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    <x-input-error :messages="$errors->get('phone_number')" for="phone_number" class="mt-2" />
                </p>
                <p>
                    <select id="subject" wire:model="subject" name="subject"
                        class="@error('subject') is-invalid @enderror w-full bg-zinc-100 bg-opacity-50 rounded border border-zinc-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-zinc-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        <option>{{ __('Departement') }}</option>
                        <option value="Information">{{ __('Information') }}</option>
                        <option value="Registration">{{ __('Registration') }}</option>
                        <option value="Problem">{{ __('Problem') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('subject')" for="subject" class="mt-2" />
                </p>
            </div>
            <p class="py-4">
                <textarea id="message" wire:model.lazy="message" name="message" placeholder="Message" value="{{ old('message') }}"
                    class="w-full h-56 bg-zinc-100 bg-opacity-50 rounded border border-zinc-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-zinc-700 py-1 px-3 leading-6 transition-colors duration-200 ease-in-out"></textarea>
                <x-input-error :messages="$errors->get('message')" for="subject" class="mt-2" />
            </p>
            <button
                class="md:text-sm sm:text-xs bg-gradient-to-r from-green-400 to-green-600 text-white hover:text-red-100 hover:from-green-500 hover:to-green-700 active:from-green-600 active:to-green-800 focus:ring-green-300 text-sm font-bold uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150">
                <span>
                    <div wire:loading wire:target="submit">
                        <x-loading />
                    </div>
                    <span>{{ __('Send Message') }}</span>
                </span>
            </button>
        </form>
    </section>
</div>
