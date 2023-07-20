<header
    class="
        fixed
        bg-charcoal
        w-full
        h-auto
        z-30
        transition-all
        duration-200
        md:px-12
    "
    :class="{'h-24 p-2': !scrolledFromTop, 'h-12': scrolledFromTop}"
>

    <div class="
            flex
            items-center
            justify-around
            p-4

            md:p-0
            md:grid
            md:grid-cols-[auto_1fr_auto]
            lg:grid-cols-[auto_610px_auto]
        "
    >
        <div
            x-data="{ open: false }"
            class="
                p-2

                md:order-last
                md:flex
                md:flex-col
                md:items-center
                md:justify-center
                md:ml-8
                md:space-y-4

                lg:flex-row
                lg:items-center
                lg:justify-between
                lg:w-44
                lg:space-y-0
            "
            >
            <x-search-modal></x-search-modal>
            <div class="hidden md:block md:text-sm">
                @auth()
                <!-- Settings Dropdown -->
                <div>
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
                </div> <!-- auth user end -->
                @else
                <div class="
                        flex-col
                        flex
                        space-y-2
                        pt-2
                        items-center
                        justify-center
                        w-full

                        md:pt-0
                    "
                >
                    <a href="{{ route('login') }}" class="text-gray-200 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-200 hover:underline">Register</a>
                </div> <!-- login and register end -->
                @endauth
            </div> <!-- auth end -->
        </div> <!-- search and auth end -->

        <a href="/" class="flex items-center justify-center ">
            <img
                class="transition-all duration-200"
                src="{{ \App\Models\TextWidget::getImage('header') }}"
                alt="sick of metal logo"
                :class="{'h-16': !scrolledFromTop, 'h-12': scrolledFromTop}"
            >
        </a> <!-- logo end -->

        <nav>
            <button class="md:hidden" @click="navbarOpen = !navbarOpen">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <ul
                class="
                    fixed
                    left-0
                    top-0
                    right-0
                    min-h-screen
                    bg-charcoal
                    space-y-4
                    p-4
                    transform
                    translate-x-full
                    transition
                    duration-200

                    md:top-0
                    md:relative
                    md:min-h-0
                    md:space-y-0
                    md:p-0
                    md:translate-x-0
                    md:w-full
                "
                :class="{'translate-x-full': !navbarOpen, 'translate-x-0': navbarOpen}"
            >
                <li class="flex items-center justify-end mr-5">
                    <button class="md:hidden" @click="navbarOpen = !navbarOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </li> <!-- burger icon -->

                <a href="/" class="flex items-center justify-center w-full">
                    <img
                        class="h-16 md:hidden transition-all duration-200"
                        src="{{ \App\Models\TextWidget::getImage('header') }}"
                        alt="sick of metal logo"
                    >
                </a> <!-- logo end -->

                <div class="md:flex md:items-center md:w-full lg:items-center">
                    <div class="md:hidden md:order-last">
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
                        <div class="
                            flex-col
                            flex
                            space-y-2
                            pt-2
                            items-center
                            justify-center
                            w-full

                            md:pt-0
                        "
                        >
                            <a href="{{ route('login') }}" class="text-gray-200">Login</a>
                            <a href="{{ route('register') }}" class="text-gray-200">Register</a>
                        </div>
                        @endauth
                    </div> <!-- auth end -->

                    @foreach ($allCategories as $category)
                    <li
                        class="flex-col md:w-full mt-4 md:mt-0 relative"
                        x-data="{ expanded: false }"
                    >
                        <div
                            class="
                            flex
                            items-center
                            justify-between

                            hover:text-black
                            focus:ring-2
                            active:ring-2
                            ring-red-600

                            transition
                            ease-in-out

                            md:justify-around
                            "
                        >
                            <a
                                href="{{ route('by-category', ['category'=>$category['slug']]) }}"
                                class="
                                    font-bold
                                    text-5xl
                                    text-white

                                    md:text-xl
                                    md:uppercase

                                    hover:text-gray-400
                                    transition
                                    ease-in-out
                                "
                            >
                                {{ $category['title'] }}
                            </a>
                            @if ($category['parent_id'] == null && $category->subCategory()->count() > 0)
                            <span
                                class="
                                    text-red-600

                                    text-5xl
                                    rotate-90
                                    cursor-pointer
                                    md:text-4xl
                                    lg:text-5xl
                                "
                                @click="expanded = ! expanded"
                            >
                                &rsaquo;
                            </span> <!-- use this to show subcategories -->
                        </div> <!-- categories and icon end -->

                        <div
                            class="
                                flex
                                flex-col
                                mt-4
                                border-2
                                rounded-sm
                                border-red-600

                                md:absolute
                                md:top-[62px]
                                lg:top-14
                            "
                            x-show="expanded" x-collapse
                            @click.away="expanded = false"
                        >
                            @foreach($category['subCategory'] as $subCategory)
                            <a
                                href="{{ route('by-category', $subCategory) }}"
                                class="
                                    w-full
                                    bg-black
                                    z-10

                                    inline-flex
                                    flex-col
                                    justify-center
                                    items-center
                                    text-center
                                    top-full
                                    left-0
                                    right-0
                                    p-3
                                    py-2
                                    text-2xl
                                    text-white
                                    hover:text-red-600
                                    transition
                                    ease-in-out

                                    md:text-xl
                                "
                            >
                                {{ $subCategory->title }}
                            </a> <!-- show this on click -->
                            @endforeach
                            @else
                            @endif
                        </div> <!-- subcategories end -->
                    </li> <!-- categories and subcategories end --> <!-- main wrapper containing collapsible elements -->
                    @endforeach
                </div> <!-- auth and categories on mobile end -->

            </ul>
        </nav> <!-- mobile navigation end -->
    </div>

</header>
