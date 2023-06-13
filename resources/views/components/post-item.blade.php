<article class="mx-auto px-4 bg-white shadow-md py-3">
    <div class="">
        <div class="md:flex-col w-full">
            <div class="flex-col md:col-span-4 flex">
                @foreach($popularPost->categories as $category)
                    <a href="category/{{ $category->slug }}" class="text-blue-700 text-lg font-bold uppercase">
                        {{ $category->title }}
                    </a>
                @endforeach
                <a href="{{ route('view', $popularPost) }}">
                    <h3 class="text-lg font-bold hover:text-red-600 transition ease-out">
                        {{$popularPost->title}}
                    </h3>
                </a>
                <p>
                    {{ $popularPost->getFormattedDate() }} | {{ $popularPost->human_read_Time }}
                </p>
            </div>
        </div>
    </div> <!-- popular post end -->
</article> <!-- popular post wrapper end -->