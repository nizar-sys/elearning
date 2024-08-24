@extends('layouts.app')

@section('title', 'Videos')

@push('styles')
    <style>
        .video-thumbnail {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-videos">
            <div class="card p-0 mb-6">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-6">
                    <div
                        class="app-videos-md-50 card-body d-flex align-items-md-center flex-column text-md-center mb-6 py-6">
                        <span class="card-title mb-4 lh-lg px-md-12 h4 text-heading">
                            Explore Our Video Collection<br />
                            <span class="text-primary text-nowrap">Learn Anytime, Anywhere</span>.
                        </span>

                        <!-- Search and Category Filter Form -->
                        <form method="GET" action="{{ route('student.videos.index') }}" id="search-category-form" class="d-flex">
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search videos"
                                class="form-control form-control-sm me-4" />
                            <select class="form-select form-select-sm me-4" name="category"
                                onchange="document.getElementById('search-category-form').submit();">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}"
                                        {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-icon">
                                <i class="ri-search-line ri-22px"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card mb-6">
                <div class="card-body mt-1">
                    <div class="row gy-6 mb-6">
                        @foreach ($videos as $video)
                            <div class="col-sm-6 col-lg-4">
                                <div class="card shadow-none border p-2 h-100 rounded-3">
                                    <div class="rounded-4 text-center mb-5">
                                        <a href="{{ route('student.videos.show', $video->slug) }}">
                                            <img class="img-fluid img-thumbnail video-thumbnail"
                                                src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}" />
                                        </a>
                                    </div>
                                    <div class="card-body p-3 pt-0">
                                        <a class="h5" href="{{ route('student.videos.show', $video->slug) }}">
                                            {{ $video->title }}
                                        </a>
                                        <p class="mt-1">
                                            {!! \Illuminate\Support\Str::limit($video->description, 50) !!}
                                        </p>
                                        <a class="w-100 btn btn-outline-primary"
                                            href="{{ route('student.videos.show', $video->slug) }}">
                                            <i class="ri-play-circle-line ri-16px me-2"></i> Watch Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
                        {{ $videos->onEachSide(1)->appends(request()->query())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
