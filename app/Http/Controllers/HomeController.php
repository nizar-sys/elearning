<?php

namespace App\Http\Controllers;

use App\Enums\ElearningStatus;
use App\Models\About;
use App\Models\Article;
use App\Models\Banner;
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
        $banner = Banner::first();
        $about = About::first();

        return view('user.landing_page', compact('articleCounts', 'teacherCounts', 'elearningCounts', 'materialCounts', 'categories', 'elearnings', 'teachers', 'banner', 'about'));
    }

    public function about()
    {
        $about = About::first();

        return view('user.about', compact('about'));
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
        $elearning = Elearning::with(['categories', 'materials', 'teacher', 'reviews.reviewer', 'benefit'])
            ->findOrFail($courseId);

        $materials = $elearning->materials;
        $material = $materials->first(); // Material pertama sebagai default
        $totalMaterials = $materials->count();
        $reviews = $elearning->reviews()->latest()->get(); // Sortir review langsung di query

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

    public function search(Request $request)
    {
        $query = $request->input('search');

        $results = collect();

        if ($query) {
            $results = $results->merge(
                Article::select('id', 'title', 'content', 'status')->status()->where('title', 'like', "%$query%")
                    ->orWhere('content', 'like', "%$query%")
                    ->get()
                    ->map(fn($item) => [
                        'title' => $item->title,
                        'detail' => route('detail-article', $item->id),
                        'isFile' => false,
                        'type' => 'Article Detail'
                    ])
            );

            $results = $results->merge(
                Video::select('id', 'title', 'description', 'video')->where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->get()
                    ->map(fn($item) => [
                        'title' => $item->title,
                        'detail' => $item->video,
                        'isFile' => true,
                        'type' => 'Video Detail'
                    ])
            );

            $results = $results->merge(
                Elearning::select('id', 'title', 'description', 'status')
                    ->whereStatus(ElearningStatus::ACTIVE)
                    ->where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->get()
                    ->map(fn($item) => [
                        'title' => $item->title,
                        'detail' => route('detail-course', $item->id),
                        'isFile' => false,
                        'type' => 'Course Detail'
                    ])
            );

            $results = $results->merge(
                Material::select('id', 'title', 'description', 'video')->where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->get()
                    ->map(fn($item) => [
                        'title' => $item->title,
                        'detail' => $item->video,
                        'isFile' => true,
                        'type' => 'Material Detail'
                    ])
            );
        }

        return response()->json($results);
    }
}
