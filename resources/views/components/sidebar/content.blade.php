<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="{{ __('Dashboard') }}" href="{{ route('admin.dashboard') }}" :isActive="request()->routeIs('home')">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <x-icons.dashboard class="w-5 h-5" aria-hidden="true" />
            </span>
        </x-slot>
    </x-sidebar.link>


    {{-- @can('user_access') --}}
    <x-sidebar.dropdown title="{{ __('Agency') }}" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'agency',
    )">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-users w-5 h-5"></i>
            </span>
        </x-slot>

        
        <x-sidebar.sublink title="{{ __('Projects') }}" href="{{ route('admin.projects.index') }}" :active="request()->routeIs('admin.tutorials.index')" />
        <x-sidebar.sublink title="{{ __('Tutorials') }}" href="{{ route('admin.tutorials.index') }}" :active="request()->routeIs('admin.tutorials.index')" />
    
    </x-sidebar.dropdown>
    {{-- @endcan --}}
   

    <x-sidebar.dropdown title="{{ __('Content') }}" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'pages',
    )">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-file-alt w-5 h-5"></i>
            </span>
        </x-slot>
        {{-- @can('blog_access') --}}
        <x-sidebar.sublink title="{{ __('All Blog') }}" href="{{ route('admin.blogs.index') }}" :active="request()->routeIs('admin.blogs.index')" />
        <x-sidebar.sublink title="{{ __('Blog Categories') }}" href="{{ route('admin.blog-categories.index') }}"
                :active="request()->routeIs('admin.blog-categories.index')" />
        {{-- @endcan --}}
        <x-sidebar.sublink title="{{ __('Pages') }}" href="{{ route('admin.pages') }}" :active="request()->routeIs('admin.pages')" />
        {{-- <x-sidebar.sublink title="{{ __('Page Settings') }}" href="{{ route('admin.page.settings') }}" :active="request()->routeIs('admin.page.settings')" /> --}}
        <x-sidebar.sublink title="{{ __('Sections') }}" href="{{ route('admin.sections') }}" :active="request()->routeIs('admin.sections')" />
        <x-sidebar.sublink title="{{ __('Sliders') }}" href="{{ route('admin.sliders') }}" :active="request()->routeIs('admin.sliders')" />
        <x-sidebar.sublink title="{{ __('Featured Banners') }}" href="{{ route('admin.featuredBanners') }}"
            :active="request()->routeIs('admin.featuredBanners')" />
    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="{{ __('Settings') }}" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'Settings',
    )">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-cog w-5 h-5"></i>
            </span>
        </x-slot>
        {{-- @can('user_access') --}}
        <x-sidebar.sublink title="{{ __('Users') }}" href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users')" />
            {{-- @endcan --}}
            {{-- @can('role_access')  --}}
            {{-- <x-sidebar.sublink title="{{ __('Roles') }}" href="{{ route('admin.roles') }}" :active="request()->routeIs('admin.roles')" /> --}}
            {{-- @endcan --}}
            {{-- @can('permission_access') --}}
            {{-- <x-sidebar.sublink title="{{ __('Permissions') }}" href="{{ route('admin.permissions') }}"
                        :active="request()->routeIs('admin.permissions')" /> --}}
        {{-- @endcan --}}
        {{-- @can('setting_access') --}}
        <x-sidebar.sublink title="{{ __('Settings') }}" href="{{ route('admin.settings.index') }}"
            :active="request()->routeIs('admin.settings.index')" />
        <x-sidebar.sublink title="{{ __('Email Templates') }}" href="{{ route('admin.email-templates.index') }}"
            :active="request()->routeIs('admin.email-templates.index')" />
        <x-sidebar.sublink title="{{ __('Menu Settings') }}" href="{{ route('admin.menu-settings.index') }}"
            :active="request()->routeIs('admin.menu-settings.index')" />
        {{-- @endcan --}}
        {{-- <x-sidebar.sublink title="{{ __('Backup') }}" href="{{ route('admin.setting.backup') }}" :active="request()->routeIs('admin.setting.backup')" /> --}}
        <x-sidebar.sublink title="{{ __('Redirects') }}" href="{{ route('admin.setting.redirects') }}"
            :active="request()->routeIs('admin.setting.redirects')" />

    </x-sidebar.dropdown>


    <x-sidebar.link title="{{ __('Logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logoutform').submit();"
        href="#">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-sign-out-alt w-5 h-5" aria-hidden="true"></i>
            </span>
        </x-slot>
    </x-sidebar.link>

</x-perfect-scrollbar>
