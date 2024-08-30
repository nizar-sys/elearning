@extends('layouts.user')
@section('title', 'Detail Course')

@push('css')
    @vite('resources/css/detail_course.css')
@endpush

@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Course</h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Course</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->
        <section id="course-detail" class="course-detail section">
            <div class="container">
                <!-- Course Header -->
                <div class="course-header d-flex flex-column align-items-center text-center">
                    <h1 class="course-title">{{ $elearning->title }}</h1>
                    <div class="d-flex flex-wrap justify-content-center">
                        @foreach ($elearning->categories as $category)
                            <span class="course-category capsule">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Course Content -->
                <div class="row mt-5">
                    <!-- Video Section -->
                    <div class="col-lg-8">
                        <!-- Video Thumbnail -->
                        <div id="video-thumbnail" class="video-container"
                            style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0;">
                            <img src="{{ $elearning->thumbnail }}" class="img-fluid w-100 position-absolute"
                                style="top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                alt="Course Thumbnail">
                        </div>

                        <!-- Video Player (Hidden Initially) -->
                        <div id="video-player-container" class="video-container d-none"
                            style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0;">
                            <iframe id="course-video" class="img-fluid w-100" src="" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                            </iframe>
                        </div>

                        <!-- Material Detail -->
                        <div id="material-detail" class="instructor-section mt-4">
                            <div class="card-body">
                                <h4 class="material-title">{{ $elearning->title }}</h4>
                                <div class="material-description">
                                    {!! $elearning->description !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Materials Section -->
                    <div class="col-lg-4">
                        <div class="course-materials">
                            <h3 class="section-title mt-5">Course Materials</h3>
                            <div class="card">
                                <ul id="materials-list" class="list-group list-group-flush py-3">
                                    <p class="material-font px-2">Total Materials: {{ $totalMaterials }}</p>
                                    <hr>
                                    @foreach ($materials as $material)
                                        <li class="list-group-item d-flex align-items-center course-item"
                                            data-video-src="{{ $material->video }}" data-title="{{ $material->title }}"
                                            data-description="{!! htmlspecialchars($material->description, ENT_QUOTES, 'UTF-8') !!}">
                                            <span class="d-flex align-items-center w-100">
                                                <i class="fas fa-play-circle mr-2 play-icon"></i>
                                                <span
                                                    class="material-capsule px-3 py-2 rounded-pill">{{ $material->title }}</span>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="card-footer">
                                    <button id="back-to-elearning" class="btn btn-secondary mt-3 d-none">Course
                                        Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Benefits Section -->
                <div class="benefits-section mt-5">
                    <h2 class="section-title">Benefits</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-check-circle mr-2 text-success"></i>
                            {{ $elearning->benefit->type }}
                        </li>
                    </ul>
                </div>

                <!-- Instructor Section -->
                <div class="instructor-section mt-5">
                    <h2 class="section-title">Teacher</h2>
                    <div class="instructor-profile d-flex align-items-center">
                        <img src="{{ $elearning->teacher->avatar }}" class="img-fluid rounded-circle teacher-img"
                            alt="Teacher Image">
                        <div class="instructor-info ml-3">
                            <h3 class="teacher-name">{{ $elearning->teacher->name }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="reviews-section mt-5">
                    <h2 class="section-title">Student Reviews</h2>
                    <div class="review-section card shadow-sm p-4">
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
                                    <div class="review-text text-left">
                                        <b>{!! $review->review !!}</b>
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
                                    <div class="basic-ratings"></div>
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
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const materialsList = document.getElementById('materials-list');
            const videoPlayerContainer = document.getElementById('video-player-container');
            const videoThumbnail = document.getElementById('video-thumbnail');
            const videoPlayer = document.getElementById('course-video');
            const materialTitle = document.querySelector('.material-title');
            const materialDescription = document.querySelector('.material-description');
            const backToElearningBtn = document.getElementById('back-to-elearning');

            const getYouTubeVideoId = (url) => {
                const match = url.match(
                    /(?:youtu.be\/|v\/|embed\/|watch\?v=)([^#\&\?]*).*/
                );
                return match ? match[1] : null;
            };

            materialsList.addEventListener('click', function(e) {
                const listItem = e.target.closest('li.course-item');
                if (listItem) {
                    // Remove active state from other items
                    const activeItems = materialsList.querySelectorAll('.course-item.active');
                    activeItems.forEach(item => item.classList.remove('active'));

                    // Add active state to clicked item
                    listItem.classList.add('active');

                    // Update video and material details
                    const newVideoSrc = listItem.getAttribute('data-video-src');
                    const newTitle = listItem.getAttribute('data-title');
                    const newDescription = listItem.getAttribute('data-description');

                    videoPlayer.src = `https://www.youtube.com/embed/${getYouTubeVideoId(newVideoSrc)}`;
                    materialTitle.textContent = newTitle;
                    materialDescription.innerHTML = newDescription;

                    // Switch from thumbnail to video player
                    videoThumbnail.classList.add('d-none');
                    videoPlayerContainer.classList.remove('d-none');

                    // Show back button
                    backToElearningBtn.classList.remove('d-none');
                }
            });

            // Handle back to detail button
            backToElearningBtn.addEventListener('click', function() {
                videoPlayerContainer.classList.add('d-none');
                videoThumbnail.classList.remove('d-none');
                materialTitle.textContent = "{{ $elearning->title }}";
                materialDescription.innerHTML = `{!! $elearning->description !!}`;

                // Hide back button
                backToElearningBtn.classList.add('d-none');

                // Remove active state from all items
                const activeItems = materialsList.querySelectorAll('.course-item.active');
                activeItems.forEach(item => item.classList.remove('active'));
            });

            // Initialize ratings if present
            if ($(".basic-ratings").length) {
                $(".basic-ratings")
                    .rateYo({
                        rating: typeof ratingExists !== "undefined" ? ratingExists : 0,
                    })
                    .on("rateyo.set", function(e, data) {
                        $(this).siblings('input[name="rating"]').val(data.rating);
                    });
            }
        });
    </script>
@endpush
