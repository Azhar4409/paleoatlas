<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Category;
use App\Models\Knowledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $latest_articles = Article::with('category')
            ->whereStatus(1)
            ->latest()
            ->take(3)
            ->get();

        return view('front.home.index', compact('latest_articles'));
    }

    public function about()
    {
        return view('front.home.about');
    }

    public function contact()
    {
        return view('front.home.contact');
    }

    public function blog()
    {
        return view('front.home.blog', [
            'latest_post' => Article::withCount('comments')->latest()->first(),
            'articles' => Article::with('Category')->withCount('comments')->whereStatus(1)->latest()->paginate(6),
        ]);
    }

    public function contactSend(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $toEmail = 'veritas@gmail.com';
        $subject = 'New Contact Message from ' . $validated['name'];

        $toEmail = 'veritasstudiocreative@gmail.com';
        Mail::raw("Name: {$validated['name']}\nEmail: {$validated['email']}\n\nMessage:\n{$validated['message']}", function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)
                    ->subject($subject);
        });

        return redirect()->back()->with('success', 'Pesan Anda telah terkirim. Terima kasih!');
    }

    public function aboutSend(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $toEmail = 'veritasstudiocreative@gmail.com';
        $subject = 'New About Page Message from ' . $validated['name'];

        Mail::raw("Name: {$validated['name']}\nEmail: {$validated['email']}\n\nMessage:\n{$validated['message']}", function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)
                    ->subject($subject);
        });

        return redirect()->back()->with('success', 'Pesan Anda telah terkirim. Terima kasih!');
    }
}
