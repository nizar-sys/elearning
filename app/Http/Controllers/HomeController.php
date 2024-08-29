<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Elearning;
use App\Models\Material;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $elearningCounts = Elearning::count();
        $articleCounts = Article::count();
        $materialCounts = Material::count();
        $categories = Category::select('name')->get();
        $elearnings = Elearning::where('status', 'active')->get();
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', '%Teacher%');
        })->get();
        $teacherCounts = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', '%Teacher%');
        })->count();

        return view('user.landing_page', compact('articleCounts', 'teacherCounts', 'elearningCounts', 'materialCounts', 'categories', 'elearnings', 'teachers'));
    }

    public function about()
    {
        return view('user.about');
    }

    public function course()
    {
        $elearnings = Elearning::where('status', 'active')->get();
        return view('user.course', compact('elearnings'));
    }

    public function tutor()
    {
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'like', '%Teacher%');
        })->get();
        return view('user.tutor', compact('teachers'));
    }

    public function article()
    {
        $articles = Article::where('status', 'published')->get();
        return view('user.article', compact('articles'));
    }

    public function video()
    {
        $videos = Video::select('title', 'description', 'thumbnail', 'video', 'created_at')->get();

        return view('user.video', compact('videos'));
    }

    public function detailCourse($courseId)
    {
        $elearning = Elearning::findOrFail($courseId);
        $materials = $elearning->materials;
        $material = $materials->first();
        $totalMaterials = $elearning->materials->count();
        $reviews = $elearning->reviews;

        return view('user.detail-course', compact('elearning', 'materials', 'totalMaterials', 'material', 'reviews'));
    }


    public function detailArticle($articleId)
    {
        $article = Article::findOrFail($articleId);

        $relatedArticles = Article::where('id', '!=', $articleId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('user.detail-article', compact('article', 'relatedArticles'));
    }
}
