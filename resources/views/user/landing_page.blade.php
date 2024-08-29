@extends('layouts.user')
@section('title', 'Home')

@push('css')
    <style>
        .category-item {
            padding: 10px;
            border-radius: 5px;
            color: white;
            margin-right: 15px;
            margin-bottom: 15px;
        }
    </style>
@endpush
@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="{{ asset('/mentor') }}/assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

            <div class="container">
                <h2 data-aos="fade-up" data-aos-delay="100">Learning Todays,<br>Leading Tomorrow</h2>
                <p data-aos="fade-up" data-aos-delay="200">We are team of talented designers making websites with
                    Bootstrap</p>
                <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('course') }}" class="btn-get-started">Get Started</a>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('/mentor') }}/assets/img/about.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                        <h3>Voluptatem dignissimos provident quasi corporis</h3>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in
                                    voluptate velit.</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                                    storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                        </ul>
                        <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Counts Section -->
        <section id="counts" class="section counts light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-4">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $elearningCounts }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Courses</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-4">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $articleCounts }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Articles</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-4">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $materialCounts }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Materials</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-4">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $teacherCounts }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Teachers</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section><!-- /Counts Section -->

        <section id="courses" class="courses section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Courses</h2>
                <p>Popular Courses</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($elearnings->take(4) as $elearning)
                            <div class="swiper-slide">
                                <a href="{{ route('detail-course', ['courseId' => $elearning->id]) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <div class="course-item" style="transition: transform 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.transform='scale(1.05)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                        <img src="{{ $elearning->thumbnail }}" class="img-fluid" alt="...">
                                        <div class="course-content">
                                            <h3>{{ $elearning->title }}</h3>
                                            <p class="description">{!! \Illuminate\Support\Str::words(strip_tags($elearning->description), 20, '...') !!}</p>
                                            <div class="trainer d-flex justify-content-start align-items-start">
                                                <div class="trainer-profile d-flex align-items-start">
                                                    <img src="{{ $elearning->teacher->avatar }}" class="img-fluid"
                                                        alt="">
                                                    <a href="#"
                                                        class="trainer-link">{{ $elearning->teacher->name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>



        <!-- Trainers Index Section -->
        <section id="trainers-index" class="section trainers-index">
            <div class="container section-title" data-aos="fade-up">
                <h2>Teachers</h2>
                <p>Top Teachers</p>
            </div>
            <div class="container">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($teachers->take(5) as $teacher)
                            <div class="swiper-slide">
                                <div class="member shadow-sm"
                                    style="transition: transform 0.3s ease; min-height: 100px; border-radius: 10px; overflow: hidden;">
                                    <img src="{{ $teacher->avatar }}" class="img-fluid" alt=""
                                        style="border-radius: 10px 10px 0 0; height: 200px; object-fit: cover;">
                                    <div class="member-content p-3" style="flex: 1;">
                                        <h4>{{ $teacher->name }}</h4>
                                    </div>
                                </div>
                            </div><!-- End swiper-slide -->
                        @endforeach
                    </div>
                </div>
            </div>

        </section><!-- /Trainers Index Section -->

    </main>
@endsection

@push('scripts')
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            }
        });
    </script>
@endpush
