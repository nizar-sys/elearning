@extends('layouts.app')
@section('title', 'Create Review')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">
                    <span class="fw-normal">Add Review</span>
                </h5>
            </div>

            <div class="card-body">
                <div class="offcanvas-body mx-0 flex-grow-0 h-100 mt-2">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <h4 class="alert-heading d-flex align-items-center">
                                <span class="alert-icon rounded">
                                    <i class="ri-error-warning-line ri-22px"></i>
                                </span>
                                Something went wrong!
                            </h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="review pt-0" id="reviewForm" method="POST" onsubmit="return false"
                        action="{{ route('reviews.store') }}">
                        @csrf

                        <div class="row">
                            <!-- Elearning ID (Dropdown or Hidden Input) -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <select class="form-control @error('elearning_id') is-invalid @enderror"
                                        id="review-elearning" name="elearning_id" aria-label="Select Elearning">
                                        <option value="" disabled selected>Select Elearning</option>
                                        @foreach ($elearnings as $elearning)
                                            <option value="{{ $elearning->id }}"
                                                {{ old('elearning_id') == $elearning->id ? 'selected' : '' }}>
                                                {{ $elearning->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="review-elearning">Elearning</label>
                                    @error('elearning_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Reviewer ID (Hidden Input, typically tied to logged-in user) -->
                            <input type="hidden" name="reviewer_id" value="{{ auth()->user()->id }}">


                            <!-- Rating Input (Dropdown or Number Input) -->
                            <div class="col-sm-12 col-md-6">
                                <label for="review-rating">Rating</label>
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <div class="basic-ratings"></div>
                                    <input type="hidden" name="rating" value="{{ old('rating') }}">
                                    @error('rating')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Review Textarea -->
                            <div class="col-sm-12 col-md-12">
                                <label for="review-content">Review</label>
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <textarea class="form-control @error('review') is-invalid @enderror full-editor" id="review-content"
                                        placeholder="Write your review" name="review" aria-label="Review" cols="30" rows="5">{{ old('review') }}</textarea>
                                    @error('review')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                        <a href="{{ route('reviews.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/console/reviews/review_validation_script.js')
@endpush
