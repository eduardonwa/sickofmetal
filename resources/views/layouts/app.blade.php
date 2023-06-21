<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'Sick Of Metal'}}</title>
    <meta name="author" content="Sick Of Metal">
    <meta name="description" content="{{ $metaDescription }}">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        pre {
            padding: 1rem;
            background-color: #1a202c;
            color: white;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        .charcoal {
            background-color: #212121;
        }

        [x-cloak] { display: none !important; }
    </style>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @livewireStyles()
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 font-family-karla">
    <!-- Topic Nav -->
    <nav class="charcoal py-3" x-data="{ open: false }">
        <div>
            <div class="block md:hidden">
                <a
                    href="#"
                    class="md:hidden text-white text-lg font-bold uppercase text-center flex justify-center items-center"
                    @click="open = !open"
                >
                    Menu <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
                </a>
            </div>
        </div> <!-- menu icon -->

        <div class="container mx-auto w-full lg:grid lg:items-center lg:grid-cols-5">
            <a class="" href="/">
                <img
                    class="w-48 mx-auto py-4 lg:col-start-1 lg:col-end-2" 
                    src="{{ \App\Models\TextWidget::getImage('header') }}"
                >
            </a> <!-- logo end -->
            
            <div 
                :class="open ? 'block': 'hidden'" 
                class="w-full flex-grow md:flex md:items-center md:w-auto lg:col-start-3 lg:col-end-5 mx-auto gap-3"
            >
                <div 
                    x-data="{ open: null }" 
                    class="w-full flex-grow sm:flex sm:items-center sm:w-auto bg-charcoal"
                >
                    <div class="mx-auto flex flex-col items-center justify-center sm:flex-row text-sm font-bold uppercase mt-0 px-6 py-2">
                    @foreach ($allCategories as $category)
                            <div 
                                class="py-2 relative w-full lg:w-auto" 
                                @mouseenter="open = '{{ $loop->index }}'" 
                                @mouseleave="open = null"
                            >
                                <div class="flex items-center justify-between md:flex-none">
                                    <a 
                                        href="{{ route('by-category', ['category'=>$category['slug']]) }}" 
                                        class="text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2"
                                    >
                                        {{ $category['title'] }} 
                                    </a>
                                    @if ($category['parent_id'] == null && $category->subCategory()->count() > 0)
                                        <i :class="open === '{{ $loop->index }}' ? 'fa-chevron-up': 'fa-chevron-down'" 
                                            class="fas ml-2 text-white font-bold cursor-pointer text-lg" 
                                            @click="open = open === '{{ $loop->index }}' ? null : '{{ $loop->index }}'">
                                        </i>
                                </div>

                                <div x-cloak
                                    x-show="open === '{{ $loop->index }}'"
                                    @mouseenter="open = '{{ $loop->index }}'" 
                                    @mouseleave="open = null" 
                                    class="lg:w-44 w-full border-2 border-red-600 z-10 bg-black inline-flex flex-col justify-center items-center relative lg:absolute top-full left-0 right-0 p-3"
                                >
                                    @foreach($category['subCategory'] as $subCategory)  
                                        <a 
                                            href="{{ route('by-category', $subCategory) }}" 
                                            class="text-white text-center text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded p-2"
                                        >
                                            {{ $subCategory->title }}
                                        </a>
                                    @endforeach

                                    @else
                                        <!-- this category has no subcategories -->
                                    @endif
                                </div> <!-- subcategories menu end -->
                            </div> <!-- categories menu end -->
                        @endforeach
                            <a href="{{ route('about') }}" class="w-full text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded p-2 ml-7 md:ml-0">
                                About
                            </a>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-start-5 flex-col justify-center md:justify-end">
                <div x-data="{ open: false }" class="flex justify-center lg:justify-end lg:p-0 p-3">
                    <button @click="open = true" 
                            type="button"
                            class="hover:bg-red-600 hover:text-black rounded-md transition ease-in-out p-3"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                    <!-- modal -->
                    <div 
                        x-show="open"
                        x-cloak
                        @keydown.escape.prevent.stop="open = false"
                        role="dialog"
                        aria-modal="true"
                        x-id="['modal-title']"
                        :aria-labelledby="$id('modal-title')"
                        class="fixed inset-0 z-20"
                    >
                        <!-- overlay -->
                        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm">
                        <!-- panel -->
                            <div 
                                @click="open = false"
                                class="relative top-28 p-3 h-full w-full flex items-start justify-center"
                            >
                                    <div
                                        @click.stop
                                        x-trap.noscroll="open"
                                        class="max-w-2xl w-full bg-gray-200 rounded-md overflow-y-auto"
                                    >
                                        <form method="get" action="{{route('search')}}"
                                            class="relative lg:col-start-4"
                                        >
                                            <input
                                                name="q" value="{{request()->get('q')}}"
                                                class="peer m-0 block h-[58px] w-full rounded bg-transparent bg-clip-padding px-3 py-4 text-base font-normal leading-tight
                                                text-black transition duration-200 ease-linear placeholder:text-transparent focus:border-primary focus:pb-[0.625rem] focus:pt-[1.625rem]
                                                focus:text-black focus:bg-white focus:shadow-lg peer-focus:text-primary dark:peer-focus:text-primary [&:not(:placeholder-shown)]:pb-[0.625rem] [&:not(:placeholder-shown)]:pt-[1.625rem]"
                                                id="floatingInput"
                                                placeholder="Press Enter when ready" />

                                            <label
                                                :id="$id('modal-title')"
                                                for="floatingInput"
                                                class="pointer-events-none absolute left-0 top-0 origin-[0_0] border border-solid border-transparent px-3 py-4 text-slate-700
                                                transition-[opacity,_transform] duration-200 ease-linear peer-focus:-translate-y-2 peer-focus:translate-x-[0.15rem]
                                                peer-focus:scale-[0.85] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-translate-y-2 peer-[:not(:placeholder-shown)]:translate-x-[0.15rem]
                                                peer-[:not(:placeholder-shown)]:scale-[0.85] motion-reduce:transition-none"
                                                >Search</label>
                                        </form> <!-- search elements end -->
                                    </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- modal end -->

                @auth()
                <!-- Settings Dropdown -->
                <div class="sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="custom" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
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
                <div class="flex justify-center md:items-end gap-x-4 py-4 lg:py-0 lg:flex-col md:text-center w-full">
                    <a href="{{ route('login') }}" class="text-gray-200 py-2">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-200 py-2">Register</a>
                </div>
                @endauth
            </div> <!-- search and auth end -->
        </div> <!-- desktop menu end -->

    </nav> <!-- navbar end -->
    
    <div class="container mx-auto py-6 gap-3 grid lg:grid-cols-5">
        {{ $slot }}
    </div>
    
    <footer class="w-full border-t bg-gray-200 pb-12">
        <div class="pt-2 text-center text-lg">
            Sick Of Metal
            <p class="text-lg text-gray-600">
                {{ \App\Models\TextWidget::getTitle('header') }}
            </p>
        </div>
    </footer>

    <script>
        function getCarouselData() {
            return {
                currentIndex: 0,
                images: [
                    'https://source.unsplash.com/collection/1346951/800x800?sig=1',
                    'https://source.unsplash.com/collection/1346951/800x800?sig=2',
                    'https://source.unsplash.com/collection/1346951/800x800?sig=3',
                    'https://source.unsplash.com/collection/1346951/800x800?sig=4',
                    'https://source.unsplash.com/collection/1346951/800x800?sig=5',
                    'https://source.unsplash.com/collection/1346951/800x800?sig=6',
                    'https://source.unsplash.com/collection/1346951/800x800?sig=7',
                    'https://source.unsplash.com/collection/1346951/800x800?sig=8',
                    'https://source.unsplash.com/collection/1346951/800x800?sig=9',
                ],
                increment() {
                    this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex + 1;
                },
                decrement() {
                    this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex - 1;
                },
            }
        }
    </script>
</body>
</html>