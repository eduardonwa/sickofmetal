<x-app-layout>
    <section class="flex flex-col px-3 lg:col-start-1 lg:col-end-4">
        <article class="flex flex-col my-4">
            <!-- Article Image -->
            <div class="hover:opacity-75">
                <img class="w-full object-contain" src="{{ $post->getThumbnail() }}">
            </div>
            <div class="bg-white flex flex-col justify-start p-6">
                @foreach($post->categories as $category)
                    <a href="category/{{ $category->slug }}" class="text-blue-700 text-sm font-bold uppercase pb-4">
                        {{ $category->title }}
                    </a>
                @endforeach
                <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">
                    {{ $post->title }}
                </h1>
                <p class="text-sm">
                    By <span class="font-semibold hover:text-gray-800">
                        {{ $post->user->name }}
                    </span>, Published on {{ $post->getFormattedDate() }} | {{ $post->human_read_time }}
                </p>

                <livewire:upvote-downvote :post="$post" />

                <div class="border border-gray-700 border-b-2"></div>
                <div class="my-8 text-lg">
                    <x-markdown>
                        {!! $post->body !!}
                    </x-markdown>
                </div>
            </div>
            
            <div class="lg:col-start-1 lg:col-end-5 w-full flex pt-6">
                
                <div class="w-1/2">
                    @if($prev)
                        <a href="{{ route('view', $prev) }}" class="block w-full bg-white shadow hover:shadow-md text-left p-6">
                            <p class="text-lg text-blue-800 font-bold flex items-center">
                                <i class="fas fa-arrow-left pr-1"></i>
                                Previous
                            </p>
                            <p class="pt-2">
                                {{ \Illuminate\Support\Str::words($prev->title, 5) }}
                            </p>
                        </a>
                    @endif
                </div>

                <div class="w-1/2">
                    @if($next)
                        <a href="{{ route('view', $next) }}" class="block w-full bg-white shadow hover:shadow-md text-right p-6">
                            <p class="text-lg text-blue-800 font-bold flex items-center justify-end">
                                Next <i class="fas fa-arrow-right pl-1"></i></p>
                            <p class="pt-2">
                                {{ \Illuminate\Support\Str::words($next->title, 5) }}
                            </p>
                        </a>
                    @endif
                </div>
                
            </div> <!-- prev and next end -->
        </article> <!-- article, prev and next end -->
        
        <livewire:comments :post="$post" /> <!-- comments end -->
    
    </section> 
    <div class="lg:col-start-4 lg:col-end-5">
        <h1 class="rounded-md mx-3 md:mx-0 my-2 text-md p-2 font-bold uppercase bg-black w-max text-center text-white">POPULAR</h1>
            @foreach ($popularPosts as $popularPost)
                <x-post-item :popularPost="$popularPost"></x-post-item>
            @endforeach <!-- popular post column end -->
    </div> <!-- popular posts end -->
    
</x-app-layout>