<?php

namespace App\Http\Controllers\Student;

use App\Enums\ArticleStatus;
use App\Enums\ElearningStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Elearning;
use App\Models\ElearningReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ElearningController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategorySlug = $request->query('category');
        $searchQuery = $request->query('search');

        $query = Elearning::with(['categories', 'materials', 'teacher']);

        if ($selectedCategorySlug) {
            $query->whereHas('categories', function ($q) use ($selectedCategorySlug) {
                $q->where('slug', $selectedCategorySlug);
            });
        }

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchQuery . '%');
            });
        }

        $elearnings = $query
            ->where('status', ElearningStatus::ACTIVE)
            ->latest()->paginate(6);

        $categories = Category::all();

        return view('student.elearnings.index', compact('elearnings', 'categories'));
    }

    public function show($slug)
    {
        // Cari elearning berdasarkan slug
        $elearning = Elearning::where('slug', $slug)
            ->with(['teacher', 'benefit', 'categories', 'materials', 'reviews'])
            ->firstOrFail();

        // Mengirimkan elearning dan materialnya ke view
        return view('student.elearnings.show', compact('elearning'));
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required',
            'review' => 'required|string|max:1000',
        ]);

        ElearningReview::create([
            'elearning_id' => $id,
            'reviewer_id' => Auth::id(),
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }
}
