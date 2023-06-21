<x-app-layout :meta-title="'Sick Of Metal blog - Posts by category ' . $category->title" 
              :meta-description="'By category description'"
>
    <div class="m-3 md:col-start-1 md:col-end-4 lg:col-end-5 lg:grid lg:grid-cols-2">
        @foreach ($posts as $post)
        <a class="m-5" href="{{ route('view', $post) }}">
            <div class="max-w-lg rounded overflow-hidden shadow-lg flex-col md:flex text-center justify-between">
                <div class="overflow-hidden bg-gray-100">
                    <img class="overflow-hidden transform scale-100 hover:scale-150 ease-in-out duration-1000 h-full object-cover" src="{{ $post->getThumbnail() }}" alt="">
                </div>
                <div class="h-28 text-center bg-white text-gray-900 p-3">
                    @foreach ($post->categories as $category)
                    <h1 class="uppercase font-semibold text-blue-700">{{ $category->title }}</h1>
                    @endforeach
                    <p class="font-bold">{{ $post->title }}</p>
                    <span class="">By {{ $post->user->name }} • </span>
                    <span class="">{{ $post->getFormattedDate() }}</span>
                </div>
            </div>
        </a>
        @endforeach

        <div class="mt-20 p-4 lg:col-span-full">
            {{ $posts->links() }}
        </div>

    </div>

</x-app-layout>