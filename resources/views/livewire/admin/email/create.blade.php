<div>
    <!-- Create Modal -->
    <x-modal wire:model="createModal">
        <x-slot name="title">
            {{ __('Create Email Template') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="grid grid-cols-2 gap-2">
                    <div class="w-full">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.lazy="email_setting.name" />
                        <x-input-error :messages="$errors->get('email_setting.name')" for="name" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="subject" :value="__('Subject')" />
                        <x-input id="subject" class="block mt-1 w-full" type="text" name="subject"
                            wire:model.lazy="email_setting.subject" />
                        <x-input-error :messages="$errors->get('email_setting.subject')" for="subject" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="placeholders" :value="__('Placeholders')" />
                        <select id="placeholders" class="block mt-1 w-full" name="placeholders"
                            wire:model.lazy="email_setting.placeholders" multiple>
                            <option value="name">Name</option>
                            <option value="email">Email</option>
                            <option value="order_id">Order ID</option>
                            <!-- Add more options as needed -->
                        </select>
                        <x-input-error :messages="$errors->get('email_setting.placeholders')" for="placeholders" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-label for="type" :value="__('Type')" />
                        <select id="type" class="block mt-1 w-full" name="type"
                            wire:model.lazy="email_setting.type">
                            <option value="newsletter">{{ __('Newsletter') }}</option>
                            <option value="order_confirmation">{{ __('Order Confirmation') }}</option>
                            <!-- Add more options as needed -->
                        </select>
                        <x-input-error :messages="$errors->get('email_setting.type')" for="type" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="default" :value="__('Default')" />
                        <label class="flex items-center mt-2">
                            <input id="default" name="default" type="checkbox" class="form-checkbox"
                                wire:model.lazy="email_setting.default">
                            <span class="ml-2">{{ __('Default') }}</span>
                        </label>
                        <x-input-error :messages="$errors->get('email_setting.default')" for="default" class="mt-2" />
                    </div>
                </div>

                <div class="w-full">
                    <x-label for="description" :value="__('Description')" />
                    <x-trix name="description" wire:model.lazy="description" class="mt-1" />
                    <x-input-error :messages="$errors->get('email_setting.description')" for="description" class="mt-2" />
                </div>

                <div class="w-full">
                    <x-label for="message" :value="__('Message')" />
                    <x-trix name="message" wire:model.lazy="message" class="mt-1" />
                    <x-input-error :messages="$errors->get('email_setting.message')" for="message" class="mt-2" />
                </div>



                <div class="w-full py-4">
                    <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
