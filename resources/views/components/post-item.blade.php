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
                <h1 class="text-lg md:text-base dark:text-gray-200">
                    <span class="antialiased hover:sick-bg dark:hover:sick-bg dark:hover:text-black">
                        {{$popularPost->title}}
                    </span>
                </h1>
            </a>
        </div>
    </div>
</article> <!-- breaking news end -->
