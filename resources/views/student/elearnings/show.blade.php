@extends('layouts.app')

@section('title', $elearning->title)

@push('styles')
    @vite('resources/css/student/elearnings/show_elearning.css')
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <img id="main-thumbnail" class="card-img-top material-thumbnail" src="{{ asset($elearning->thumbnail) }}"
                        alt="{{ $elearning->title }}" />

                    <div id="main-video-container" class="d-none">
                        <iframe id="main-video" class="material-video-container" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <div class="card-body">
                        <h1 id="main-title" class="card-title">{{ $elearning->title }}</h1>

                        <div class="d-flex justify-content-between mb-4 text-muted">
                            <span>By <strong>{{ $elearning->teacher->name }}</strong></span>
                            <span>Duration: {{ $elearning->duration }} hours</span>
                        </div>

                        <div id="main-description" class="card-text">
                            {!! $elearning->description !!}
                        </div>

                        <div class="mt-4">
                            <h4>Categories:</h4>
                            <ul class="list-inline">
                                @foreach ($elearning->categories as $category)
                                    <li class="list-inline-item">
                                        <span class="badge bg-primary">{{ $category->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-4">
                            <h4>Benefits:</h4>
                            <p>{!! $elearning->benefit->description !!}</p>
                        </div>

                        <div class="mt-4">
                            <h4>
                                Rating: {{ number_format($elearning->reviews->avg('rating'), 1) }} / 5
                                <span class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="ri-star-{{ $i <= $elearning->reviews->avg('rating') ? 'fill' : 'line' }} ri-24px me-1"></i>
                                    @endfor
                                </span>
                                <span class="fw-normal">({{ $elearning->reviews->count() }})</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm p-4">
                    <h5 class="mb-3">Materials</h5>
                    <ul class="list-unstyled">
                        @foreach ($elearning->materials as $index => $material)
                            <li class="mb-3">
                                <div class="material-card">
                                    <div class="material-title" data-index="{{ $index }}"
                                        data-video="{{ $material->video }}" data-title="{{ $material->title }}"
                                        data-description="{!! $material->description !!}">
                                        <strong>{{ $material->title }}</strong>
                                    </div>
                                    <p class="material-description">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($material->description), 50) }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <a id="back-to-elearning" class="btn-back d-none" href="#">
                        <i class="fa fa-arrow-left"></i> Back to E-learning Details
                    </a>
                </div>
            </div>

            <div class="col-lg-8 mt-0">
                <div class="review-section card shadow-sm p-4">
                    <h5 class="review-title">Reviews:</h5>
                    <div class="review-list scrollable-list">
                        @foreach ($elearning->reviews->sortByDesc('created_at') as $review)
                            <div class="review-item mb-3">
                                <div class="review-rating">
                                    <span class="text-warning">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="ri-star-{{ $i <= $review->rating ? 'fill' : 'line' }} ri-24px me-1"></i>
                                        @endfor
                                    </span>
                                </div>
                                <div class="review-text">
                                    <b>{{ $review->review }}</b>
                                </div>
                                <div class="review-author">
                                    <small>Reviewed by: {{ $review->reviewer->name }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="review-form mt-4">
                        <h4 class="form-title">Leave a Review:</h4>
                        <form action="{{ route('student.elearnings.review.store', $elearning->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="rating" class="mb-3">Rating (1-5):</label>
                                <div class="basic-ratings">
                                </div>
                                <input type="hidden" name="rating">
                            </div>
                            <div class="form-group mt-3">
                                <label for="review">Review:</label>
                                <textarea name="review" id="review" rows="4" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="material-modal" class="modal d-none">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title"></h2>
            <div id="modal-description"></div>
            <iframe id="modal-video" class="material-video-container d-none" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const elearningTitle = '{{ $elearning->title }}';
        const elearningDescription = `{!! $elearning->description !!}`;
    </script>
    @vite('resources/js/student/elearnings/show_elearning.js')
@endpush
