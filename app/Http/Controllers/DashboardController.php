<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Elearning;
use App\Models\ElearningReview;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isTeacher = $user->hasRole('Teacher');
        $userId = $user->id;

        $elearningQuery = Elearning::query();
        if ($isTeacher) {
            $elearningQuery->where('teacher_id', $userId);
        }
        $elearningData = $elearningQuery->with('teacher')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $reviewsQuery = ElearningReview::query();
        if ($isTeacher) {
            $reviewsQuery->whereHas('elearning', function ($query) use ($userId) {
                $query->where('teacher_id', $userId);
            });
        }
        $latestReviews = $reviewsQuery->with(['elearning', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $totals = [
            'totalElearnings' => $elearningQuery->count(),
            'totalReviews' => $reviewsQuery->count(),
            'totalUsers' => User::count(),
            'totalArticles' => Article::when($isTeacher, function ($query) use ($userId) {
                return $query->where('created_by', $userId);
            })->count(),
            'totalBenefits' => Benefit::count(),
            'totalCategories' => Category::count(),
        ];

        return view('dashboard', [
            'totals' => $totals,
            'recentElearnings' => $elearningData,
            'latestReviews' => $latestReviews
        ]);
    }
}
