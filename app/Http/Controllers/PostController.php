<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostView;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        //show the latest post created
        $latestPosts = Post::where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // show the 8 latest posts with more upvotes
        $popularPosts = Post::query()
            ->whereNotIn('posts.id', $latestPosts->pluck('id'))
            ->leftJoin('upvote_downvotes', 'post_id', '=', 'upvote_downvotes.post_id')
            ->select('posts.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
            ->where(function($query) {
                $query->whereNull('upvote_downvotes.is_upvote')
                    ->orWhere('upvote_downvotes.is_upvote', '=', 1);
            })
            ->where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->groupBy('posts.id')
            ->limit(8)
            ->get();

        // show recent categories with latest posts
        $categories = Category::query()
            ->whereNotIn('posts.id', $latestPosts->pluck('id'))
            ->whereHas('posts', function($query) {
                $query->where('active', '=', 1)
                      ->where('published_at', '<', Carbon::now());
            })
            ->select('categories.*')
            ->selectRaw('MAX(posts.published_at) as max_date')
            ->leftJoin('category_post', 'categories.id', '=', 'category_post.category_id')
            ->leftJoin('posts', 'posts.id', '=', 'category_post.post_id')
            ->orderByDesc('max_date')
            ->groupBy('categories.id')
            ->limit(5)
            ->get();

        // if authorized show recommended posts based on user upvotes
        $user = auth()->user();

        if ($user) {
            $leftJoin = "(SELECT cp.category_id, cp.post_id FROM upvote_downvotes
                        JOIN category_post cp ON upvote_downvotes.post_id = cp.post_id
                        WHERE upvote_downvotes.is_upvote = 1 and upvote_downvotes.user_id = ?) as t";
            $recommendedPosts = Post::query()
                ->leftJoin('category_post as cp', 'posts.id', '=', 'cp.post_id')
                ->leftJoin(DB::raw($leftJoin), function ($join) {
                    $join->on('t.category_id', '=', 'cp.category_id')
                         ->on('t.post_id', '!=', 'cp.post_id');
                        })
                ->select('posts.*')
                ->where('posts.id', '!=', DB::raw('t.post_id'))
                ->setBindings([$user->id])
                ->limit(3)
                ->get();
        // not authorized = popular posts based on views
        } else {

            $startWeek = Carbon::now()->subWeek()->startOfWeek();
            $endWeek   = Carbon::now()->subWeek()->endOfWeek();

            $recommendedPosts = Post::query()
                ->leftJoin('post_views', 'posts.id', '=', 'post_views.post_id')
                ->select('posts.*', DB::raw('COUNT(post_views.id) as view_count'))
                ->where('active', '=', 1)
                ->withCount('views')->having('views_count', '>', 15)
                ->whereBetween('published_at',[$startWeek, $endWeek])
                ->groupBy('posts.id')
                ->limit(3)
                ->get();
        }

        return view('home', compact(
            'latestPosts',
            'popularPosts',
            'recommendedPosts',
            'categories'
        ));
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

        // show the 5 most popular posts on the post view
        $popularPosts = Post::query()
            ->where('posts.id', '!=', $post->id)
            ->leftJoin('upvote_downvotes', 'post_id', '=', 'upvote_downvotes.post_id')
            ->select('posts.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
            ->where(function($query) {
                $query->whereNull('upvote_downvotes.is_upvote')
                    ->orWhere('upvote_downvotes.is_upvote', '=', 1);
            })
            ->where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->orderByDesc('upvote_count')
            ->groupBy('posts.id')
            ->limit(5)
            ->get();

        return view('post.view', compact('post', 'prev', 'next', 'popularPosts'));
    }

    public function byCategory(Category $category)
    {
        $catIDs = [$category->id];

        $subCategories = $category->subCategory()->with('subCategory')->get();
        foreach($subCategories as $subCategory) {
            $catIDs[] =$subCategory->id;
        }

        $categoryPostIDs = CategoryPost::whereIn('category_id', $catIDs)->pluck('post_id');

        $posts = Post::whereIn('id', $categoryPostIDs)
            ->where('active', '=', 1)
            ->where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

            return view('categories', compact('posts', 'category'));
    }

    public function byTag(Post $post, $slug)
    {
        $posts = Post::withAnyTags([$slug])
            ->where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->with('tags:id,name')
            ->paginate(8);

        // dd($posts);

        // show the 5 most popular posts on the post view
        $popularPosts = Post::query()
            ->where('posts.id', '!=', $post->id)
            ->leftJoin('upvote_downvotes', 'post_id', '=', 'upvote_downvotes.post_id')
            ->select('posts.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
            ->where(function($query) {
                $query->whereNull('upvote_downvotes.is_upvote')
                    ->orWhere('upvote_downvotes.is_upvote', '=', 1);
            })
            ->where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->orderByDesc('upvote_count')
            ->groupBy('posts.id')
            ->limit(5)
            ->get();

            return view('tag', compact('popularPosts', 'posts'));
    }

    public function search(Request $request, Post $post)
    {
        $q = $request->get('q');

        $posts = Post::query()
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->where(function($query) use($q) {
                $query->where('title', 'like', "%$q%")
                      ->orWhere('body', 'like', "%$q%");
            })
            ->paginate(8);

        // show the 5 most popular posts on the post view
        $popularPosts = Post::query()
            ->where('posts.id', '!=', $post->id)
            ->leftJoin('upvote_downvotes', 'post_id', '=', 'upvote_downvotes.post_id')
            ->select('posts.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
            ->where(function($query) {
                $query->whereNull('upvote_downvotes.is_upvote')
                    ->orWhere('upvote_downvotes.is_upvote', '=', 1);
            })
            ->where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->orderByDesc('upvote_count')
            ->groupBy('posts.id')
            ->limit(5)
            ->get();


        return view('post.search', compact('posts', 'popularPosts'));
    }
}
