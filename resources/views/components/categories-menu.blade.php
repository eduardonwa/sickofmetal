<div
    :class="open ? 'block': 'hidden'"
    class="w-full flex-grow md:flex md:items-center md:w-auto lg:col-start-3 lg:col-end-5 mx-auto gap-3"
>
    <div
        x-data="{ open: null }"
        class="w-full flex-grow sm:flex sm:items-center sm:w-auto"
    >

        <div class="mx-auto flex flex-col items-center justify-center sm:flex-row text-sm font-bold uppercase mt-0 px-6 py-2">
            @foreach ($allCategories as $category)
                <div
                    class="py-2 relative w-full lg:w-auto"
                    @mouseenter="open = '{{ $loop->index }}'"
                    @mouseleave="open = null"
                >
                    <div class="flex items-center justify-between">
                        <a
                            class="text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2"
                            href="{{ route('by-category', ['category'=>$category['slug']]) }}"
                        >
                            {{ $category['title'] }}
                        </a>
                        @if ($category['parent_id'] == null && $category->subCategory()->count() > 0)
                        <span :class="open === '{{ $loop->index }}' ? 'w-6 h-6 rounded-full bg-white': 'w-6 h-6 rounded-full border'"
                            class="mx-2 text-transparent font-bold cursor-pointer text-2xl lg:hidden antialiased"
                            @click="open = open === '{{ $loop->index }}' ? null : '{{ $loop->index }}'">
                            +
                        </span>
                    </div>

                    <div
                        x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        x-show="open === '{{ $loop->index }}'"
                        @click="open != '{{ $loop->index }}'"
                        @click.away="open = null"
                        class="lg:w-44 w-full border-2 border-red-600 z-10 bg-black inline-flex flex-col justify-center items-center absolute top-full left-0 right-0 p-3"
                    >
                        @foreach($category['subCategory'] as $subCategory)
                            <a
                                href="{{ route('by-category', $subCategory) }}"
                                class="text-white text-center text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded p-2"
                            >
                                {{ $subCategory->title }}
                            </a>
                        @endforeach

                        @else
                            <!-- this category has no subcategories -->
                        @endif
                    </div> <!-- subcategories menu end -->
                </div> <!-- categories menu end -->
            @endforeach
            <a href="{{ route('about') }}" class="w-full text-white text-lg transition ease-out hover:bg-gray-100 hover:text-black rounded p-2 ml-7 md:ml-0">
                About
            </a>
        </div>
    </div>
</div>
