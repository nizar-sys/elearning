<?php

namespace App\Http\Controllers\Console;

use App\DataTables\Scopes\VideoScope;
use App\DataTables\VideoDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreVideo;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    protected $sharedData;

    public function __construct()
    {
        // Inisialisasi data yang digunakan secara berulang
        $this->sharedData = [
            'categories' => Category::select('id', 'name')->get(),
        ];
    }

    public function index(Request $request, VideoDataTable $dataTable)
    {
        // Render dengan data yang telah diambil di constructor
        return $dataTable
            ->addScope(new VideoScope($request))
            ->render('console.videos.index', $this->sharedData + [
                'creators' => User::select('id', 'name')
                    ->whereHas('roles', function ($query) {
                        $query->whereIn('name', ['Teacher', 'Administrator']);
                    })
                    ->when(auth()->user()->hasRole('Teacher'), function ($query) {
                        return $query->where('id', auth()->user()->id);
                    })
                    ->get(),
            ]);
    }

    public function create()
    {
        // Kembalikan view dengan data yang telah disiapkan
        return view('console.videos.create', $this->sharedData + [
            'creators' => User::select('id', 'name')
                ->whereHas('roles', function ($query) {
                    $query->whereIn('name', ['Teacher', 'Administrator']);
                })
                ->when(auth()->user()->hasRole('Teacher'), function ($query) {
                    return $query->where('id', auth()->user()->id);
                })
                ->get(),
        ]);
    }

    public function store(RequestStoreVideo $request)
    {
        $payloadVideo = $request->validated();

        DB::beginTransaction();

        try {
            $payloadVideo['thumbnail'] = $this->handleThumbnailUpload($request);

            // Buat video baru
            $video = Video::create($payloadVideo);

            // Sync kategori
            $video->categories()->sync($request->input('category_id', []));

            DB::commit();

            return redirect()->route('videos.index')->with('success', 'Video created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create video: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to create video. Please try again.']);
        }
    }

    public function edit(Video $video)
    {
        // Eager loading categories untuk menghindari N+1 query problem
        $video->load('categories');

        return view('console.videos.edit', array_merge(['video' => $video], $this->sharedData + [
            'creators' => User::select('id', 'name')
                ->when(auth()->user()->hasRole('Teacher'), function ($query) {
                    return $query->where('id', auth()->user()->id);
                })
                ->get(),
        ]));
    }

    public function update(RequestStoreVideo $request, Video $video)
    {
        $payloadVideo = $request->validated();

        DB::beginTransaction();

        try {
            // Handle upload thumbnail
            $payloadVideo['thumbnail'] = $this->handleThumbnailUpload($request, $video->thumbnail);

            // Update video
            $video->update($payloadVideo);

            // Sync categories untuk memperbarui relasi dengan kategori
            $video->categories()->sync($request->input('category_id', []));

            DB::commit();

            return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to update video: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to update video. Please try again.']);
        }
    }

    public function destroy(Video $video)
    {
        DB::beginTransaction();

        try {
            deleteFileIfExist($video->thumbnail);
            $video->delete();

            DB::commit();

            return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to delete video: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Failed to delete video. Please try again.']);
        }
    }

    // Method khusus untuk handle upload thumbnail
    protected function handleThumbnailUpload(Request $request, $existingThumbnail = null)
    {
        if ($request->hasFile('thumbnail')) {
            return handleUpload('thumbnail', '/videos', $existingThumbnail);
        }
        return $existingThumbnail;
    }
}
