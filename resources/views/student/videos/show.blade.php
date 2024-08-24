@extends('layouts.app')

@section('title', $video->title)

@push('styles')
    <style>
        .video-container {
            width: 100%;
            height: 500px;
            margin-bottom: 1rem;
            border-radius: 8px;
            overflow: hidden;
        }

        .related-video-thumbnail {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .related-video-title {
            display: inline-block;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Video Content -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="video-container">
                        <iframe width="100%" height="100%"
                            src="https://www.youtube.com/embed/{{ getYouTubeVideoId($video->video) }}"
                            title="{{ $video->title }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="card-body">
                        <h1 class="card-title">{{ $video->title }}</h1>

                        <div class="video-meta d-flex justify-content-between mb-4">
                            <span>By <strong>{{ $video->creator->name }}</strong></span>
                            <span>Published on {{ $video->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="card-text">
                            {!! $video->description !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Videos Section -->
            <div class="col-lg-4">
                @if ($relatedVideos->isNotEmpty())
                    <div class="card p-4">
                        <h5>Related Videos</h5>
                        <ul class="list-unstyled">
                            @foreach ($relatedVideos as $relatedVideo)
                                <li class="mb-2">
                                    <a href="{{ route('student.videos.show', $relatedVideo->slug) }}">
                                        <img class="related-video-thumbnail img-fluid mb-2"
                                            src="{{ asset($relatedVideo->thumbnail) }}" alt="{{ $relatedVideo->title }}">
                                        <span class="related-video-title">{{ $relatedVideo->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
