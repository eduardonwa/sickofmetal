<button
    @click="open = true"
    type="button"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6 text-white cursor-pointer"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
    </svg>
</button>

<div
    x-show="open"
    x-cloak
    @keydown.escape.prevent.stop="open = false"
    role="dialog"
    aria-modal="true"
    x-id="['modal-title']"
    :aria-labelledby="$id('modal-title')"
    class="fixed inset-0 z-20"
>
    <div class="fixed inset-0 bg-red-950 bg-opacity-20 backdrop-blur-sm">
        <div
            @click="open = false"
            class="relative top-24 p-3 h-full w-full flex items-start justify-center"
        >
            <div
                @click.stop
                x-trap.noscroll="open"
                class="max-w-2xl w-full bg-gray-200 rounded-md overflow-y-auto"
            >
                <form method="get" action="{{route('search')}}"
                    class="relative lg:col-start-4"
                >
                    <input
                        name="q" value="{{request()->get('q')}}"
                        class="peer m-0 block h-[58px] w-full rounded bg-transparent bg-clip-padding px-3 py-4 text-base font-normal leading-tight
                        text-black transition duration-200 ease-linear placeholder:text-transparent focus:border-primary focus:pb-[0.625rem] focus:pt-[1.625rem]
                        focus:text-black focus:bg-white focus:shadow-lg peer-focus:text-primary dark:peer-focus:text-primary [&:not(:placeholder-shown)]:pb-[0.625rem] [&:not(:placeholder-shown)]:pt-[1.625rem]"
                        id="floatingInput"
                        placeholder="Press Enter when ready" />

                    <label
                        :id="$id('modal-title')"
                        for="floatingInput"
                        class="pointer-events-none absolute left-0 top-0 origin-[0_0] border border-solid border-transparent px-3 py-4 text-slate-700
                        transition-[opacity,_transform] duration-200 ease-linear peer-focus:-translate-y-2 peer-focus:translate-x-[0.15rem]
                        peer-focus:scale-[0.85] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-translate-y-2 peer-[:not(:placeholder-shown)]:translate-x-[0.15rem]
                        peer-[:not(:placeholder-shown)]:scale-[0.85] motion-reduce:transition-none"
                        >Search</label>
                </form>
            </div> <!-- search elements end -->
        </div> <!-- panel end -->
    </div> <!-- overlay end -->
</div> <!-- modal end -->
