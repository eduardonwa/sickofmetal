<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{isDarkMode : localStorage.getItem('dark') === 'true'}"
    x-init="$watch('isDarkMode', val => localStorage.setItem('dark', val))"
    x-bind:class="{ 'dark' : isDarkMode }"
    x-cloak
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'Sick Of Metal'}}</title>
    <meta name="author" content="Sick Of Metal">
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
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

        .minus {

        }
    </style>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Scripts -->
    @livewireStyles()
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8HXRBBFCV4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8HXRBBFCV4');
</script>

<body class="bg-gray-200 font-family-karla dark:bg-zinc-900 antialiased dark:selection:sick-bg dark:selection:text-black">
    <!-- Topic Nav -->
    <nav class="charcoal dark:bg-black py-3" x-data="{ open: false }">
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

    <div class="macbook:p-3 container mx-auto py-6 gap-3 grid lg:grid-cols-5">
        {{ $slot }}
    </div>

    <footer class="w-full bg-gray-200 pb-12 dark:bg-zinc-900">
        <div class="pt-2 text-center text-lg dark:text-gray-400">
            Sick Of Metal
            <p class="text-lg text-gray-700 dark:text-gray-500">
                {{ \App\Models\TextWidget::getTitle('header') }}
            </p>
        </div>
    </footer>

    @stack('scripts')

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
