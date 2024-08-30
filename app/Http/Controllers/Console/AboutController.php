<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreAbout;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

        return view('console.about.index', compact('about'));
    }

    public function update(RequestStoreAbout $request, $aboutId)
    {
        $about = About::firstOrNew(['id' => $aboutId]);

        $about->fill([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $about->image,
        ]);

        if ($request->hasFile('image')) {
            if ($about->image) {
                deleteFileIfExist($about->image);
            }

            $about->image = handleUpload('image', 'about');
        }

        $about->save();

        return back()->with('success', 'About section updated successfully');
    }
}
