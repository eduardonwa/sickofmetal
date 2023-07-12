<x-app-layout :meta-title="'Sick Of Metal - Posts by ' . $category->title"
              :meta-description="'By category description'"
>
    <div class="space-y-8 lg:space-y-0 md:col-start-1 md:col-end-4 lg:col-end-5 lg:grid lg:grid-cols-[1fr_1fr]">
        @foreach ($posts as $post)
        <a class="p-3 flex flex-col" href="{{ route('view', $post) }}">
            <div class="max-w-sm rounded overflow-hidden shadow-lg h-full">
                <div class="relative h-0 pb-2/3 sm:pt-1/3 lg:pb-1/3 overflow-hidden bg-gray-100">
                    <img class="absolute h-full w-full object-cover object-top inset-0 overflow-hidden transform scale-100 hover:scale-150 ease-in-out duration-1000" src="{{ $post->getThumbnail() }}" alt="">
                </div>
                <div class="h-full text-center bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-200 p-3">
                    @foreach ($post->categories as $category)
                    <h1 class="uppercase font-semibold text-red-500">{{ $category->title }}</h1>
                    @endforeach
                    <p class="font-bold">{{ $post->title }}</p>
                    <div class="mb-2">
                        <span>By {{ $post->user->name }} • </span>
                        <span>{{ $post->getFormattedDate() }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach

        <div class="mt-20 p-4 lg:col-span-full">
            {{ $posts->links() }}
        </div>

    </div>

</x-app-layout>
