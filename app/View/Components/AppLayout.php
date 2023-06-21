<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;


class AppLayout extends Component
{
    public function __construct(public ?string $metaTitle = null, public ?string $metaDescription = null)
    {

    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $categories = Category::with(['subCategory'=>function ($query) {
            $query->with(['posts'=>function ($q2) {
                $q2->where('published_at', '<', Carbon::now());
            }]);
            }])->withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();
        
            $allCategories = Category::with('subCategory')
            ->whereNull('parent_id')
            ->get()
            ->flatMap(function ($category) {
                $subCategories = $category->subCategory->toArray();
                unset($category['sub_category']);
                return [$category] + $subCategories;
            }); 
            $allCategories = collect($allCategories)->where('parent_id', null)->values();
            
        return view('layouts.app', compact('categories', 'allCategories'));
    }
}