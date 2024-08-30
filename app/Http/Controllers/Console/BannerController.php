<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreBanner;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::first();

        return view('console.banners.index', compact('banner'));
    }

    public function update(RequestStoreBanner $request, $bannerId)
    {
        $banner = Banner::firstOrNew(['id' => $bannerId]);

        $banner->fill([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $banner->image,
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image) {
                deleteFileIfExist($banner->image);
            }

            $banner->image = handleUpload('image', 'banners');
        }

        $banner->save();

        return back()->with('success', 'Banner updated successfully');
    }
}
