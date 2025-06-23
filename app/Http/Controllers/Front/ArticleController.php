<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $keyword = request()->keyword;
        
        if ($keyword) {
            $articles = Article::with('Category')
                ->whereStatus(1)
                ->where('title', 'like', '%' . $keyword . '%')
                ->latest()
                ->paginate(6);
        } else {
            $articles = Article::with('Category')
                ->whereStatus(1)
                ->latest()
                ->paginate(6);
        }

        return view('front.article.index', [
            'articles' => $articles,
            'keyword' => $keyword,
        ]);
    }
    public function show($slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();
        $article->increment('views');

        $comments = $article->comments()->with('user')->latest()->get();

        return view('front.article.show', [
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    public function storeComment(Request $request, $slug)
    {
        $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        $article = Article::whereSlug($slug)->firstOrFail();

        $article->comments()->create([
            'user_id' => Auth::id(),
            'comment_text' => $request->comment_text,
        ]);

        return redirect()->route('front.article.show', $slug)->with('success', 'Comment added successfully.');
    }
}
