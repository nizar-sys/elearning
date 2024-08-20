<?php

namespace App\Http\Controllers\Console;

use App\DataTables\ArticleDataTable;
use App\DataTables\Scopes\ArticleScope;
use App\Enums\ArticleStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreArticle;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function index(Request $request, ArticleDataTable $dataTable)
    {
        $categories = Category::select('id', 'name')->get();
        $creators = User::select('id', 'name')->get();
        $articleStatus = ArticleStatus::getValues();

        return $dataTable
            ->addScope(new ArticleScope($request))
            ->render('console.articles.index', compact('categories', 'creators', 'articleStatus'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $creators = User::select('id', 'name')->get();
        $articleStatus = ArticleStatus::getValues();

        return view('console.articles.create', compact('categories', 'creators', 'articleStatus'));
    }

    public function store(RequestStoreArticle $request)
    {
        $payloadArticle = $request->validated();

        DB::beginTransaction();

        try {

            if ($request->hasFile('thumbnail')) {
                $payloadArticle['thumbnail'] = handleUpload('thumbnail', '/articles');
            }

            Article::create($payloadArticle);

            DB::commit();

            return redirect()->route('articles.index')->with('success', 'Article created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create article: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to create article. Please try again.']);
        }
    }

    public function edit(Article $article)
    {
        $categories = Category::select('id', 'name')->get();
        $creators = User::select('id', 'name')->get();
        $articleStatus = ArticleStatus::getValues();

        return view('console.articles.edit', compact('article', 'categories', 'creators', 'articleStatus'));
    }

    public function update(RequestStoreArticle $request, Article $article)
    {
        $payloadArticle = $request->validated();

        DB::beginTransaction();

        try {

            if ($request->hasFile('thumbnail')) {
                $payloadArticle['thumbnail'] = handleUpload('thumbnail', '/articles', $article->thumbnail);
            }

            $article->update($payloadArticle);

            DB::commit();

            return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to update article: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to update article. Please try again.']);
        }
    }

    public function destroy(Article $article)
    {
        DB::beginTransaction();

        try {

            if ($article->thumbnail) {
                deleteFileIfExist($article->thumbnail);
            }

            $article->delete();

            DB::commit();

            return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to delete article: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Failed to delete article. Please try again.']);
        }
    }
}
