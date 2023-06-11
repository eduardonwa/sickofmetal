<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'Sick Of Metal'}}</title>
    <meta name="author" content="Sick Of Metal">
    <meta name="description" content="{{ $metaDescription }}">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
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
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 font-family-karla">
        
    <!-- Topic Nav -->
    <nav class="flex-col items-center justify-center w-full py-4 charcoal" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a
                href="#"
                class="md:hidden text-white text-lg font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open"
            >
                Menu <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto mx-auto gap-3 lg:grid lg:grid-cols-5">
            <div class="lg:flex lg:justify-end">
                <a class="lg:w-64 p-2" href="/">
                    <img src="{{ \App\Models\TextWidget::getImage('header') }}" alt="" srcset="">
                </a>
            </div>
            <div x-data="{ open: null }" class="lg:col-span-4 w-full flex-grow sm:flex sm:items-center sm:w-auto charcoal">
                <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
                    @foreach ($allCategories as $category)
                        <div class="py-2 relative" @mouseenter="open = '{{ $loop->index }}'" @mouseleave="open = null">
                            <a href="{{ route('by-category', $category) }}" class="text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2">
                                {{ $category->title }} 
                                @if ($category->parent_id == null) <!-- && check if category has children -->
                                    <i :class="open === '{{ $loop->index }}' ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
                                @else
                                    <p> no arrow </p>
                                @endif
                            </a>
                            <div x-show="open === '{{ $loop->index }}'" 
                                @mouseenter="open = '{{ $loop->index }}'" 
                                @mouseleave="open = null" 
                                class="border-2 border-red-600 z-40 bg-black inline-flex flex-col justify-center items-center absolute top-full left-0 right-0 p-3"
                            >
                                @foreach($category->subCategory as $subCategory)  
                                    <a href="{{ route('by-category', $subCategory) }}" class="text-white text-center text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2">
                                        {{ $subCategory->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <a href="{{ route('about') }}" class="text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2">About S.O.M.</a>
                    @auth()
                        <!-- Settings Dropdown -->
                        <div class="sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
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
                        <a href="{{ route('login') }}" class="text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2">Login</a>
                        <a href="{{ route('register') }}" class="text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
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