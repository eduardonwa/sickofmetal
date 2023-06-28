<x-app-layout meta-description="Sick Of Metal blog for the metalhead with rock and heavy metal news and much more">
    <div>
        <h1 class="rounded-md mx-3 md:mx-0 my-2 text-md p-2 font-bold uppercase bg-black dark:bg-zinc-800 w-max text-center text-white">POPULAR</h1>
            @foreach ($popularPosts as $popularPost)
                <x-post-item :popularPost="$popularPost"></x-post-item>
            @endforeach <!-- popular post column end -->
    </div> <!-- popular posts end -->
    
    <div class="md:mx-auto md:col-start-2 md:col-end-5 lg:mx-0 row-start-1">
        <div class="bg-black">
            <article class="relative">
                <img class="w-full object-cover" src="{{ $latestPost->getThumbnail() }}" alt="">
                <div class="absolute bottom-0 left-0 right-0 px-4 py-2 bg-gradient-to-t from-black">
                    <h1 class="mb-3 uppercase font-bold bg-red-600 mx-1 p-1 w-max text-center text-white">
                        @foreach($latestPost->categories as $category)
                            {{ $category->title }}        
                        @endforeach
                    </h1>
                    <a href="{{ route('view', $latestPost) }}">
                        <h3 class="text-2xl text-white font-bold m-1 transition ease-out hover:text-gray-300">
                            {{ $latestPost->title }}
                        </h3>
                    </a>
                    <p class="m-1 text-sm text-gray-300">
                        {!! $latestPost->shortBody(10) !!}
                    </p>
                </div> <!-- latest post end -->
            </article>
        </div> <!-- latest post end -->

        <h1 class="rounded-md mx-3 md:mx-0 my-2 text-md p-2 font-bold uppercase bg-black dark:bg-zinc-800 w-max text-center text-white">RECOMMENDED</h1>
        <div class="md:gap-x-3 space-y-3 md:space-y-0 md:grid md:grid-cols-[1fr_1fr_1fr]">
            @foreach($recommendedPosts as $recommended)
                <div class="m-4 md:m-0 bg-white dark:bg-zinc-800 overflow-hidden shadow-md">
                    <a href="{{ route('view', $recommended) }}" class="h-full flex flex-col">
                        <img class="grow" src="{{ $recommended->getThumbnail() }}">
                        <div class="p-2">
                            @foreach($recommended->categories as $category)
                            <span class="lg:block md:hidden uppercase font-bold text-red-500">
                                {{$category->title}}
                            </span>
                            @endforeach
                            <p class="hover:text-red-500 dark:text-gray-200 lg:text-lg transition ease-in-out">
                                {{ $recommended->title }}
                            </p>
                        </div>
                    </a>
                </div> <!-- recommended post end -->
            @endforeach
        </div> <!-- recommended post end -->
    </div> <!-- latest and recommended posts wrapper end -->
    
    <x-sidebar/>

    @foreach($categories as $category)
    <div class="mx-4 md:mx-0 md:col-start-2 md:col-end-5">
        <div class="p-4 bg-white dark:bg-zinc-800 shadow-md">
            <h3 class="pb-3 uppercase text-md lg:text-xl font-black dark:text-zinc-400">
                {{ $category->title }}
            </h3>
            @foreach($category->publishedPosts()->limit(2)->get() as $post)
                <a href="{{ route('view', $post) }}">
                    <div class="grid grid-cols-[max-content_1fr] lg:grid-cols-[377px_1fr]">
                        <img class="py-1 w-40 lg:w-full object-cover" src="{{ $post->getThumbnail() }}" alt="">
                            <div class="mx-3">
                                <p class="pb-3 text-xl uppercase font-bold text-md transition ease-in-out dark:text-white text-red-600 lg:text-black hover:text-red-600 dark:hover:text-red-600">
                                    {{ $post->title }}
                                </p>
                </a> <!-- route link end -->

                                <x-markdown> {!! $post->shortBody(10) !!} </x-markdown>
                                <p class="dark:text-gray-200">
                                    {{ $post->getFormattedDate() }}
                                </p>
                            </div> <!-- 4th div end -->
                    </div> <!-- 3rd div end -->             
            @endforeach
        </div> <!-- 2nd div end -->
    </div> <!-- categories end -->
    @endforeach

</x-app-layout>