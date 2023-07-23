<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth {{ get_current_theme() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ isset($title) ? $title . ' | ' : '' }}
        {{ config('app.name') }}
        {{ is_active('home') ? '- La plus grande communauté de développeurs Laravel & PHP au Maroc' : '' }}
    </title>
    <meta name="description"
        content="Laravel Maroc est le portail de la communauté de développeurs PHP & Laravel au Maroc, on partage, on apprend, on découvre et on construit une grande communauté.">
    <meta property="og:site_name" content="laravelmaroc.com" />
    <meta property="og:language" content="fr" />
    <meta name="twitter:author" content="@laravelmaroc" />
    <link rel="canonical" href="{{ $canonical ?? Request::url() }}" />

    @include('layouts._og')
    <x-seo::meta />

    <!-- Styles -->
    @googlefonts
    @vite('resources/css/app.css')
    @include('layouts._favicons')
    <livewire:styles />

    <script defer>
        window.csrfToken = {!! json_encode(['csrfToken' => csrf_token()]) !!};
        window.laravel = {
            ...(window.laravel || {}),
            isModerator: {{ auth()->check() &&auth()->user()->hasAnyRole('admin', 'moderator')? 'true': 'false' }},
            user: {{ auth()->check() ? auth()->id() : 'null' }},
            currentUser: {!! auth()->check()
                ? json_encode(
                    auth()->user()->profile(),
                )
                : 'null' !!}
        }
    </script>

    <!-- Scripts -->
    <livewire:scripts />
    @vite('resources/js/app.js')

    @include('layouts._fathom')
</head>

<body class="h-full font-sans antialiased bg-skin-body text-skin-base">

    <div class="min-h-screen flex flex-col justify-between">
        @yield('content')
    </div>

    @livewire('livewire-ui-modal')
    @livewire('livewire-ui-spotlight')
    @livewire('notifications')


    @stack('scripts')
</body>

</html>
