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
    <meta name="Sick of Metal" content="Heavy MEtAL">
    <meta name="description" content="{{ $metaDescription }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@sickofmetal">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaThumbnail }}">
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="/css/custom.css">
    <!-- Scripts -->
    @livewireStyles()
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5338710529457277"
    crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("registerForm").submit();
        }
    </script>
    <link rel="stylesheet" href="/css/lite-yt/lite-yt-embed.css">
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8HXRBBFCV4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8HXRBBFCV4');
</script>

<body
    x-data="{ navbarOpen: false, scrolledFromTop: false }"
    x-init="window.pageYOffset > 60 ? scrolledFromTop = true : scrolledFromTop = false"
    @scroll.window="window.pageYOffset > 60 ? scrolledFromTop = true : scrolledFromTop = false"
    class="bg-gray-200 font-family-karla dark:bg-zinc-950 antialiased dark:selection:sick-bg dark:selection:text-black"
    :class="{
        'overflow-hidden': navbarOpen,
        'overflow-auto': !navbarOpen
    }"
>
    <x-nu-burger :allCategories="$allCategories"></x-nu-burger>

    <div class="macbook:p-3 container mx-auto gap-3 grid lg:grid-cols-5">
        {{ $slot }}
    </div>

    <footer class="bg-gray-300 pb-4 mt-8 pt-16 dark:bg-zinc-900">
        <div class="py-1 flex items-center justify-center gap-x-4 w-full dark:text-gray-400">
            <a href="https://instagram.com/sickofmetalnet" aria-label="Follow us on instagram">
                <!-- Instagram -->
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 hover:text-gray-200 transition ease-in-out"
                fill="currentColor"
                viewBox="0 0 24 24"
            >
                    <path
                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                </svg>
            </a>

            <a href="https://youtube.com/@SickOfMetal" aria-label="Susbcribe to the YouTube channel">
                <!-- Youtube -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-7 w-7 hover:text-gray-200 transition ease-in-out"
                    fill="currentColor"
                    viewBox="0 0 24 24">
                <path
                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                </svg>
            </a>

            <a href="mailto:admin@sickofmetal.net" aria-label="Send us an email">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-7 h-7 hover:text-gray-200 transition ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </a>
        </div>

        <div class="py-5 p-3 flex flex-col md:flex-row items-center justify-center md:space-x-5">
            @foreach ($categories as $category)
            <a
                class="hover:text-gray-400 text-black dark:text-gray-400 dark:hover:text-gray-200 transition ease-in-out"
                href="{{ route('by-category', ['category'=>$category['slug']]) }}">
                {{ $category->title }}
            </a>
            @endforeach
        </div>

        <div class="dark:text-gray-400 px-5 mx-auto container flex flex-col items-center justify-center">
            <a href="/" aria-label="Sick Of Metal">
                <img
                    class="w-64 py-4"
                    width="256"
                    height="130"
                    alt="Sick Of Metal logo"
                    src="{{ \App\Models\TextWidget::getImage('header') }}"
                >
            </a> <!-- logo end -->
            <p>
                {!! \App\Models\TextWidget::getContent('header') !!}
            </p>
        </div>
    </footer>

    <script>
        // artificial delay somewhat simulates a script[defer]
        setTimeout(_ => {
          const elem = document.createElement('script');
          elem.src = '/js/lite-yt-embed.js';
          document.head.append(elem);

          console.log('Done loading YouTube script')
        }, 2000);
    </script>
</body>
</html>
