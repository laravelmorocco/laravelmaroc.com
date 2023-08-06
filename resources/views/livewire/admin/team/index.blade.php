<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <p class="leading-5 text-black mb-1 text-sm ">
                    {{ __('Show items per page') }}
                </p>
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            @if ($this->selected)
                <x-button danger type="button" wire:click="deleteSelected" class="mx-3">
                    <i class="fas fa-trash-alt"></i>
                </x-button>
            @endif
            @if ($this->selectedCount)
                <p class="text-sm items-center leading-5">
                    <span class="font-medium ml-2">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="flex items-center mr-3 pl-4">
                <input wire:model="search" type="text"
                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pr-10"
                    placeholder="{{ __('Search...') }}" />
            </div>
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th>#</x-table.th>
            {{-- <x-table.th sortable wire:click="sortBy('title')" :direction="$sorts['title'] ?? null">
                {{ __('Title') }}
                @include('components.table.sort', ['field' => 'title'])
            </x-table.th> --}}
            <x-table.th>
                {{ __('Language') }}
            </x-table.th>
            <x-table.th sortable wire:click="sortBy('title')" :direction="$sorts['title'] ?? null">
                {{ __('Title') }}
                @include('components.table.sort', ['field' => 'title'])
            </x-table.th>
            <x-table.th>
                {{ __('Status') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>

        </x-slot>
        <x-table.tbody>
            @forelse($teams as $team)
                <x-table.tr class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <x-table.td id="accordion-collapse" data-accordion="collapse">
                        <div id="accordion-collapse-heading-{{ $team->id }}">
                            <button type="button"
                                class="font-bold border-transparent uppercase justify-center text-xs py-1 px-2 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 ease-linear transition-all duration-150 cursor-pointer text-white bg-blue-500 border-blue-800 hover:bg-blue-600 active:bg-blue-700 focus:ring-blue-300 mr-2"
                                data-accordion-target="#accordion-collapse-body-{{ $team->id }}"
                                aria-expanded="false" aria-controls="accordion-collapse-body-{{ $team->id }}">
                                <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        {{-- <input type="checkbox" value="{{ $team->id }}" wire:model="selected"> --}}
                    </x-table.td>
                    <x-table.td>
                        <img src="{{ flagImageUrl($team->language->code) }}">
                    </x-table.td>
                    <x-table.td>
                        {{ $team->name }}
                    </x-table.td>
                    <x-table.td>
                        <livewire:utils.toggle-button :model="$team" field="status" key="{{ $team->id }}" />
                    </x-table.td>
                    <x-table.td>
                        <div class="inline-flex">
                            <a class="font-bold border-transparent uppercase justify-center text-xs py-2 px-3 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 ease-linear transition-all duration-150 cursor-pointer text-white bg-green-500 border-green-800 hover:bg-green-600 active:bg-green-700 focus:ring-green-300 mr-2"
                                {{-- href="{{ route('admin.teams.edit', $team) }}" --}}
                                >
                                <i class="fa fas-pen h-4 w-4" ></i>
                            </a>
                            <button
                                class="font-bold border-transparent uppercase justify-center text-xs py-2 px-3 rounded shadow hover:shadow-md outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 ease-linear transition-all duration-150 cursor-pointer text-white bg-red-500 border-red-800 hover:bg-red-600 active:bg-red-700 focus:ring-red-300 mr-2"
                                type="button" wire:click="confirm('delete', {{ $team->id }})"
                                wire:loading.attr="disabled">
                                <i class="fa fas-trash h-4 w-4" ></i>
                            </button>
                            <button
                                class="font-bold  bg-purple-500 border-purple-800 hover:bg-purple-600 active:bg-purple-700 focus:ring-purple-300 uppercase justify-center text-xs py-2 px-3 rounded shadow hover:shadow-md mr-1 ease-linear transition-all duration-150 cursor-pointer text-white"
                                type="button" wire:click="confirm('clone', {{ $team->id }})"
                                wire:loading.attr="disabled">
                                <i class="fa fas-bin h-4 w-4" ></i>
                            </button>

                        </div>
                    </x-table.td>
                </x-table.tr>
                <tr id="accordion-collapse-body-{{ $team->id }}" class="hidden"
                    aria-labelledby="accordion-collapse-heading-{{ $team->id }}">
                    <td colspan="12">
                        <div class="panel-body text-center p-5">
                            <h1>{{ $team->name }}</h1>
                            <h4>{{ $team->role }}</h4>
                            <p>{!! $team->content !!}</p>
                            <div class="container">

                                @if (empty($team->image))
                                    {{ __('No images') }}
                                @else
                                    <img class="w-52 rounded-full" src="{{ asset('uploads/teams/' . $team->image) }}"
                                        alt="">
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="10" class="text-center">
                        {{ __('No entries found.') }}
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-table.tbody>
    </x-table>

    <div class="card-body">
        <div class="pt-3">
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $teams->links() }}
        </div>
    </div>
</div>


