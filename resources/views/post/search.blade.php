<x-app-layout>
    <div class="mt-[96px] lg:col-start-1 lg:col-end-5 container mx-auto flex flex-wrap py-6">

        <!-- Posts section -->
        <section class="w-full md:w-2/3 px-3">
            <div class="flex flex-col">
                @foreach($posts as $post)
                    <div class="">
                        <a href="{{ route('view', $post) }}">
                            <h1 class="my-2 text-red-600 font-bold text-lg uppercase">
                                {!!
                                    str_ireplace(request()->get('q'),
                                    '<span class="bg-yellow-400">'.request()->get('q').'</span>',
                                    $post->title)
                                !!}
                            </h1>
                        </a>
                        <div>
                            <p class="dark:text-gray-200 pb-4">
                                {{ $post->shortBody() }}
                            </p>
                            <span class="text-gray-500 dark:text-gray-50">
                                {{ $post->getFormattedDate() }}
                            </span>
                        </div>
                    </div>
                    <div class="my-4 border-b-2 border-black dark:border-gray-300"></div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </section>


    </div>
    <!-- Sidebar section -->
    <div class="md:mt-[96px]">
        <h1 class="mx-3 md:mx-0 my-2 text-3xl md:text-2xl p-2 font-bold italic w-max text-center dark:text-white">
            Breaking News
        </h1>
            @foreach ($popularPosts as $popularPost)
                <x-post-item :popularPost="$popularPost"></x-post-item>
            @endforeach <!-- latest news column end -->
    </div> <!-- latest news end -->
</x-app-layout>
