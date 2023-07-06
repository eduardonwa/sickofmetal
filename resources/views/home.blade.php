<x-app-layout meta-description="Sick Of Metal, blog for the metalhead with heavy metal news and much more">
    <div>
        <h1 class="mx-3 md:mx-0 my-2 text-3xl p-2 font-bold italic w-max text-center dark:text-white">
            Latest News
        </h1>
            @foreach ($popularPosts as $popularPost)
                <x-post-item :popularPost="$popularPost"></x-post-item>
            @endforeach <!-- latest news column end -->
    </div> <!-- latest news end -->

    <div class="md:mx-auto md:col-start-2 md:col-end-5 lg:mx-0 row-start-1 lg:p-6">
        <div>
            <article class="relative">
                <div class="relative pb-11/12 md:pb-0">
                    <img
                        class="absolute md:relative w-full h-full object-cover object-top"
                        src="{{ $latestPost->getThumbnail() }}"
                        alt="latest heavy metal post"
                    >
                </div>
                <div class="absolute bottom-0 left-0 right-0 py-2 bg-gradient-to-t from-black to-transparent lg:p-16 p-3 lg:pb-5">
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

        <h1 class="mx-3 md:mx-0 my-2 text-2xl p-2 font-bold w-max text-center dark:text-white">
            Suggested
        </h1>
        <div class="md:gap-x-3 space-y-3 md:space-y-0 md:grid md:grid-cols-[1fr_1fr_1fr]">
            @foreach($recommendedPosts as $recommended)
                <div class="m-4 md:m-0 bg-white dark:bg-zinc-800 overflow-hidden shadow-md">
                    <a href="{{ route('view', $recommended) }}" class="h-full flex flex-col">
                        <div class="relative h-0 pb-2/3 sm:pt-1/3 lg:pb-1/3">
                            <img class="absolute w-full h-full inset-0 object-cover object-top" src="{{ $recommended->getThumbnail() }}">
                        </div>
                        <p class="h-full w-full p-2 text-gray-200 font-bold bg-black dark:hover:text-red-500 hover:text-red-500 dark:text-gray-200 lg:text-md transition ease-in-out">
                            {{ $recommended->shortTitle() }}
                        </p>
                    </a>
                </div> <!-- recommended post end -->
            @endforeach
        </div> <!-- recommended post end -->
    </div> <!-- latest and recommended posts wrapper end -->

    <div class="md:col-start-2 md:col-end-5 lg:mx-0">
        <div class="w-full bg-charcoal dark:bg-zinc-900 dark:lg:bg-zinc-900 shadow flex flex-col lg:flex p-6">
            <p class="text-2xl font-black pb-5 text-gray-100 dark:sick-text">
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
        <div class="p-3 bg-white dark:bg-transparent dark:lg:bg-zinc-900 shadow-md">
            <h3 class="pb-3 text-md lg:text-xl font-black dark:text-zinc-400">
                {{ $category->title }}
            </h3>
            @foreach($category->publishedPosts()->limit(2)->get() as $post)
                <a href="{{ route('view', $post) }}">
                    <div class="grid grid-cols-[1fr_1fr] gap-3">
                        <div class="relative h-0 pb-2/3 sm:pt-1/3 lg:pb-1/3">
                            <img class="absolute w-full h-full inset-0 object-cover object-top pb-3"
                                src="{{ $post->getThumbnail() }}"
                                alt="metal post thumbnail"
                            >
                        </div>
                        <div class="flex md:flex-col md:px-8 md:justify-center">
                            <p class="font-bold md:text-xl lg:text-2xl transition ease-in-out dark:text-white text-red-600 dark:hover:text-red-600">
                                {{ $post->shortTitle() }}
                            </p>
                            <p class="hidden lg:block dark:text-gray-200">
                                {{ $post->getFormattedDate() }}
                            </p>
                        </div>
                    </div> <!-- card info end -->
                </a> <!-- route link end -->
                @endforeach
        </div> <!-- main wrapper end -->
    </div> <!-- categories end -->
    @endforeach

</x-app-layout>

