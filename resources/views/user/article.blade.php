@extends('layouts.user')
@section('title', 'Articles')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Articles</h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="current">Events</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <section id="events" class="events section">
            <div class="container" data-aos="fade-up">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($articles as $article)
                            <div class="swiper-slide">
                                <a href="{{ route('detail-article', ['articleId' => $article->id]) }}"
                                    class="text-decoration-none">
                                    <div class="card mb-3 h-100">
                                        <div
                                            style="overflow: hidden; border-top-left-radius: .25rem; border-top-right-radius: .25rem;">
                                            <img class="card-img-top img-fluid" src="{{ $article->thumbnail }}"
                                                alt="Card image cap" style="object-fit: cover; width: 100%; height: 200px;">
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $article->title }}</h5>
                                            <p class="card-text">{!! \Illuminate\Support\Str::words(strip_tags($article->content), 20, '...') !!}</p>
                                            <p class="card-text mt-auto">
                                                <small class="text-muted">Last updated
                                                    {{ $article->updated_at->diffForHumans() }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection
@push('scripts')
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
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
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
            },
        });
    </script>
@endpush
