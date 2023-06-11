<article class="bg-white shadow my-4 px-4 py-3 hover:bg-red-600 transition ease-out">
    <div class="flex-col items-center justify-center">

        <div class="md:grid md:grid-cols-6 lg:grid-rows-2">
            <a href="{{ route('view', $post) }}"
                class="md:col-span-2 lg:row-start-1 lg:col-span-full md:w-full"
            >
                <img class="pr-2 md:w-full md:object-cover" src="{{ $post->getThumbnail() }}">
            </a>
            <div class="flex-col md:col-span-4 flex lg:row-start-2 lg:col-span-full">
                @foreach($post->categories as $category)
                    <a href="category/{{ $category->slug }}" class="hover:text-white text-blue-700 text-sm font-bold uppercase pb-4">
                        {{ $category->title }}
                    </a>
                @endforeach
                <a href="{{ route('view', $post) }}">
                    <h3 class="text-lg font-bold hover:text-white transition ease-out">
                        {{$post->title}}
                    </h3>
                </a>
                <p>
                    {{ $post->getFormattedDate() }}
                </p>
            </div>
        </div>

    </div>
</article>