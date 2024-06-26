<div>
    <div class="flex mb-4 gap-3">
        <div class="shadow-md border border-gray-700 w-16 h-16 flex items-center justify-center bg-gray-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>
        <div>
            <div>
                <a href="#" class="font-bold dark:sick-text"> {{ $comment->user->name }} </a>
                - <span class="text-gray-500 dark:text-gray-200">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            @if ($editing)
            <div class="sm:w-44 md:w-96">
                <livewire:comment-create :comment-model="$comment"/>
            </div>
            @else
                <div class="text-gray-700 dark:text-gray-400">
                    {{ $comment->comment }}
                </div>
            @endif
            <div>
                <a wire:click.prevent="startReply" href="#" class="text-sm mr-3 dark:text-white">Reply</a>
                @if (\Illuminate\Support\Facades\Auth::id() == $comment->user_id)
                    <a wire:click.prevent="startCommentEdit" href="#" class="text-sm text-blue-500 mr-3">Edit</a>
                    <a wire:click.prevent="deleteComment" href="#" class="text-sm text-red-500">Delete</a>
                @endif
            </div>
            @if ($reply)
            <div class="sm:w-44 md:w-96">
                <livewire:comment-create :post="$comment->post" :parent-comment="$comment"/>
            </div>
            @endif

            @if($comment->comments->count())
            <div class="mt-4">
                @foreach($comment->comments as $childComment)
                    <livewire:comment-item :comment="$childComment" wire:key="comment-{{$childComment->id}}"/>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
