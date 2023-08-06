@section('title', __('Contact List'))

<div class="card bg-white dark:bg-dark-eval-1">
    <div class="p-6 rounded-t rounded-r mb-0 border-b border-slate-200">
        <div class="card-header-container flex flex-wrap">
            <h6 class="text-xl font-bold text-zinc-700 dark:text-zinc-300">
                {{ __('Contact list') }}
            </h6>
        </div>
    </div>
    <div class="p-4">
        <div>
            <div class="flex flex-wrap justify-center">
                <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-wrap my-md-0 my-2">
                    <select wire:model.lazy="perPage"
                        class="w-20 block p-3 leading-5 bg-white dark:bg-dark-eval-2 text-zinc-700 dark:text-zinc-300 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-300 mr-3">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <button
                        class="text-blue-500 dark:text-zinc-300 bg-transparent dark:bg-dark-eval-2 border border-blue-500 dark:border-zinc-300 hover:text-blue-700  active:bg-blue-600 font-bold uppercase text-xs p-3 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                        type="button" wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                        <i class="fa fas-trash h-4 w-4" ></i>
                    </button>
                </div>

                <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
                    <div class="">
                        <input type="text" wire:model.debounce.300ms="search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="{{ __('Search') }}" />
                    </div>
                </div>
            </div>
            <div wire:loading.delay>
                Loading...
            </div>

            <x-table>
                <x-slot name="thead">
                    <x-table.th>#</x-table.th>
                    <x-table.th sortable wire:click="sortBy('created_at')" :direction="$sorts['created_at'] ?? null">
                        {{ __('Created at') }}
                        @include('components.table.sort', ['field' => 'created_at'])
                    </x-table.th>
                    <x-table.th sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">
                        {{ __('Name') }}
                        @include('components.table.sort', ['field' => 'name'])
                    </x-table.th>
                    <x-table.th sortable wire:click="sortBy('email')" :direction="$sorts['email'] ?? null">
                        {{ __('Email') }}
                        @include('components.table.sort', ['field' => 'email'])
                    </x-table.th>
                    <x-table.th>
                        {{ __('Phone') }}
                    </x-table.th>
                    <x-table.th>
                        {{ __('Subject') }}
                    </x-table.th>
                    <x-table.th>
                        {{ __('Actions') }}
                    </x-table.th>
                </x-slot>
                <x-table.tbody>
                    @forelse($contacts as $contact)
                        <x-table.tr>
                            <x-table.td>
                                <input type="checkbox" value="{{ $contact->id }}" wire:model.lazy="selected">
                            </x-table.td>
                            <x-table.td>
                                {{ $contact->created_at }}
                            </x-table.td>
                            <x-table.td>
                                {{ $contact->name }}
                            </x-table.td>
                            <x-table.td>
                                {{ $contact->email }}
                            </x-table.td>
                            <x-table.td>
                                {{ $contact->phone_number }}
                            </x-table.td>
                            <x-table.td>
                                {{ $contact->subject }}
                            </x-table.td>
                            <x-table.td>
                                <button
                                    class="font-bold border-transparent uppercase justify-center text-xs py-1 px-2 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 mr-1 ease-linear transition-all duration-150 cursor-pointer text-white bg-red-500 border-red-800 hover:bg-red-600 active:bg-red-700 focus:ring-red-300"
                                    wire:click="confirm('delete', {{ $contact->id }})" type="button">
                                    <i class="fa fas-trash h-4 w-4" ></i>
                                </button>
                            </x-table.td>
                        </x-table.tr>
                    @empty
                        <x-table.tr>
                            <x-table.td colspan="10" class="text-center">
                                {{ __('No entries found.') }}
                            </x-table.td>
                        </x-table.tr>
                    @endforelse
                </x-table.tbody>
            </x-table>

            <div class="p-4">
                <div class="pt-3">
                    @if ($this->selectedCount)
                        <p class="text-sm leading-5">
                            <span class="font-medium">
                                {{ $this->selectedCount }}
                            </span>
                            {{ __('Entries selected') }}
                        </p>
                    @endif
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


