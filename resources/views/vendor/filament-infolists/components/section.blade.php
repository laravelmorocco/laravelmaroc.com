@php
    $isAside = $isAside();
@endphp

<x-filament::section
    :aside="$isAside"
    :collapsed="$isCollapsed()"
    :collapsible="$isCollapsible() && (! $isAside)"
    :compact="$isCompact()"
    :content-before="$isContentBefore()"
    :icon="$getIcon()"
    :icon-color="$getIconColor()"
    :icon-size="$getIconSize()"
    {{
    $attributes
        ->merge([
            'id' => $getId(),
        ], escape: false)
        ->merge($getExtraAttributes(), escape: false)
        ->merge($getExtraAlpineAttributes(), escape: false)
        ->class(['filament-infolists-section-component'])
}}
>
    <x-slot name="heading">
        {{ $getHeading() }}
    </x-slot>

    <x-slot name="description">
        {{ $getDescription() }}
    </x-slot>

    {{ $getChildComponentContainer() }}
</x-filament::section>
