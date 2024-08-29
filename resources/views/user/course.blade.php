@extends('layouts.user')
@section('title', 'Courses')

@section('content')
    <main class="main">
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Courses</h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Courses</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <section id="courses" class="courses section">
            <div class="container">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($elearnings as $elearning)
                            <div class="swiper-slide">
                                <div class="course-item shadow-sm"
                                    style="transition: transform 0.3s ease; cursor: pointer; overflow: hidden; border-radius: 10px;"
                                    onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                    <a href="{{ route('detail-course', ['courseId' => $elearning->id]) }}"
                                        class="stretched-link">
                                        <img src="{{ $elearning->thumbnail }}" class="img-fluid" alt="..."
                                            style="border-radius: 10px 10px 0 0;">
                                        <div class="course-content p-3">
                                            <h3>{{ $elearning->title }}</h3>
                                            <p class="description">
                                                {!! \Illuminate\Support\Str::words(strip_tags($elearning->description), 20, '...') !!}
                                            </p>
                                            <div class="trainer d-flex justify-content-between align-items-center">
                                                <div class="trainer-profile d-flex align-items-center">
                                                    <img src="{{ $elearning->teacher->avatar }}"
                                                        class="img-fluid rounded-circle" alt=""
                                                        style="width: 40px; height: 40px;">
                                                    <span class="trainer-link ml-2">{{ $elearning->teacher->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- End swiper-slide -->
                        @endforeach
                    </div><!-- End swiper-wrapper -->
                </div><!-- End swiper-container -->
            </div>
        </section>

    </main>
@endsection
@push('scripts')
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
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
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            }
        });
    </script>
@endpush
