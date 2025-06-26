<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;

class MyArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())->latest()->paginate(10);
        return view('front.my-articles.index', compact('articles'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('front.my-articles.create', compact('categories'));
    }

    public function store(ArticleRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('back', $fileName, 'public');
            $imagePath = $fileName;
        }

        Article::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'desc' => $validated['desc'],
            'img' => $imagePath,
            'views' => 0,
            'status' => $validated['status'],
            'publish_date' => $validated['publish_date'],
        ]);

        return redirect()->route('my-articles.index')->with('success', 'Artikel berhasil disimpan.');
    }

    public function show(Article $my_article)
    {
        if ($my_article->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('front.my-articles.show', ['article' => $my_article]);
    }

    public function edit(Article $my_article)
    {
        if ($my_article->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('front.my-articles.update', [
            'article' => $my_article,
            'categories' => $categories,
        ]);
    }

    public function update(ArticleRequest $request, Article $my_article)
    {
        if ($my_article->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('back', $fileName, 'public');

            // delete old image
            Storage::disk('public')->delete('back/' . $my_article->img);

            $imagePath = $fileName;
        } else {
            $imagePath = $my_article->img;
        }

        $my_article->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'desc' => $validated['desc'], // content with images from CKEditor
            'img' => $imagePath,
            'status' => $validated['status'],
            'publish_date' => $validated['publish_date'],
        ]);

        return redirect()->route('my-articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $my_article)
    {
        if ($my_article->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $my_article->delete();
        return redirect()->route('my-articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $file = $request->file('upload');

        $descPath = storage_path('app/public/desc');

        if (!file_exists($descPath)) {
            mkdir($descPath, 0775, true);
        }

        $image = \Intervention\Image\Facades\Image::make($file)->resize(1000, 1000, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $image->save($descPath . '/' . $fileName);

        $url = asset('storage/desc/' . $fileName);

        return response()->json([
            'uploaded' => 1,
            'fileName' => $fileName,
            'url' => $url,
        ]);
    }
}
