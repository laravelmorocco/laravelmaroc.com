<footer class="mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6">
    <div class="border-t border-skin-base py-10">
        <img class="mx-auto h-10 w-auto logo-white" src="{{ asset('/images/laravelma.svg') }}" alt="laravelmaroc.com">
        <img class="mx-auto h-10 w-auto logo-dark" src="{{ asset('/images/laravelma-white.svg') }}" alt="Laravlaravelmarocel.com">
        <p class="mt-5 text-center text-sm leading-6 text-skin-muted">
            © 2023 - {{ date('Y') }} Laravel Maroc. Tous droits réservés.
        </p>
        <div class="mt-10 flex items-center justify-center space-x-4 text-sm font-medium leading-6 text-skin-base">
            <a class="hover:text-skin-inverted-muted hover:underline" href="{{ route('twitter') }}">Twitter</a>
            <div class="h-4 w-px bg-skin-card-gray"></div>
            <a class="hover:text-skin-inverted-muted hover:underline" href="{{ route('github') }}">Github</a>
            <div class="h-4 w-px bg-skin-card-gray"></div>
            <a class="hover:text-skin-inverted-muted hover:underline" href="{{ route('facebook') }}">Facebook</a>
            <div class="h-4 w-px bg-skin-card-gray"></div>
            <a class="hover:text-skin-inverted-muted hover:underline" href="{{ route('linkedin') }}">LinkedIn</a>
            <div class="h-4 w-px bg-skin-card-gray"></div>
            <a class="hover:text-skin-inverted-muted hover:underline" href="{{ route('youtube') }}">YouTube</a>
        </div>
    </div>
</footer>
