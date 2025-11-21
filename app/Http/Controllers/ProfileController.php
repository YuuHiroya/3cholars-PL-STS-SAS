<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // TAMPILKAN HALAMAN PROFILE
    public function edit(Request $request)
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }

    // UPDATE PROFILE USER
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'gpa' => 'nullable|string|max:50',
            'preferred_country' => 'nullable|string',
            'about' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048'
        ]);

        // UPLOAD FOTO PROFIL
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile', 'public');
            $user->profile_picture = $path;
        }

        // UPDATE SEMUA DATA
        $user->username = $request->username;
        $user->major = $request->major;
        $user->location = $request->location;
        $user->field = $request->field;
        $user->education = $request->education;
        $user->gpa = $request->gpa;
        $user->preferred_country = $request->preferred_country;
        $user->about = $request->about;

        $user->save();

        return back()->with('success', 'Profile updated');
    }

    // UPLOAD FOTO VIA AJAX (OPTIONAL)
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048'
        ]);

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        $user = auth()->user();
        $user->profile_picture = $path;
        $user->save();

        return response()->json(['path' => asset('storage/' . $path)]);
    }

    // HAPUS AKUN USER
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
