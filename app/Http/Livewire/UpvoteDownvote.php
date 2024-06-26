<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;;
use App\Models\UpvoteDownvote as AppUpvoteDownvote;

class UpvoteDownvote extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }
    
    public function render()
    {
        $upvotes = AppUpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('is_upvote', '=', true)
            ->count();

        $downvotes = AppUpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('is_upvote', '=', false)
            ->count();

        // The status whether current user has upvoted the post or not
        // This will be null, true or false
        // null means user has done upvote or downvote
        $hasUpvote = null;

        /** @var \App\Models\User $user */
        $user = request()->user();

        if($user) {
            $upvoteDownvote = AppUpvoteDownvote::where('post_id', '=', $this->post->id)
                ->where('user_id', '=', $user->id)
                ->first();
            if($upvoteDownvote) {
                $hasUpvote = !!$upvoteDownvote->is_upvote;
            }
        }
        
        return view('livewire.upvote-downvote', compact('upvotes', 'downvotes', 'hasUpvote'));
    }

    public function upvoteDownvote($upvote = true)
    {
        /** @var \App\Models\User $user */
        $user = request()->user();

        if(!$user) {
            return $this->redirect('login');
        }

        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        $upvoteDownvote = AppUpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('user_id', '=', $user->id)
            ->first();

        if(!$upvoteDownvote) {
            AppUpvoteDownvote::create([
                'is_upvote' => $upvote,
                'post_id' => $this->post->id,
                'user_id' => $user->id
            ]);
            
            return;
        }

        if ($upvote && $upvoteDownvote->is_upvote || !$upvote && !$upvoteDownvote->is_upvote) {
            $upvoteDownvote->delete();
        } else {
            $upvoteDownvote->is_upvote = $upvote;
            $upvoteDownvote->save();
        }

    }
}