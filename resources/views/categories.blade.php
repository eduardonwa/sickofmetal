<x-app-layout :meta-title="'Sick Of Metal blog - Posts by category ' . $category->title" 
              :meta-description="'By category description'"
>
    <div class="space-y-8 lg:space-y-0 gap-6 md:col-start-1 md:col-end-4 lg:col-end-5 lg:grid lg:grid-cols-2 place-items-center">
        @foreach ($posts as $post)
        <a class="h-full flex flex-col" href="{{ route('view', $post) }}">
            <div class="max-w-lg rounded overflow-hidden shadow-lg flex-col md:flex text-center justify-between h-full">
                <div class="overflow-hidden bg-gray-100">
                    <img class="h-96 object-cover flex-grow overflow-hidden transform scale-100 hover:scale-150 ease-in-out duration-1000" src="{{ $post->getThumbnail() }}" alt="">
                </div>
                <div class="h-28 text-center bg-white dark:bg-zinc-800 text-gray-900 dark:text-gray-200 p-3">
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