<div>
    <div wire:ignore class="w-full">
        <select  {{ $attributes->merge(['class' => 'select2 w-full p-3 leading-5 bg-white rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500 ']) }}>
            @foreach ($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let el = $('#{{ $attributes['id'] }}')

            function initSelect() {
                el.select2({
                    dropdownAutoWidth: true,
                    language: "{{ App::getLocale() }}",
                    placeholder: '{{ __('Select your option') }}',
                    minimumResultsForSearch: 5,
                    allowClear: !el.attr('required'),
                    width: '100%'
                })
            }
            initSelect()
            el.on('change', function(e) {
                @this.set('{{ $attributes['wire:model'] }}', el.val());
            });
        });
    </script>
@endpush
