<article class="bg-white shadow my-4 px-4 py-3 grid grid-cols-5 hover:bg-red-600 transition ease-out">
    <a class="col-span-1 flex items-center" href="{{ route('view', $post) }}">
        <img class="pr-2 " src="{{ $post->getThumbnail() }}">
    </a>

    <a class="col-span-4 flex items-center" href="{{ route('view', $post) }}">
        <h3 class="text-md font-bold hover:text-white transition ease-out">
            {{$post->title}}
        </h3>
    </a>
</article> <!-- wrapper end -->