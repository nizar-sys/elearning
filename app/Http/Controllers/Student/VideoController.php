<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk search dan filter berdasarkan kategori
        $search = $request->input('search');
        $categorySlug = $request->input('category');

        $videos = Video::with('categories', 'creator')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($categorySlug, function ($query, $categorySlug) {
                return $query->whereHas('categories', function ($query) use ($categorySlug) {
                    $query->where('slug', $categorySlug);
                });
            })
            ->latest()
            ->paginate(6);

        // Ambil semua kategori untuk filter
        $categories = Category::has('videos')->get();

        return view('student.videos.index', compact('videos', 'categories'));
    }

    public function show($slug)
    {
        $video = Video::where('slug', $slug)->with('categories', 'creator')->firstOrFail();

        // Ambil video terkait dalam kategori yang sama
        $relatedVideos = Video::whereHas('categories', function ($query) use ($video) {
            $query->whereIn('categories.id', $video->categories->pluck('id'));
        })->where('id', '!=', $video->id)
          ->latest()
          ->take(5)
          ->get();

        return view('student.videos.show', compact('video', 'relatedVideos'));
    }
}
