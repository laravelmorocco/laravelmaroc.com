@feature('premium')
    @if ($plans->count() > 0)
        <div class="relative pt-12 overflow-hidden sm:pt-16 lg:pt-20">
            <div class="z-0 hidden overflow-hidden opacity-50 pointer-events-none lg:block">
                <testimonies-area />
            </div>
            <div
                class="relative z-50 pb-12 lg:-mt-16 bg-gradient-to-t from-transparent via-skin-card to-skin-body sm:pb-16 lg:pb-20">
                <div class="px-4 mx-auto max-w-7xl">
                    <div class="lg:text-center">
                        <div class="inline-flex items-center space-x-2 px-2 py-0.5 rounded-md bg-yellow-100 text-yellow-600">
                            <svg class="w-5 h-5 t" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M23 9.04c0-1.249-1.051-2.27-2.335-2.27-1.285 0-2.336 1.021-2.336 2.27 0 .703.35 1.36.888 1.77l-3.083 2.29-2.99-3.857c.724-.386 1.215-1.135 1.215-1.975C14.359 6.021 13.308 5 12.023 5 10.74 5 9.688 6.021 9.688 7.27c0 .839.467 1.588 1.191 1.974L7.633 13.1 4.76 10.832c.537-.408.91-1.066.91-1.793 0-1.248-1.05-2.269-2.335-2.269C2.051 6.77 1 7.791 1 9.04c0 1.111.817 2.042 1.915 2.223l1.121 5.696v2.36c0 .386.304.681.7.681h14.527c.397 0 .7-.295.7-.68v-2.36l1.122-5.697C22.183 11.082 23 10.151 23 9.04zm-2.335-.908c.513 0 .934.408.934.907 0 .5-.42.908-.934.908s-.935-.408-.935-.908c0-.499.42-.907.934-.907zM12 6.339c.514 0 .934.408.934.908 0 .499-.42.907-.934.907s-.934-.408-.934-.907c0-.5.42-.908.934-.908zm-4.18 8.396a.727.727 0 0 0 .467-.25l3.69-4.47 3.456 4.448c.117.136.28.25.467.272a.683.683 0 0 0 .514-.136l3.036-2.247-.77 3.858H5.32l-.747-3.79 2.733 2.156c.14.114.327.182.514.16zM2.4 9.04c0-.499.42-.907.934-.907s.935.408.935.907c0 .5-.42.908-.935.908-.513 0-.934-.408-.934-.908zm3.036 9.6v-1.067h13.126v1.066H5.437z" />
                            </svg>
                            <h2 class="text-lg font-semibold">{{ __('Premium') }}</h2>
                        </div>
                        <h4
                            class="mt-2 text-3xl font-bold leading-8 tracking-tight text-skin-inverted sm:text-4xl font-heading">
                            {{ __('Accès illimité avec un abonnement premium') }}
                        </h4>
                        <p class="max-w-2xl mt-4 text-xl text-skin-base lg:mx-auto">
                            {{ __('Devenir premium c\'est soutenir la communauté, les nouveaux contenus chaque semaine et accéder à du contenu exclusif pour apprendre et progresser.') }}
                        </p>
                    </div>
                    <div
                        class="mt-16 space-y-12 lg:mt-20 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:space-y-0 lg:max-w-4xl lg:mx-auto">
                        @foreach ($plans as $plan)
                            <div
                                class="relative flex flex-col p-8 border shadow-sm rounded-2xl border-skin-base bg-skin-card/50 backdrop-blur-sm">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-skin-inverted">{{ $plan->title }}</h3>
                                    @if ($plan->slug === 'le-pro')
                                        <p
                                            class="inline-flex items-center absolute top-0 -translate-y-1/2 transform rounded-full bg-flag-yellow py-1.5 px-4 text-sm font-semibold text-yellow-900">
                                            <svg class="w-5 h-5 mr-2.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                                            </svg>
                                            {{ __('Populaire') }}
                                        </p>
                                    @endif
                                    <p class="flex items-baseline mt-4 text-skin-inverted">
                                        <span class="text-4xl font-bold tracking-tight" x-data="{ price: 0 }"
                                            x-init="price = formatMoney({{ $plan->price }})">
                                            <span x-text="price"></span>
                                        </span>
                                        <span class="ml-1 text-xl font-semibold">{{ __('/mois') }}</span>
                                    </p>

                                    <!-- Feature list -->
                                    <ul role="list" class="mt-6 space-y-6">
                                        @foreach ($plan->features as $feature)
                                            <li class="flex">
                                                <svg class="flex-shrink-0 w-6 h-6 text-primary-500"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                <span class="ml-3 text-skin-base">{{ $feature->name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <x-button link="#" class="w-full mt-10">{{ __('Souscrire Maintenant') }}</x-button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endfeature
