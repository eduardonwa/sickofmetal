<article class="mx-auto px-4 bg-white dark:bg-zinc-900 shadow-md py-2">
    <div class="md:flex-col w-full">
        <div class="flex-col md:col-span-4 flex">
            @foreach($popularPost->categories as $category)
                <a
                    href="category/{{ $category->slug }}"
                    class="text-red-600 font-bold uppercase"
                >
                    {{ $category->title }}
                </a>
            @endforeach
            <a href="{{ route('view', $popularPost) }}">
                <h3 class="dark:text-gray-200 ">
                    <span class="antialiased dark:hover:bg-red-600 hover:bg-black dark:hover:text-gray-100 hover:text-red-600">{{$popularPost->title}}</span>
                </h3>
            </a>
        </div>
    </div>
</article> <!-- latest news end -->
