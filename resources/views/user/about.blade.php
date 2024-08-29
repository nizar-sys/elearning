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

        <!-- About Us Section -->
        <section id="about-us" class="section about-us">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <img src="assets/img/about-2.jpg" class="img-fluid" alt="" />
                    </div>

                    <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                        <h3>
                            Voluptatem dignissimos provident quasi corporis
                        </h3>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua.
                        </p>
                        <ul>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                <span>Ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                <span>Duis aute irure dolor in reprehenderit
                                    in voluptate velit.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                <span>Ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate trideta
                                    storacalaperda mastiro dolore eu fugiat
                                    nulla pariatur.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
