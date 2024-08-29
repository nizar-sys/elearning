@extends('layouts.user')
@section('title', 'Videos')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Video</h1>
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

        <section id="videos" class="videos section">
            <div class="container" data-aos="fade-up">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($videos as $video)
                            <div class="swiper-slide">
                                <div class="card mb-3" data-aos="zoom-in" data-aos-delay="100">
                                    <div class="card-img">
                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ getYouTubeVideoId($video->video) }}" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="#" class="video-title" data-bs-toggle="modal"
                                                data-bs-target="#videoModal" data-video-id="{{ $video->id }}"
                                                data-video-url="{{ $video->video }}"
                                                data-video-description="{{ $video->description }}">
                                                {{ $video->title }}
                                            </a>
                                        </h5>
                                        <p class="card-text">{!! \Illuminate\Support\Str::words(strip_tags($video->description), 20, '...') !!}</p>
                                        <small class="fst-italic text-start">
                                            {{ $video->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel">Video Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe width="100%" height="315" id="videoFrame" src="" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                        <p class="mt-3" id="videoDescription"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel">Video Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe width="100%" height="315" id="videoFrame" src="" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                        <p class="mt-3" id="videoDescription"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
            const getYouTubeVideoId = (url) => {
                const match = url.match(
                    /(?:youtu.be\/|v\/|embed\/|watch\?v=)([^#\&\?]*).*/
                );
                return match ? match[1] : null;
            };

            document.querySelectorAll('.video-title').forEach(function(element) {
                element.addEventListener('click', function() {
                    var videoUrl = this.getAttribute('data-video-url');
                    var videoDescription = this.getAttribute('data-video-description');
                    var videoTitle = this.innerText;

                    // Update modal content
                    document.getElementById('videoFrame').src = `https://www.youtube.com/embed/${getYouTubeVideoId(videoUrl)}`;
                    document.getElementById('videoDescription').innerHTML = videoDescription;
                    document.getElementById('videoModalLabel').innerText = videoTitle;

                    videoModal.show();
                });
            });
        });

        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush
