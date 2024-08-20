<?php

namespace App\Http\Controllers\Console;

use App\DataTables\MaterialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreMaterial;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MaterialController extends Controller
{
    public function index(MaterialDataTable $dataTable)
    {
        return $dataTable
            ->render('console.materials.index');
    }

    public function create()
    {
        return view('console.materials.create');
    }

    public function store(RequestStoreMaterial $request)
    {
        $payloadMaterial = $request->validated();

        DB::beginTransaction();

        try {

            if ($request->hasFile('thumbnail')) {
                $payloadMaterial['thumbnail'] = handleUpload('thumbnail', '/materials');
            }

            Material::create($payloadMaterial);

            DB::commit();

            return redirect()->route('materials.index')->with('success', 'Material created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create material: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to create material. Please try again.']);
        }
    }

    public function edit(Material $material)
    {
        return view('console.materials.edit', compact('material'));
    }

    public function update(RequestStoreMaterial $request, Material $material)
    {
        $payloadMaterial = $request->validated();

        DB::beginTransaction();

        try {

            if ($request->hasFile('thumbnail')) {
                $payloadMaterial['thumbnail'] = handleUpload('thumbnail', '/materials', $material->thumbnail);
            }

            $material->update($payloadMaterial);

            DB::commit();

            return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to update material: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to update material. Please try again.']);
        }
    }

    public function destroy(Material $material)
    {
        DB::beginTransaction();

        try {
            $material->delete();

            DB::commit();

            return redirect()->route('materials.index')->with('success', 'Material deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to delete material: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Failed to delete material. Please try again.']);
        }
    }
}
