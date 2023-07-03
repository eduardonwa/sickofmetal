<x-app-layout meta-description="Sick Of Metal, blog for the metalhead with heavy metal news and much more">
    <div>
        <h1 class="rounded-md mx-3 md:mx-0 my-2 text-md p-2 font-bold uppercase bg-black dark:bg-zinc-800 w-max text-center text-white">
            Latest News
        </h1>
            @foreach ($popularPosts as $popularPost)
                <x-post-item :popularPost="$popularPost"></x-post-item>
            @endforeach <!-- latest news column end -->
    </div> <!-- latest news end -->

    <div class="md:mx-auto md:col-start-2 md:col-end-5 lg:mx-0 row-start-1">
        <div>
            <article class="relative lg:h-0 md:p-0 pb-1/3 lg:p-1/3">
                <img class="relative lg:absolute lg:inset-0 w-full lg:h-full lg:object-top object-cover" src="{{ $latestPost->getThumbnail() }}" alt="">
                <div class="absolute bottom-0 left-0 right-0 py-2 bg-gradient-to-t from-black via-zinc-700 to-transparent p-16 pb-5">
                    <h1 class="mb-3 uppercase font-bold bg-red-600 mx-1 p-1 w-max text-center text-white">
                        @foreach($latestPost->categories as $category)
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
        </div> <!-- latest post end -->

        <h1 class="rounded-md mx-3 md:mx-0 my-2 text-md p-2 font-bold uppercase bg-black dark:bg-zinc-800 w-max text-center text-white">RECOMMENDED</h1>
        <div class="md:gap-x-3 space-y-3 md:space-y-0 md:grid md:grid-cols-[1fr_1fr_1fr]">
            @foreach($recommendedPosts as $recommended)
                <div class="relative h-auto pb-2/3 sm:pt-1/3 lg:pb-1/3 m-4 md:m-0 bg-white dark:bg-zinc-800 overflow-hidden shadow-md">
                    <a href="{{ route('view', $recommended) }}" class="h-full flex flex-col">
                        <img class="absolute w-full h-full inset-0 object-cover grow" src="{{ $recommended->getThumbnail() }}">
                        <p class="lg:h-24 w-full inset-x-0 bottom-0 p-2 absolute text-gray-200 font-bold bg-opacity-50 backdrop-blur-sm bg-black hover:text-red-500 dark:text-gray-200 lg:text-lg transition ease-in-out">
                            {{ $recommended->shortTitle() }}
                        </p>
                    </a>
                </div> <!-- recommended post end -->
            @endforeach
        </div> <!-- recommended post end -->
    </div> <!-- latest and recommended posts wrapper end -->

    <div class="md:col-start-2 md:col-end-5 lg:mx-0">
        <div class="w-full bg-charcoal dark:bg-zinc-800 dark:lg:bg-zinc-800 shadow flex flex-col lg:flex p-6">
            <p class="text-2xl font-black pb-5 italic text-gray-100 dark:sick-text">
                {{ \App\Models\TextWidget::getTitle('youtube-sidebar') }}
            </p>
            <div class="shadow-xl">
                <x-youtube/>
            </div>
        </div>
    </div> <!-- YouTube end -->

    <x-sidebar/>

    @foreach($categories as $category)
    <div class="mx-4 md:mx-0 md:col-start-2 md:col-end-5">
        <div class="p-4 bg-white dark:bg-transparent dark:lg:bg-zinc-800 shadow-md">
            <h3 class="pb-3 uppercase text-md lg:text-2xl font-black dark:text-zinc-400">
                {{ $category->title }}
            </h3>
            @foreach($category->publishedPosts()->limit(2)->get() as $post)
                <a href="{{ route('view', $post) }}">
                    <div class="flex flex-col items-start justify-center md:grid md:grid-cols-[max-content_1fr] md:gap-2 lg:grid-cols-[233px_1fr] lg:gap-y-3">
                        <img class="p-2 w-40 lg:w-full object-cover" src="{{ $post->getThumbnail() }}" alt="">
                            <div class="mb-2">
                                <p class="pl-2 md:pl-0 text-xl font-bold text-md transition ease-in-out dark:text-white text-red-600 lg:text-black hover:text-red-600 dark:hover:text-red-600">
                                    {{ $post->title }}
                                </p>
                </a> <!-- route link end -->
                                <x-markdown class="hidden md:block dark:text-gray-100">
                                    {{ $post->shortBody(10) }}
                                </x-markdown>
                                <p class="hidden lg:block dark:text-gray-200">
                                    {{ $post->getFormattedDate() }}
                                </p>
                            </div> <!-- 4th div end -->
                    </div> <!-- 3rd div end -->
            @endforeach
        </div> <!-- 2nd div end -->
    </div> <!-- categories end -->
    @endforeach

</x-app-layout>
