<div>
    <h1 class="pb-3">Comments</h1>
    <livewire:comment-create :post="$post" />
    
    @foreach($comments as $comment)
        <livewire:comment-item :comment="$comment" wire:key="comment-{{$comment->id}}"/>
    @endforeach
</div>