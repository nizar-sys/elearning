<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Elearning;
use App\Models\ElearningReview;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung data untuk dashboard secara efisien
        $elearningData = Elearning::with('teacher')->orderBy('created_at', 'desc')->take(5)->get();
        $latestReviews = ElearningReview::with(['elearning', 'reviewer'])->orderBy('created_at', 'desc')->take(5)->get();

        // Hitung total data
        $totals = [
            'totalElearnings' => Elearning::count(),
            'totalReviews' => ElearningReview::count(),
            'totalUsers' => User::count(),
            'totalArticles' => Article::count(),
            'totalBenefits' => Benefit::count(),
            'totalCategories' => Category::count(),
        ];

        // Return ke view dengan data terstruktur
        return view('dashboard', [
            'totals' => $totals,
            'recentElearnings' => $elearningData,
            'latestReviews' => $latestReviews
        ]);
    }
}
