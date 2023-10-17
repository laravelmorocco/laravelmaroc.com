@php
    $currentTenant = filament()->getTenant();
    $currentTenantName = filament()->getTenantName($currentTenant);
    $items = filament()->getTenantMenuItems();

    $billingItem = $items['billing'] ?? null;
    $billingItemUrl = $billingItem?->getUrl();
    $hasTenantBilling = filament()->hasTenantBilling() || $billingItemUrl;

    $registrationItem = $items['register'] ?? null;
    $registrationItemUrl = $registrationItem?->getUrl();
    $hasTenantRegistration = filament()->hasTenantRegistration() || $registrationItemUrl;

    $canSwitchTenants = count($tenants = array_filter(
        filament()->getUserTenants(filament()->auth()->user()),
        fn (\Illuminate\Database\Eloquent\Model $tenant): bool => ! $tenant->is($currentTenant),
    ));

    $items = \Illuminate\Support\Arr::except($items, ['billing', 'register']);
@endphp

{{ filament()->renderHook('tenant-menu.before') }}

<x-filament::dropdown
    placement="bottom-start"
    teleport
    class="filament-tenant-menu"
>
    <x-slot name="trigger">
        <div
            class="-m-3 flex items-center space-x-3 rounded-lg p-2 transition hover:bg-gray-500/5 rtl:space-x-reverse dark:hover:bg-gray-900/50"
            @if (filament()->isSidebarCollapsibleOnDesktop())
                x-data="{ tooltip: {} }"
                x-init="
                    Alpine.effect(() => {
                        if (Alpine.store('sidebar').isOpen) {
                            tooltip = false
                        } else {
                            tooltip = {
                                content: @js($currentTenantName),
                                theme: Alpine.store('theme') === 'light' ? 'dark' : 'light',
                                placement: document.dir === 'rtl' ? 'left' : 'right',
                            }
                        }
                    })
                "
                x-tooltip.html="tooltip"
                x-bind:class="{
                    'justify-center': ! $store.sidebar.isOpen,
                }"
            @endif
        >
            <x-filament::avatar.tenant
                :tenant="$currentTenant"
                class="shrink-0"
            />

            <div
                @if (filament()->isSidebarCollapsibleOnDesktop())
                    x-data="{}"
                    x-show="$store.sidebar.isOpen"
                @endif
            >
                @if ($currentTenant instanceof \Filament\Models\Contracts\HasCurrentTenantLabel)
                    <p
                        class="-mb-0.5 text-[.625rem] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400"
                    >
                        {{ $currentTenant->getCurrentTenantLabel() }}
                    </p>
                @endif

                <p class="font-medium tracking-tight">
                    {{ $currentTenantName }}
                </p>
            </div>
        </div>
    </x-slot>

    @if (count($items))
        <x-filament::dropdown.list>
            @foreach ($items as $item)
                <x-filament::dropdown.list.item
                    :color="$item->getColor() ?? 'gray'"
                    :href="$item->getUrl()"
                    :icon="$item->getIcon()"
                    tag="a"
                >
                    {{ $item->getLabel() }}
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    @endif

    @if ($hasTenantBilling)
        <x-filament::dropdown.list>
            <x-filament::dropdown.list.item
                :color="$billingItem?->getColor() ?? 'gray'"
                :href="$billingItemUrl ?? filament()->getTenantBillingUrl()"
                :icon="$billingItem?->getIcon() ?? 'heroicon-m-credit-card'"
                tag="a"
            >
                {{ $billingItem?->getLabel() ?? __('filament::layout.buttons.billing.label') }}
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    @endif

    @if ($canSwitchTenants)
        <x-filament::dropdown.list>
            @foreach ($tenants as $tenant)
                <x-filament::dropdown.list.item
                    color="gray"
                    :href="filament()->getUrl($tenant)"
                    :image="filament()->getTenantAvatarUrl($tenant)"
                    tag="a"
                >
                    {{ filament()->getTenantName($tenant) }}
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    @endif

    @if ($hasTenantRegistration)
        <x-filament::dropdown.list>
            <x-filament::dropdown.list.item
                :color="$registrationItem?->getColor() ?? 'gray'"
                :href="$registrationItemUrl ?? filament()->getTenantRegistrationUrl()"
                :icon="$registrationItem?->getIcon() ?? 'heroicon-m-plus'"
                tag="a"
            >
                {{ $registrationItem?->getLabel() ?? filament()->getTenantRegistrationPage()::getLabel() }}
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    @endif
</x-filament::dropdown>

{{ filament()->renderHook('tenant-menu.after') }}
