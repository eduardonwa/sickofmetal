<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostView;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        // latest post

        // show the 3 most popular posts

        // if authorized show recommended posts based on user upvotes
        
        // not authorized = popular posts based on views

        // show recent categories with latest posts

        $posts = Post::query()
            ->where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->with('categories')
            ->take(4)
            ->get();

        $latestPost = $posts->shift();
     
        return view('home', compact('posts', 'latestPost'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Request $request)
    {
        if (!$post->active || $post->published_at > Carbon::now()) {
            throw new NotFoundHttpException();
        }
      
        $next = Post::query()
            ->where('active', true)
            ->where('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();

        $prev = Post::query()
            ->where('active', true)
            ->where('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();
        
        $user = $request->user();

        PostView::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'post_id' => $post->id,
            'user_id' => $user?->id
        ]);

        return view('post.view', compact('post', 'prev', 'next'));
    }

    public function byCategory(Category $category)
    {
        $categories = Category::query();

        $posts = Post::query()
            ->join('category_post', 'posts.id', '=', 'category_post.post_id')
            ->where('category_post.category_id', '=', $category->id)
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

            return view('categories', compact('posts', 'categories', 'category'));
    }
}