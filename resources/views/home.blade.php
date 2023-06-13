<x-app-layout meta-description="Sick Of Metal blog for the metalhead with rock and heavy metal news and much more">
    <div>
        <h1 class="rounded-md mx-3 md:mx-0 my-2 text-sm p-2 font-bold uppercase bg-black w-max text-center text-white">POPULAR</h1>
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

        <h1 class="rounded-md mx-3 md:mx-0 my-2 text-sm p-2 font-bold uppercase bg-black w-max text-center text-white">RECOMMENDED</h1>
        <div class="md:space-x-3 space-y-3 md:space-y-0 md:grid md:grid-cols-2">
            @foreach($recommendedPosts as $recommended)
                <div class="inline-flex flex-col bg-white overflow-hidden shadow-md">
                    <img class="" src="{{ $recommended->getThumbnail() }}" alt="Mountain">
                    <div class="px-6 py-4">
                        <span class="uppercase font-bold text-md text-blue-600">
                            {{ $recommended->category }}
                        </span>
                        <p class="font-bold">
                            {{ $recommended->title }}
                        </p>
                    </div>
                </div> <!-- recommended wrapper end -->
            @endforeach
        </div> <!-- recommended post end -->
    </div> <!-- latest and recommended posts wrapper end -->

    <x-sidebar/>
</x-app-layout>