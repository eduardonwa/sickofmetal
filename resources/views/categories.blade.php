<x-app-layout :meta-title="'Sick Of Metal blog - Posts by category ' . $category->title" 
              :meta-description="'By category description'"
            >
    <div class="m-3 md:col-start-1 md:col-end-4 lg:col-end-5 lg:grid lg:grid-cols-2">
        @foreach ($posts as $post)
        <a class="m-5" href="{{ route('view', $post) }}">
            <div class="max-w-lg rounded overflow-hidden shadow-lg flex-col md:flex text-center justify-between">
                <div class="overflow-hidden bg-gray-100 h-72">
                    <img class="overflow-hidden transform scale-100 hover:scale-150 ease-in-out duration-1000 h-full w-full" src="{{ $post->getThumbnail() }}" alt="">
                </div>
                <!-- print category!! -->
                <div class="h-28 text-center bg-white p-3">
                    <p class="font-bold text-black">{{ $post->title }}</p>
                    <span class="text-black">By {{ $post->user->name }} • </span>
                    <span class="text-black font-bold">{{ $post->getFormattedDate() }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</x-app-layout>