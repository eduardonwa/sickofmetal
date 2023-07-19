    <!-- Topic Nav -->
    <nav class="bg-zinc-900 py-3" x-data="{ open: false }">
        <div>
            <a href="/" class="lg:hidden">
                <img
                    class="w-48  mx-auto py-4 lg:col-start-1 lg:col-end-2"
                    src="{{ \App\Models\TextWidget::getImage('header') }}"
                >
            </a> <!-- logo end -->
            <div class="block md:hidden py-8 md:py-0">
                <a
                    href="#"
                    class="md:hidden text-white text-xl font-bold uppercase text-center flex justify-center items-center"
                    @click="open = !open"
                >
                    Menu <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
                </a>
            </div>
        </div> <!-- menu icon -->

        <div class="macbook:px-4 container mx-auto w-full grid lg:items-center lg:grid-cols-5">
            <a class="" href="/">
                <img
                    class="hidden lg:block w-48 mx-auto py-4 lg:col-start-1 lg:col-end-2"
                    src="{{ \App\Models\TextWidget::getImage('header') }}"
                >
            </a> <!-- logo end -->

            <x-categories-menu :allCategories="$allCategories"></x-categories-menu>

            <div class="lg:col-start-5 flex-col lg:flex justify-center md:justify-end">
                <div x-data="{ open: false }" class="flex justify-center lg:justify-end lg:p-0">
                    <x-search-modal></x-search-modal>
                    @auth()
                        <!-- Settings Dropdown -->
                        <div class="sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="custom" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 dark:text-white dark:bg-zinc-600 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <div class="flex justify-center md:items-end gap-x-4 lg:py-0 lg:flex-col md:text-center w-full gap-y-2 mt-4">
                            <a href="{{ route('login') }}" class="text-gray-200">Login</a>
                            <a href="{{ route('register') }}" class="text-gray-200">Register</a>
                        </div>
                    @endauth
                </div>
            </div> <!-- search and auth end -->
        </div> <!-- desktop menu end -->
    </nav> <!-- navbar end -->
