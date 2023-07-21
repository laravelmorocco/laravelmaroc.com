<div>
    @section('title', 'authentication')

    <div class="table h-auto relative w-full">
        <div class="grid lg:grid-cols-2 xs:grid-cols-1 w-full mt-16">
            <div class="w-full py-10 my-auto" x-data="{ isTab: 'login' }">
                <div class="flex flex-col items-center">
                    <div class="grid grid-cols-2 gap-4 w-full px-10 mb-6">
                        <button type="button"
                            class="w-full py-2 px-6 text-center text-black hover:bg-blue-600 hover:text-white rounded shadow-md transiton duration-500"
                            :class="{ 'bg-blue-600 text-white': isTab === 'login' }" @click="isTab = 'login'">
                            {{ __('Login') }}
                        </button>
                        <button type="button"
                            class="w-full py-2 px-6 text-center text-black hover:bg-blue-600 hover:text-white rounded shadow-md  transiton duration-500"
                            :class="{ 'bg-blue-600 text-white': isTab === 'register' }" @click="isTab = 'register'">
                            {{ __('Register') }}
                        </button>
                    </div>
                    <div x-show="isTab === 'login'" class="w-full px-10">
                        <h1 class="mb-8 md:text-3xl lg:text-4xl font-medium text-center">
                            {{ __('Login to your account') }}
                        </h1>
                        @livewire('auth.login')
                    </div>
                    <div x-show="isTab === 'register'" class="w-full px-10">
                        <h1 class="mb-8 md:text-3xl lg:text-4xl font-medium text-center">
                            {{ __('Register') }}
                        </h1>
                        @livewire('auth.register')
                    </div>
                </div>
            </div>

            <div class="w-full relative md:flex md:pb-0">
                <div style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);"
                    class="flex justify-center items-center absolute pin bg-no-repeat md:bg-left w-full h-full bg-center bg-cover">
                    {{-- shadow to text , make it more bigger  --}}
                    <a href="/"
                        class="my-auto lg:text-6xl md:text-5xl text-4xl text-white uppercase text-white font-extrabold font-heading opacity-75 cursor-pointer">
                        {{ Helpers::settings('site_title') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
