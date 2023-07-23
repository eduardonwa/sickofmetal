<div class="py-4">
    <h1 class="text-base pb-3 dark:text-gray-200">Comments</h1>
    <livewire:comment-create :post="$post" />

    @foreach($comments as $comment)
        <livewire:comment-item :comment="$comment" wire:key="comment-{{$comment->id}}-{{$comment->comments->count()}}"/>
    @endforeach
</div>
