@extends('layouts.user')
@section('title', 'About Us')

@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>About Us<br /></h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">About Us<br /></li>
                    </ol>
                </div>
            </nav>
        </div>
        <!-- End Page Title -->

        @if ($about)
            <!-- About Us Section -->
            <section id="about-us" class="section about-us">
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ asset($about->image) }}" class="img-fluid" alt="" />
                        </div>

                        <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                            <h3>
                                {{ $about->title }}
                            </h3>
                            <div class="fst-italic">
                                {!! $about->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
