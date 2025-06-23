<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Knowledge;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;


class SideWidgetProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('front.layout.side-widget', function ($view) {
            // $category = Category::latest()->get();
            $category = Category::whereHas('Articles', function (Builder $query) {
                $query->where('status', 1);
            })
            ->withCount(['Articles' => function (Builder $query) {
                $query->where('status', 1);
            }])
            ->latest()
            ->get();

            $view->with('categories', $category);
        });

        View::composer('front.layout.side-widget', function ($view) {
            $posts = Article::orderBy('views', 'desc')
                ->whereStatus(1)
                ->take(3)
                ->get();    

            $view->with('popular_posts', $posts);
        });

        View::composer('front.layout.navbar', function ($view) {
            $view->with('categories', Category::latest()->take(3)->get());
        });

        View::composer(['front.layout.side-widget', 'front.home.index'], function ($view) {
            $knowledgeCount = Knowledge::count();
            $weekOfYear = now()->format('W');
            $index = 0;
            if ($knowledgeCount > 0) {
                $index = ($weekOfYear - 1) % $knowledgeCount;
                $knowledge = Knowledge::orderBy('id')->skip($index)->first();
            } else {
                $knowledge = null;
            }
            $view->with('knowledge', $knowledge);
        });
    }
}
