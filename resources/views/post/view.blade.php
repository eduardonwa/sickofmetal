<x-app-layout>    
    <section class="px-3 lg:col-start-2 lg:col-end-5 w-mx-auto">
        
        <article class="flex flex-col my-4">
            <!-- Article Image -->
            <div class="relative h-0 pb-2/3 sm:pt-1/3 lg:pb-1/3 hover:opacity-75">
                <img class="absolute inset-0 w-full h-full object-top object-cover" src="{{ $post->getThumbnail() }}">
            </div>

            <div class="bg-white dark:bg-zinc-800 flex flex-col justify-start px-3">
                @foreach($post->categories as $category)
                    <a href="category/{{ $category->slug }}" class="text-red-500 dark:text-red-500 font-bold uppercase py-4">
                        {{ $category->title }}
                    </a>
                @endforeach
                <h1 class="text-3xl font-bold hover:text-gray-700 pb-4 dark:text-gray-200 dark:hover:text-white">
                    {{ $post->title }}
                </h1>
                <p class="dark:text-gray-200">
                    By <span class="font-semibold hover:text-gray-700 dark:text-gray-200">
                        {{ $post->user->name }}
                    </span>, {{ $post->getFormattedDate() }} | {{ $post->human_read_time }}
                    read time
                </p>

                <livewire:upvote-downvote :post="$post" />

                <div class="border border-gray-700 border-b-2"></div>

                <div class="my-8 text-lg dark:text-gray-200 aspect-auto">
                    <x-markdown>
                        {!! $post->body !!}
                    </x-markdown>
                </div>

            </div>
            
            <div class="lg:col-start-1 lg:col-end-5 w-full flex pt-6">
                
                <div class="w-1/2">
                    @if($prev ?? false)
                        <a href="{{ route('view', $prev) }}" class="block w-full bg-white dark:bg-zinc-800 shadow hover:shadow-md text-left p-6">
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
    <div class="lg:col-start-5 lg:col-end-6">
        @if ($popularPosts ?? false)
            <h1 class="rounded-md mx-3 md:mx-0 my-2 text-md p-2 font-bold uppercase bg-black w-max text-center text-white">
                Latest News
            </h1>
            @foreach ($popularPosts as $popularPost)
                <x-post-item :popularPost="$popularPost"></x-post-item>
            @endforeach <!-- popular post column end -->
        @endif
    </div> <!-- popular posts end -->
</x-app-layout>