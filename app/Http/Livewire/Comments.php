<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class Comments extends Component
{    
    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh'
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }
    
    public function render()
    {       
        $comments = $this->selectComments();
        return view('livewire.comments', compact('comments'));
    }

    public function commentCreated(Int $id)
    {
        $comment = Comment::where('id', '=', $id)->first();
        if (!$comment->parent_id) {
            $this->comments = $this->comments->prepend($comment);
        }
    }

    /**
     * @return mixed
     * @author guarpig
     */

    private function selectComments()
    {
        return Comment::where('post_id', '=', $this->post->id)
            ->with(['post', 'user', 'comments'])
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();
    }
}