<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    public function index($slugCategory){
        $category = Category::where('slug', $slugCategory)->firstOrFail();

        $articles = Article::with('Category')->whereStatus(1)->whereHas('Category', function($query) use ($slugCategory) {
            $query->where('slug', $slugCategory);
        })->latest()->paginate(9);
        return view('front.category.index', [
            'articles' => $articles,
            'category' => $category,
        ]);
    }
    public function allCategory(){
        $category = Category::whereHas('Articles', function (Builder $query) {
                $query->where('status', 1);
            })
            ->withCount(['Articles' => function (Builder $query) {
                $query->where('status', 1);
            }])
            ->latest()
            ->get();
        return view('front.category.all-category', [
            'category' => $category
        ]);
    }
}
