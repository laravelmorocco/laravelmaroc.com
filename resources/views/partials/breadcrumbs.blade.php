<nav aria-label="breadcrumb">
    <ol class="breadcrumb list-none p-0 inline-flex bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="flex items-center"><a class="text-white"
                href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
            <span class="text-white"> / </span>
        </li>
        <li class="flex items-center text-white active" aria-current="page">
            {{ __(ucwords(str_replace('-', ' ', Route::currentRouteAction()))) }}</li>
    </ol>
</nav>
