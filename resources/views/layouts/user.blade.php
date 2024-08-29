<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="description"
        content="
    System Management Inventory is a web-based application that is used to manage the inventory of goods in a company. This application is built using the Laravel 8 framework and the {{ config('app.name') }} CSS framework. This application is equipped with features that can help companies manage their goods inventory. This application is also equipped with a role-based access control system that can help companies manage their users. This application is also equipped with a feature to manage the purchase and sale of goods. This application is also equipped with a feature to manage the goods that have been entered into the warehouse. This application is also equipped with a feature to manage the goods that have been sold. This application is also equipped with a feature to manage the goods that have been purchased
    " />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/materialize') }}/assets/img/favicon/favicon.ico" />
    <link href="{{ asset('/mentor') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


    <!-- Vendor CSS Files -->
    <link href="{{ asset('/mentor') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/mentor') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/mentor') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('/mentor') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('/mentor') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="{{ asset('/mentor') }}/assets/css/main.css" rel="stylesheet">

    @stack('css')
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="{{ asset('/mentor') }}/assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Mentors</h1>
            </a>

            @include('_partials.navbar-home')

            <a class="btn-getstarted" href="{{ route('course') }}">Get Started</a>

        </div>
    </header>

    @yield('content')

    <footer id="footer" class="footer position-relative light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                        <span class="sitename">Mentor</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Mentor</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Codeplatery</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/mentor') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/mentor') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('/mentor') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('/mentor') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('/mentor') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('/mentor') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('/mentor') }}/assets/js/main.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
