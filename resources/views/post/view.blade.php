<x-app-layout :meta-title="$post->title" :meta-description="$post->caption">
    <section class="my-32 px-3 lg:col-start-2 lg:col-end-5 w-mx-auto">

        <article class="flex flex-col">
            <!-- Article Image -->
            <div class="bg-white dark:bg-zinc-900 flex flex-col justify-start px-8 lg:px-16 py-2">
                @foreach($post->categories as $category)
                    <a
                        href="category/{{ $category->slug }}"
                        class="text-lg text-red-500 dark:text-red-500 font-bold uppercase py-4">
                        {{ $category->title }}
                    </a>
                @endforeach
                <h1 class="text-3xl py-4 font-bold dark:text-white">
                    {{ $post->title }}
                </h1>
                <span class="dark:text-gray-200 text-gray-700 py-4">
                    {{ $post->caption }}
                </span>
                <div class="dark:text-gray-200 pb-4 text-sm flex flex-col">
                    {{-- By <span class="font-semibold hover:text-gray-700 dark:text-gray-200">
                        {{ $post->user->name }}
                    </span> <br> --}}
                    {{-- @foreach ($post->views as $view)
                        {{ $view->post_id }}
                    @endforeach --}}
                    <span class="rounded-full">
                        {{ $post->human_read_time }}
                    </span>

                    <span>
                        {{ $post->getFormattedDate() }}
                    </span>
                </div>
            </div>

            <div class="relative h-0 pb-2/3 sm:pt-1/3 lg:pb-1/3 hover:opacity-75">
                <img
                    class="absolute inset-0 w-full h-full object-top object-cover"
                    src="{{ $post->getMedia('thumbnails') }}"
                    alt="Thumbnail of the post"
                    srcset="{{ $post->getFirstMedia('thumbnails')->getSrcset() }}"
                >
            </div>

            <div class="bg-white dark:bg-zinc-900 flex flex-col justify-start">
                <div class="bodyOfThePost my-5 text-lg dark:text-gray-200 aspect-auto">
                    <x-markdown class="px-3 md:px-20" id="postLinks">
                        {!! $post->body !!}
                    </x-markdown>

                    <div class="px-3 mt-20 md:px-20 w-full flex gap-x-2 pb-4">
                        @foreach ($post->tags as $tag)
                            <a href="tag/{{ $tag->slug }}" class="
                                    w-auto
                                    py-1
                                    text-sm
                                    font-semibold
                                    cursor-pointer
                                    text-black
                                    dark:sick-text

                                    lg:w-max
                                    lg:p-1
                                    lg:font-normal
                                    lg:rounded-sm
                                    lg:border
                                    lg:border-red-600
                                    lg:hover:bg-red-600
                                    lg:hover:text-white
                                    lg:transition
                                    lg:ease-in-out

                                    lg:dark:hover:bg-transparent
                                    lg:dark:hover:sick-border
                                    lg:dark:sick-text
                                    "
                            >
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>

                </div>
            </div> <!-- body -->

            <div class="flex justify-center items-center p-3 mx-auto container text-center">
                <livewire:upvote-downvote :post="$post" />
            </div> <!-- likes, dislikes end -->

            <div class="lg:col-start-1 lg:col-end-5 w-full flex pt-6">
                <div class="w-1/2">
                    @if($prev ?? false)
                        <a href="{{ route('view', $prev) }}" class="block w-full bg-white dark:bg-zinc-900 shadow hover:shadow-md text-left p-6">
                            <p class="text-lg text-sick dark:sick-text font-bold flex items-center">
                                <i class="fas fa-arrow-left pr-1"></i>
                                Previous
                            </p>
                            <p class="pt-2 dark:text-gray-200">
                                {{ \Illuminate\Support\Str::words($prev->title, 5) }}
                            </p>
                        </a>
                    @endif
                </div>

                <div class="w-1/2">
                    @if($next ?? false)
                        <a href="{{ route('view', $next) }}" class="block w-full bg-white dark:bg-zinc-800 shadow hover:shadow-md text-right p-6">
                            <p class="text-lg text-sick dark:sick-text font-bold flex items-center justify-end">
                                Next <i class="fas fa-arrow-right pl-1"></i></p>
                            <p class="pt-2 dark:text-gray-200">
                                {{ \Illuminate\Support\Str::words($next->title, 5) }}
                            </p>
                        </a>
                    @endif
                </div>
            </div> <!-- prev and next end -->
        </article> <!-- article, prev and next end -->

        <livewire:comments :post="$post" /> <!-- comments end -->

    </section>
    <div class="lg:col-start-5 lg:col-end-6 my-32">
        @if ($popularPosts ?? false)
            <h1 class="rounded-md mx-3 md:mx-0 my-2 text-base p-2 font-bold uppercase bg-black w-max text-center text-white">
                Breaking News
            </h1>
            @foreach ($popularPosts as $popularPost)
                <x-post-item :popularPost="$popularPost"></x-post-item>
            @endforeach <!-- popular post column end -->
        @endif
    </div> <!-- popular posts end -->
</x-app-layout>
