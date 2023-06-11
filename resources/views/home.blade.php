<x-app-layout meta-description="Sick Of Metal blog for the metalhead with rock and heavy metal news and much more">
    <div class="md:col-start-2 md:col-end-6 lg:col-start-2 lg:col-end-5 md:mx-auto">
        <article class="relative">
            <img src="{{ $latestPost->getThumbnail() }}" alt="">
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
                <p class="text-sm m-1 text-gray-300">
                    {{ $latestPost->shortBody() }}
                </p>
            </div> <!-- latest news end -->
        </article>  
    </div> <!-- latest articles end -->
    
    <div class="md:col-start-2 md:col-end-6 md:row-start-2 w-full lg:col-start-1 lg:col-end-2 lg:row-start-1">
        <h1 class="text-lg px-4 md:px-0 font-bold">LATEST NEWS</h1>
        @foreach ($posts as $post)
            <x-post-item :post="$post"></x-post-item>
        @endforeach
    </div> <!-- latest news list end -->
    <x-sidebar/>
</x-app-layout>