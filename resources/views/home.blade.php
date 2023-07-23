<x-app-layout meta-description="Sick Of Metal is a blog for metalheads. Follow on Instagram @sickofmetalnet and subscribe on YouTube @SickOfMetal to discover new music and stay updated with the latest news.">

    <div class="md:mt-36 lg:mt-24">
        <h1 class="mx-3 md:mx-0 my-2 text-3xl md:text-2xl p-2 font-bold italic w-max text-center dark:text-white">
            Breaking News
        </h1>
            @foreach ($popularPosts as $popularPost)
                <x-post-item :popularPost="$popularPost"></x-post-item>
            @endforeach <!-- latest news column end -->
    </div> <!-- latest news end -->

    <div class="mt-[110px] md:mt-36 lg:mt-24 md:mx-auto md:col-start-2 md:col-end-5 lg:mx-0 row-start-1 lg:p-6 w-full">
        <div>
            @foreach($latestPosts->take(1) as $latestPost)
            <article class="relative lg:h-0 lg:p-1/3">
                <img
                    class="relative lg:absolute lg:inset-0 w-full h-96 lg:h-full object-top object-cover"
                    src="{{ $latestPost->getThumbnail() }}"
                    alt="thumbnail from the most popular post on the site"
                >
                <div class="absolute bottom-0 left-0 right-0 py-2 bg-gradient-to-t from-black to-transparent lg:p-16 p-3 lg:pb-5">
                    <h1 class="text-base mb-3 uppercase font-bold bg-red-600 mx-1 p-1 w-max text-center text-white">
                                @foreach ($latestPost->categories as $category)
                                    {{ $category->title }}
                                    @endforeach
                            </h1>
                    <a href="{{ route('view', $latestPost) }}">
                        <h3 class="text-3xl text-white font-bold m-1 transition ease-out hover:text-gray-300">
                            {{ $latestPost->title }}
                        </h3>
                    </a>
                    <p class="m-1 text-gray-300">
                        {{ $latestPost->caption }}
                    </p>
                </div> <!-- latest post end -->
            </article>
            @endforeach
        </div> <!-- breaking news end -->

        @auth()
        @else
        <div class="p-3 dark:sick-bg bg-black">
            <p class="sick-text dark:text-black">
                Sign up to comment plus a few added benefits. What are you waiting for?
                <a href="/register" class="underline font-bold">Register now!</a>
                If you are experiencing issues shoot an
                <a href="mailto:admin@sickofmetal" class="underline font-bold">
                    email
                </a>
            </p>
        </div>
        @endauth

        <h1 class="mx-3 md:mx-0 my-2 text-3xl md:text-2xl p-2 font-bold w-max text-center dark:text-white">
            Suggested
        </h1>

        <div class="md:gap-x-3 space-y-3 md:space-y-0 md:grid md:grid-cols-[1fr_1fr_1fr]">
            @foreach($recommendedPosts as $recommended)
                <div class="m-4 md:m-0 bg-white dark:bg-zinc-800 overflow-hidden shadow-md">
                    <a href="{{ route('view', $recommended) }}" class="h-full flex flex-col">
                        <div class="relative h-0 pb-2/3 sm:pt-1/3 lg:pb-1/3">
                            <img class="absolute w-full h-full inset-0 object-cover object-top" src="{{ $recommended->getThumbnail() }}">
                        </div>
                        <p class="h-full w-full p-2 text-gray-200 font-bold bg-black dark:hover:sick-text hover:sick-text dark:text-gray-200 lg:text-md transition ease-in-out">
                            {{ $recommended->shortTitle() }}
                        </p>
                    </a>
                </div> <!-- recommended post end -->
            @endforeach
        </div> <!-- recommended post end -->
    </div> <!-- latest and recommended posts wrapper end -->

    <div class="md:col-start-2 md:col-end-5 lg:mx-0">
        <div class="w-full bg-charcoal dark:bg-gray-900 shadow flex flex-col lg:flex p-6">
            <p class="text-3xl md:text-2xl font-black pb-5 text-gray-100 dark:sick-text">
                {{ \App\Models\TextWidget::getTitle('youtube-sidebar') }}
            </p>
            <div class="shadow-xl">
                <x-youtube/>
            </div>
        </div>
    </div> <!-- YouTube end -->

    <div class="p-4 lg:mt-[120px] lg:p-0 md:col-start-2 md:col-end-5 lg:flex-col lg:mx-auto lg:row-start-1 lg:col-start-5 lg:col-end-6 pt-6">
        @foreach($latestPosts->skip(1)->take(2) as $lastTwo)
            <a href="{{ route('view', $lastTwo) }}">
                <div class="relative h-0 pb-44 sm:pt-1/3 md:pb-0 lg:pb-2/12">
                    <img class="absolute w-full h-44 lg:h-full inset-0 object-cover object-top"
                        src="{{ $lastTwo->getThumbnail() }}"
                        alt="metal post thumbnail"
                    >
                </div>
                <p class="pt-4 lg:pt-1 font-bold bottom-0 w-full dark:text-gray-300 text-black text-base/6">
                    <span class="antialiased hover:sick-bg dark:hover:sick-bg dark:hover:text-black">
                        {{ $lastTwo->shortTitle() }}
                    </span>
                </p>

                <p class="pb-8 dark:text-zinc-400 text-zinc-600">
                    {{ $lastTwo->shortBody(13) }}
                    <br>
                    <span class="text-xs">
                        {{ $lastTwo->human_read_time }} read time
                    </span>
                </p>
            </a>
        @endforeach
    </div> <!-- last 2 posts end -->

    @foreach($categories as $category)
    <div class="mx-4 md:mx-0 md:col-start-2 md:col-end-5">
        <div class="p-3 bg-white dark:bg-transparent dark:lg:bg-zinc-900 shadow-md">
            <h3 class="pb-3 text-md lg:text-xl font-black dark:text-zinc-400">
                {{ $category->title }}
            </h3>
            @foreach($category->publishedPosts()->latest()->limit(2)->get() as $post)
                <a href="{{ route('view', $post) }}">
                    <div class="grid grid-cols-[1fr_1fr] gap-3">
                        <div class="relative h-0 pb-2/3 sm:pt-1/3 lg:pb-1/3">
                            <img class="absolute w-full h-full inset-0 object-cover object-top pb-3"
                                src="{{ $post->getThumbnail() }}"
                                alt="metal post thumbnail"
                            >
                        </div>
                        <div class="flex md:flex-col md:px-8 md:justify-center">
                            <p class="font-bold md:text-xl lg:text-2xl text-black dark:text-white">
                                <span class="antialiased hover:sick-bg dark:hover:sick-bg dark:hover:text-black">
                                    {{ $post->shortTitle() }}
                                </span>
                            </p>
                            <p class="hidden lg:block text-gray-600 dark:text-gray-200">
                                @if ($post->published_at->diffInWeeks(now()) >= 1)
                                    {{ $post->getFormattedDate() }}
                                @else
                                    {{ $post->published_at->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    </div> <!-- card info end -->
                </a> <!-- route link end -->
                @endforeach
        </div> <!-- main wrapper end -->
    </div> <!-- categories end -->
    @endforeach

</x-app-layout>

