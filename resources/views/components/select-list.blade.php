<div wire:ignore class="w-full">
    <select class="p-3 leading-5 bg-white text-gray-700  rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500" data-minimum-results-for-search="Infinity" data-placeholder="{{ __('Choose option') }}" {{ $attributes }}>
        @if(!isset($attributes['multiple']))
            <option></option>
        @endif
        <select class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" data-minimum-results-for-search="Infinity" data-placeholder="{{ __('Choose option') }}" {{ $attributes }}>
            @if(!isset($attributes['multiple']))
                <option></option>
            @endif
            @foreach($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("livewire:load", () => {
        let el = $('#{{ $attributes['id'] }}')
        let buttonsId = '#{{ $attributes['id'] }}-btn-container'

        function initButtons() {
            $(buttonsId + ' .select-all-button').click(function (e) {
                el.val(_.map(el.find('option'), opt => $(opt).attr('value')))
                el.trigger('change')
            })

            $(buttonsId + ' .deselect-all-button').click(function (e) {
                el.val([])
                el.trigger('change')
            })
        }

        function initSelect () {
            initButtons()
            el.select2({
                placeholder: '{{ __('Choose option') }}',
                allowClear: !el.attr('required')
            })
        }

        initSelect()

        Livewire.hook('message.processed', (message, component) => {
            initSelect()
        });

        el.on('change', function (e) {
            let data = $(this).select2("val")
            if (data === "") {
                data = null
            }
            @this.set('{{ $attributes['wire:model'] }}', data)
        });
    });
</script>
@endpush
