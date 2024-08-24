<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategorySlug = $request->query('category');
        $searchQuery = $request->query('search');

        $query = Article::with(['category', 'creator']);

        if ($selectedCategorySlug) {
            $query->whereHas('category', function ($q) use ($selectedCategorySlug) {
                $q->where('slug', $selectedCategorySlug);
            });
        }

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('content', 'LIKE', '%' . $searchQuery . '%');
            });
        }

        $query->status('published');

        $articles = $query->latest()->paginate(6);

        $categories = Category::all();

        return view('student.articles.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->with('category', 'creator')->firstOrFail();

        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(5)
            ->get();

        return view('student.articles.show', compact('article', 'relatedArticles'));
    }
}
