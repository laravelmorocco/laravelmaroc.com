@props([
    'maxHeight' => null,
    'offset' => 8,
    'placement' => null,
    'shift' => false,
    'teleport' => false,
    'trigger' => null,
    'width' => null,
])

<div
    {{ $attributes->class(['filament-dropdown']) }}
    x-data="{
        toggle: function (event) {
            $refs.panel.toggle(event)
        },
        open: function (event) {
            $refs.panel.open(event)
        },
        close: function (event) {
            $refs.panel.close(event)
        },
    }"
>
    <div
        x-on:click="toggle"
        {{ $trigger->attributes->class(['filament-dropdown-trigger cursor-pointer']) }}
    >
        {{ $trigger }}
    </div>

    <div
        x-ref="panel"
        x-float{{ $placement ? ".placement.{$placement}" : '' }}.flip{{ $shift ? '.shift' : '' }}{{ $teleport ? '.teleport' : '' }}{{ $offset ? '.offset' : '' }}="{ offset: {{ $offset }} }"
        x-cloak
        x-transition:enter-start="scale-95 opacity-0"
        x-transition:leave-end="scale-95 opacity-0"
        @if ($attributes->has('wire:key'))
            wire:ignore.self
            wire:key="{{ $attributes->get('wire:key') }}.panel"
        @endif
        @if ($maxHeight)
            style="max-height: {{ $maxHeight }}"
        @endif
        @class([
            'filament-dropdown-panel absolute z-10 w-screen divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-gray-700 dark:bg-gray-800 dark:ring-white/20',
            match ($width) {
                'xs' => 'max-w-xs',
                'sm' => 'max-w-sm',
                'md' => 'max-w-md',
                'lg' => 'max-w-lg',
                'xl' => 'max-w-xl',
                '2xl' => 'max-w-2xl',
                '3xl' => 'max-w-3xl',
                '4xl' => 'max-w-4xl',
                '5xl' => 'max-w-5xl',
                '6xl' => 'max-w-6xl',
                '7xl' => 'max-w-7xl',
                null => 'max-w-[14rem]',
                default => $width,
            },
            'overflow-y-auto' => $maxHeight,
        ])
    >
        {{ $slot }}
    </div>
</div>
