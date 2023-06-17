<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class Comments extends Component
{
    public $comments;
    
    public Post $post;

    protected $listeners = [
        'commentCreated' => 'commentCreated'
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->comments = Comment::where('post_id', $this->post->id)->orderByDesc('created_at')->get();
    }
    
    public function render()
    {       
        return view('livewire.comments');
    }

    public function commentCreated(Int $id)
    {
        $comment = Comment::where('id', '=', $id)->first();
        $this->comments = $this->comments->prepend($comment);
    }
}