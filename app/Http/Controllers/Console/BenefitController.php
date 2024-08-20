<?php

namespace App\Http\Controllers\Console;

use App\DataTables\BenefitDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreBenefit;
use App\Models\Benefit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BenefitController extends Controller
{
    public function index(BenefitDataTable $dataTable)
    {
        return $dataTable
            ->render('console.benefits.index');
    }

    public function create()
    {
        return view('console.benefits.create');
    }

    public function store(RequestStoreBenefit $request)
    {
        DB::beginTransaction();

        try {
            Benefit::create($request->validated());

            DB::commit();

            return redirect()->route('benefits.index')
                ->with('success', 'Benefit created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()->withInput()->with('error', 'Failed to create benefit. Please try again.');
        }
    }

    public function edit(Benefit $benefit)
    {
        return view('console.benefits.edit', compact('benefit'));
    }

    public function update(RequestStoreBenefit $request, Benefit $benefit)
    {
        DB::beginTransaction();

        try {
            $benefit->update($request->validated());

            DB::commit();

            return redirect()->route('benefits.index')
                ->with('success', 'Benefit updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()->withInput()->with('error', 'Failed to update benefit. Please try again.');
        }
    }

    public function destroy(Benefit $benefit)
    {
        DB::beginTransaction();

        try {
            $benefit->delete();

            DB::commit();

            return redirect()->route('benefits.index')
                ->with('success', 'Benefit deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()->with('error', 'Failed to delete benefit. Please try again.');
        }
    }
}
