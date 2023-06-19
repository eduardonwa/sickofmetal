<x-app-layout>
    <div class="lg:col-start-1 lg:col-end-5 container mx-auto flex flex-wrap py-6">

        <!-- Posts section -->
        <section class="w-full md:w-2/3 px-3">
            <div class="flex flex-col">
                @foreach($posts as $post)
                    <div class="">
                        <a href="{{ route('view', $post) }}">
                            <h1 class="my-2 text-blue-700 font-bold text-lg uppercase">
                                {!! str_replace(request()->get('q'), 
                                    '<span class="bg-yellow-400">'.request()->get('q').'</span>', 
                                    $post->title) 
                                !!}
                            </h1>
                        </a>
                        <div>
                            <p>
                                {{ $post->shortBody() }}
                            </p>
                            <span class="text-gray-500">{{ $post->getFormattedDate() }}</span>
                        </div>
                    </div>
                    <div class="my-4 border-b-2 border-black"></div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </section>

        
    </div>
    <!-- Sidebar section -->
    <x-sidebar />
</x-app-layout>