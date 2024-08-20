<?php

namespace App\Http\Controllers\Console;

use App\DataTables\ElearningDataTable;
use App\DataTables\Scopes\ElearningScope;
use App\Enums\ElearningStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreElearning;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Elearning;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ElearningController extends Controller
{
    protected $sharedData;

    public function __construct()
    {
        $this->sharedData = [
            'teachers' => User::select('id', 'name')->get(),
            'benefits' => Benefit::select('id', 'type')->get(),
            'elearningStatus' => ElearningStatus::asArray(),
            'categories' => Category::select('id', 'name')->get(),
            'materials' => Material::select('id', 'title')->get(),
        ];
    }

    public function index(Request $request, ElearningDataTable $dataTable)
    {
        return $dataTable
            ->addScope(new ElearningScope($request))
            ->render('console.elearnings.index', $this->sharedData);
    }

    public function create()
    {
        return view('console.elearnings.create', $this->sharedData);
    }

    public function store(RequestStoreElearning $request)
    {
        $payloadElearning = $request->validated();

        DB::beginTransaction();

        try {
            $payloadElearning['thumbnail'] = $this->handleThumbnailUpload($request);

            $elearning = Elearning::create($payloadElearning);

            // Sync categories and materials
            $elearning->categories()->sync($request->input('category_id', []));
            $elearning->materials()->sync($request->input('material_id', []));

            DB::commit();

            return redirect()->route('elearnings.index')->with('success', 'Elearning created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create elearning: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to create elearning. Please try again.']);
        }
    }

    public function edit(Elearning $elearning)
    {
        $elearning->load('categories', 'materials');

        return view('console.elearnings.edit', array_merge(['elearning' => $elearning], $this->sharedData));
    }

    public function update(RequestStoreElearning $request, Elearning $elearning)
    {
        $payloadElearning = $request->validated();

        DB::beginTransaction();

        try {
            $payloadElearning['thumbnail'] = $this->handleThumbnailUpload($request, $elearning->thumbnail);

            $elearning->update($payloadElearning);

            // Sync categories and materials
            $elearning->categories()->sync($request->input('category_id', []));
            $elearning->materials()->sync($request->input('material_id', []));

            DB::commit();

            return redirect()->route('elearnings.index')->with('success', 'Elearning updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to update elearning: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to update elearning. Please try again.']);
        }
    }

    public function destroy(Elearning $elearning)
    {
        DB::beginTransaction();

        try {
            deleteFileIfExist($elearning->thumbnail);
            $elearning->delete();

            DB::commit();

            return redirect()->route('elearnings.index')->with('success', 'Elearning deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to delete elearning: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Failed to delete elearning. Please try again.']);
        }
    }

    protected function handleThumbnailUpload(Request $request, $existingThumbnail = null)
    {
        if ($request->hasFile('thumbnail')) {
            return handleUpload('thumbnail', '/elearnings', $existingThumbnail);
        }
        return $existingThumbnail;
    }
}
