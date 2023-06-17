<div class="mb-8">
    <div x-data="{
            focused: false,
            init() {
                    console.log('init called')
                }
        }"
    >
        <div class="mb-2">
            <textarea wire:model="comment" @click="focused = true" 
                    class="bg-white resize-none block w-full rounded-md px-3.5 py-2 text-gray-900 ring-1 ring-inset ring-gray-300 
                    focus:ring-2 focus:ring-inset focus:ring-blue-700 focus:shadow-lg bg-transparent
                    placeholder:text-gray-400 border-none focus:outline-none sm:text-sm leading-6" 
                    :rows="focused ? '2' : '1'"
                    placeholder="Leave a comment..."></textarea>
        </div>
        <div :class="focused ? '' : 'hidden'" class="flex justify-end">
            <button @click="focused = false" type="button" class="mr-4">
                    Cancel
            </button>
            <button wire:click="createComment" 
                    type="button"
                    class="rounded-md bg-blue-500 px-3.5 py-2.5 text-center text-sm font-semibold
                    text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2
                    focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Comment
            </button>
        </div> <!-- submit and cancel end -->
    </div>
</div>