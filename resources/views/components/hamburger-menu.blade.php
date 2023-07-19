<div
    x-data="{ openMenu : false }"
    :class="openMenu ? 'overflow-hidden' : 'overflow-visible'"
>

    <nav
        class="charcoal dark:bg-black flex justify-between items-center drop-shadow-sm py-4 px-8"
    >
        <!-- Mobile menu toggle -->
        <button
            @click="openMenu = !openMenu"
            :aria-expanded="openMenu"
            aria-controls="mobile-navigation"
            aria-label="Navigation Menu"
            class="flex md:hidden flex-col items-center align-middle text-gray-50"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button> <!-- icon toggle -->

        <a href="/" class="lg:hidden w-48 mx-auto">
            <img
                class=""
                src="{{ \App\Models\TextWidget::getImage('header') }}"
            >
        </a> <!-- logo end -->

        <div class="hidden md:flex md:items-center md:justify-around w-full">
            <a class="" href="/">
                <img
                    class="hidden lg:block w-48 mx-auto py-4 lg:col-start-1 lg:col-end-2"
                    src="{{ \App\Models\TextWidget::getImage('header') }}"
                >
            </a> <!-- logo end -->
            <ul class="flex flex-row gap-2">
                @foreach ($allCategories as $category)
                <li
                    @mouseenter="openMenu = '{{ $loop->index }}'"
                    @mouseleave="openMenu = null"
                >
                    <div class="flex items-center justify-between">
                        <a
                            href="{{ route('by-category', ['category'=>$category['slug']]) }}"
                            class="inline-flex text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2"
                        >
                            {{ $category['title'] }}
                        </a>
                        @if ($category['parent_id'] == null && $category->subCategory()->count() > 0)
                        <span
                            :class="openMenu === '{{ $loop->index }}' ? 'w-6 h-6 rounded-full bg-white': 'w-6 h-6 rounded-full border'"
                            class="mx-2 text-transparent font-bold cursor-pointer text-2xl lg:hidden antialiased"
                            @click="openMenu = openMenu === '{{ $loop->index }}' ? null : '{{ $loop->index }}'">
                            +
                        </span>
                    </div>

                    <li
                        class="flex flex-col items-start"
                        x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        x-show="openMenu === '{{ $loop->index }}'"
                        @click="openMenu != '{{ $loop->index }}'"
                        class="lg:w-44 w-full border-2 border-red-600 z-10 bg-black inline-flex flex-col justify-center items-center absolute top-full left-0 right-0 p-3"
                    >
                        @foreach($category['subCategory'] as $subCategory)
                        <a
                            href="{{ route('by-category', $subCategory) }}"
                            class="ml-3 text-white text-center text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded p-2"
                        >
                            {{ $subCategory->title }}
                        </a>
                        @endforeach
                    </li>
                    @else
                    @endif
                </li> <!-- category item end -->
                @endforeach
            </ul> <!-- categories end -->
        </div> <!-- categories wrapper end -->
    </nav> <!-- desktop menu end -->

    <nav
        class="fixed top-0 right-0 bottom-0 left-0 backdrop-blur-sm z-10 lg:hidden"
        :class="openMenu ? 'visible' : 'invisible'"
        x-cloak
    >
        <ul
            :class="openMenu ? 'translate-x-0' : 'translate-x-full'"
            class="absolute top-0 right-0 bottom-0 w-10/12 py-4 bg-charcoal drop-shadow-2xl z-10 transition-all">
            @foreach ($allCategories as $category)
            <li
                class="py-2 relative w-full lg:w-auto"
                @mouseenter="openMenu = '{{ $loop->index }}'"
                @mouseleave="openMenu = null"
            >
                <div class="flex items-center justify-between">
                    <a
                        href="{{ route('by-category', ['category'=>$category['slug']]) }}"
                        class="text-white font-bold text-lg block p-4"
                        aria-current="true"
                    >
                        {{ $category['title'] }}
                    </a>
                    @if ($category['parent_id'] == null && $category->subCategory()->count() > 0)
                    <span
                        :class="openMenu === '{{ $loop->index }}' ? 'w-6 h-6 rounded-full bg-white': 'w-6 h-6 rounded-full border'"
                        class="mx-2 text-transparent font-bold cursor-pointer text-2xl lg:hidden antialiased"
                        @click="openMenu = openMenu === '{{ $loop->index }}' ? null : '{{ $loop->index }}'">
                    </span>
                </div>

                <li
                    class="flex flex-col items-start"
                    x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    x-show="openMenu === '{{ $loop->index }}'"
                    @click="openMenu != '{{ $loop->index }}'"
                    class="lg:w-44 w-full border-2 border-red-600 z-10 bg-black inline-flex flex-col justify-center items-center absolute top-full left-0 right-0 p-3"
                >
                    @foreach($category['subCategory'] as $subCategory)
                    <a
                        href="{{ route('by-category', $subCategory) }}"
                        class="ml-3 text-white text-center text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded p-2"
                    >
                        {{ $subCategory->title }}
                    </a>
                    @endforeach
                </li> <!--  subcategories end -->
                @else
                @endif
            </li> <!-- categories item end -->
            @endforeach
        </ul> <!-- categories end -->
        <!-- Close Button -->
        <button
            class="absolute top-0 right-0 bottom-0 left-0 text-white"
            @click="openMenu = !openMenu"
            :aria-expanded="openMenu"
            aria-controls="mobile-navigation"
            aria-label="Close Navigation Menu"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 absolute top-2 left-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </nav> <!-- mobile menu end -->
</div> <!-- desktop & mobile menu end -->
