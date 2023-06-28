<article class="mx-auto px-4 bg-white dark:bg-transparent dark:lg:bg-zinc-800 shadow-md py-3">
    <div class="md:flex-col w-full">
        <div class="flex-col md:col-span-4 flex">
            @foreach($popularPost->categories as $category)
                <a href="category/{{ $category->slug }}" class="text-red-500 font-bold uppercase">
                    {{ $category->title }}
                </a>
            @endforeach
            <a href="{{ route('view', $popularPost) }}">
                <h3 class="text-lg dark:text-gray-200 hover:text-red-600 transition ease-out">
                    {{$popularPost->title}}
                </h3>
            </a>
            <!-- <p>
                {{ $popularPost->getFormattedDate() }} | {{ $popularPost->human_read_Time }}
            </p> -->
        </div>
    </div>
    <div class="hidden md:block border dark:border-gray-400 border-gray-200 mt-2"></div> <!-- popular post end -->
</article> <!-- popular post wrapper end --> 