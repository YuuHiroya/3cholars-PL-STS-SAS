<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{
    /**
     * Menampilkan daftar semua scholarships.
     */
    public function index()
    {
        $scholarships = Scholarship::all();

        return view('scholarships', [
            'scholarships' => $scholarships,
        ]);
    }

    /**
     * Menampilkan saved scholarships user.
     */
    public function saved()
    {
        $user = Auth::user();

        // Ambil relasi saved scholarships
        $saved = $user->savedScholarships()->get();

        return view('scholarships.saved', [
            'saved' => $saved,
            'savedCount' => $saved->count(),
        ]);
    }

    /**
     * Save (bookmark) scholarship.
     */
    public function save($id)
    {
        $user = Auth::user();

        // Cegah duplicate
        if (!$user->savedScholarships()->where('scholarship_id', $id)->exists()) {
            $user->savedScholarships()->attach($id);
        }

        return back()->with('success', 'Scholarship saved!');
    }

    /**
     * Remove from saved.
     */
    public function unsave($id)
    {
        $user = Auth::user();

        if ($user->savedScholarships()->where('scholarship_id', $id)->exists()) {
            $user->savedScholarships()->detach($id);
        }

        return back()->with('success', 'Scholarship removed from saved!');
    }

    
}
