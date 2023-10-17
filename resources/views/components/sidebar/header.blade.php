<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold">
        <img class="w-14 h-auto" src="{{ asset('images/' . Helpers::settings('site_logo') ) }}" alt="{{ Helpers::settings('company_name') }}">
        <span class="sr-only">
            {{ Helpers::settings('company_name') }}
        </span>
    </a>
</div>
