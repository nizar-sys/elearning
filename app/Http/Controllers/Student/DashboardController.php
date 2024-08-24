<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Elearning;
use App\Models\Material;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Fetch monitoring data
        $totalElearnings = Elearning::count();
        $totalVideos = Video::count();
        $totalArticles = Article::count();
        $totalMaterials = Material::count(); // Assuming you have a Material model

        // Fetch latest elearnings
        $latestCourses = Elearning::latest()->take(5)->get();

        // Fetch popular instructors
        $popularInstructors = User::whereHas('elearnings')
            ->withCount('elearnings')
            ->orderBy('elearnings_count', 'desc')
            ->take(4)
            ->get();

        return view('student.dashboard', compact(
            'latestCourses',
            'popularInstructors',
            'totalElearnings',
            'totalVideos',
            'totalArticles',
            'totalMaterials',
        ));
    }
}
