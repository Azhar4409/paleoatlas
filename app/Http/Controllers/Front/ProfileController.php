<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $articles = $user->articles()->latest()->paginate(9);
        return view('front.profil.index', compact('user', 'articles'));
    }

    public function show()
    {
        $user = Auth::user();
        $authUserId = $user->id;
        return view('front.profil.show', compact('user', 'authUserId'));
    }

    public function publicProfile($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $authUserId = Auth::id();
        return view('front.profil.show', compact('user', 'authUserId'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'yt' => 'nullable|string|max:255',
            'ig' => 'nullable|string|max:255',
            'fb' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('name', 'bio', 'description', 'yt', 'ig', 'fb', 'tiktok');

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo && Storage::disk('public')->exists('profile/' . $user->profile_photo)) {
                Storage::disk('public')->delete('profile/' . $user->profile_photo);
            }

            // Upload new photo
            $file = $request->file('profile_photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile', $fileName, 'public');
            $user->profile_photo = $fileName;
        }

        $user->update($data);

        return redirect()->route('profil.index')->with('success', 'Profile updated!');
    }
}
