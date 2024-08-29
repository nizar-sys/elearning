<?php

namespace App\Http\Controllers\Console;

use App\DataTables\ElearningReviewDataTable;
use App\DataTables\Scopes\ElearningReviewScope;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreRating;
use App\Models\Elearning;
use App\Models\ElearningReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    protected $sharedData;

    public function __construct()
    {
        // Inisialisasi data yang digunakan secara berulang
        $this->sharedData = [];
    }

    public function index(Request $request, ElearningReviewDataTable $dataTable)
    {
        $reviewers = User::select('id', 'name')->get();

        return $dataTable
            ->addScope(new ElearningReviewScope($request))
            ->render('console.reviews.index', compact('reviewers') + $this->sharedData + [
                'elearnings' => Elearning::select('id', 'title')
                    ->when(auth()->user()->hasRole('Teacher'), function ($query) {
                        return $query->where('teacher_id', auth()->user()->id);
                    })
                    ->get()
            ]);
    }

    public function create()
    {
        return view('console.reviews.create', $this->sharedData + [
            'elearnings' => Elearning::select('id', 'title')
                ->when(auth()->user()->hasRole('Teacher'), function ($query) {
                    return $query->where('teacher_id', auth()->user()->id);
                })
                ->get()
        ]);
    }

    public function store(RequestStoreRating $request)
    {
        DB::beginTransaction();

        try {
            $payloadReview = $request->validated();

            ElearningReview::create($payloadReview);

            DB::commit();

            return redirect()->route('reviews.index')->with('success', 'Review has been created');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create review: ' . $e->getMessage());

            return back()->withInput()->with('error', 'Failed to create review: ' . $e->getMessage());
        }
    }

    public function show(ElearningReview $review)
    {
        return view('console.reviews.show', compact('review'));
    }

    public function edit(ElearningReview $review)
    {
        return view('console.reviews.edit', compact('review') + $this->sharedData + [
            'elearnings' => Elearning::select('id', 'title')
                ->when(auth()->user()->hasRole('Teacher'), function ($query) {
                    return $query->where('teacher_id', auth()->user()->id);
                })
                ->get()
        ]);
    }

    public function update(RequestStoreRating $request, ElearningReview $review)
    {
        DB::beginTransaction();

        try {
            $payloadReview = $request->validated();

            $review->update($payloadReview);

            DB::commit();

            return redirect()->route('reviews.index')->with('success', 'Review has been updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update review: ' . $e->getMessage());

            return back()->withInput()->with('error', 'Failed to update review: ' . $e->getMessage());
        }
    }

    public function destroy(ElearningReview $review)
    {
        DB::beginTransaction();

        try {
            $review->delete();

            DB::commit();

            return redirect()->route('reviews.index')->with('success', 'Review has been deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete review: ' . $e->getMessage());

            return back()->with('error', 'Failed to delete review: ' . $e->getMessage());
        }
    }
}
