@extends('layouts.user')
@section('title', 'Detail Course')

@push('css')
    <style>
        .course-item {
            transition: background-color 0.3s ease;
        }

        .course-item:hover {
            background-color: #8B93FF;
            color: #fff;
        }

        .course-item.active {
            background-color: #8B93FF;
        }

        .course-item .play-icon {
            font-size: 1.5rem;
        }

        .course-item .material-capsule {
            flex-grow: 1;
            display: flex;
            align-items: center;
        }

        .course-item span {
            display: flex;
            align-items: center;
        }

        .course-category {
            display: inline-block;
            padding: 5px 15px;
            margin: 5px;
            border-radius: 20px;
            background-color: #8B93FF;
            color: white;
            font-size: 14px;
            text-align: center;
        }

        .instructor-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .material-font {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .instructor-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .teacher-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid #007bff;
        }

        .instructor-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .teacher-name {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
            color: #333;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }

        .swiper-container {
            width: 100%;
            height: auto;
        }

        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
        }

        .review-item p {
            margin: 0;
            font-size: 16px;
            color: #333;
            text-align: center;
        }
        
        #materials-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .benefits-section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .benefits-section .section-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .benefits-section ul.list-group {
            list-style-type: none;
            padding-left: 0;
        }

        .benefits-section ul.list-group-item {
            border: none;
            padding: 10px 15px;
        }

        .benefits-section i {
            font-size: 1.2rem;
        }
    </style>
@endpush

@section('content')
    <main class="main">
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
                        <div class="video-container"
                            style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0;">
                            <iframe id="course-video" class="img-fluid w-100" src="{{ $material->video }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                            </iframe>
                        </div>

                        <!-- Material Detail -->
                        <div id="material-detail" class="instructor-section mt-4">
                            <div class="card-body">
                                <h4 class="material-title">{{ $material->title }}</h4>
                                <p class="material-description"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Course Materials Section -->
                    <div class="col-lg-4">
                        <div class="course-materials">
                            <h3 class="section-title mt-5">Course Materials</h3>
                            <div class="card">
                                <ul id="materials-list" class="list-group list-group-flush py-3">
                                    <p class="material-font px-2">Total Materials : {{ $totalMaterials }}</p>
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
                    <div class="swiper-container">
                        <!-- Swiper -->
                        <div class="swiper-wrapper">
                            @foreach ($reviews as $review)
                                <div class="swiper-slide review-item">
                                    <p>{!! $review->review !!}</p>
                                </div>
                            @endforeach
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
            const videoPlayer = document.getElementById('course-video');
            const materialTitle = document.querySelector('.material-title');
            const materialDescription = document.querySelector('.material-description');

            materialsList.addEventListener('click', function(e) {
                const listItem = e.target.closest('li.course-item');
                if (listItem) {
                    const activeItems = materialsList.querySelectorAll('.course-item.active');
                    activeItems.forEach(item => item.classList.remove('active'));

                    listItem.classList.add('active');

                    const newVideoSrc = listItem.getAttribute('data-video-src');
                    const newTitle = listItem.getAttribute('data-title');
                    const newDescription = listItem.getAttribute('data-description');

                    videoPlayer.src = newVideoSrc;
                    materialTitle.textContent = newTitle;
                    materialDescription.innerHTML =
                        newDescription; // Gunakan innerHTML jika deskripsi berisi HTML
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 3000, // Waktu jeda dalam milidetik
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                // Uncomment if you want navigation buttons
                // navigation: {
                //     nextEl: '.swiper-button-next',
                //     prevEl: '.swiper-button-prev',
                // },
            });
        });
    </script>
@endpush
