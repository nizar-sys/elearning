@extends('layouts.user')
@section('title', 'About Us')

@section('content')
    <main class="main">
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Tutors</h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Trainers</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Trainers Section -->
        <section id="trainers" class="section trainers">
            <div class="container">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($teachers as $teacher)
                            <div class="swiper-slide d-flex align-items-center justify-content-center">
                                <div class="member shadow-sm"
                                    style="transition: transform 0.3s ease; border-radius: 10px; overflow: hidden;"
                                    onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                    <div class="member-img">
                                        <img src="{{ $teacher->avatar }}" class="img-fluid" alt=""
                                            style="border-radius: 10px;">
                                    </div>
                                    <div class="member-info text-center p-3">
                                        <h4>{{ $teacher->name }}</h4>
                                    </div>
                                </div>
                            </div><!-- End swiper-slide -->
                        @endforeach
                    </div><!-- End swiper-wrapper -->
                </div><!-- End swiper-container -->
            </div>
        </section><!-- End Trainers Section -->

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
