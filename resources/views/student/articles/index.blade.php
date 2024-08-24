@extends('layouts.app')

@section('title', 'Articles')

@push('styles')
    <style>
        .article-thumbnail {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-academy">
            <div class="card p-0 mb-6">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-6">
                    <div class="app-academy-md-25 card-body py-0 pt-6 ps-12">
                        <img src="{{ asset('/materialize/assets/img/illustrations/bulb-light.png') }}"
                            class="img-fluid app-academy-img-height scaleX-n1-rtl" alt="Bulb in hand"
                            data-app-light-img="illustrations/bulb-light.png" data-app-dark-img="illustrations/bulb-dark.png"
                            height="90" />
                    </div>
                    <div
                        class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center mb-6 py-6">
                        <span class="card-title mb-4 lh-lg px-md-12 h4 text-heading">
                            Explore our <span class="text-primary">Latest Articles</span>
                        </span>
                        <p class="mb-4 px-0 px-md-2">
                            Discover insights, trends, and resources across different categories including marketing,
                            technology,
                            and data science.
                        </p>
                        <!-- Form for search and category filter -->
                        <form method="GET" action="{{ route('student.articles.index') }}" id="search-category-form"
                            class="d-flex">
                            <input type="search" name="search" value="{{ request('search') }}"
                                placeholder="Find your article" class="form-control form-control-sm me-4" />
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
                    <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
                        <img src="{{ asset('/materialize/assets/img/illustrations/pencil-rocket.png') }}"
                            alt="pencil rocket" height="180" class="scaleX-n1-rtl" />
                    </div>
                </div>
            </div>

            <div class="card mb-6">
                <div class="card-header d-flex flex-wrap justify-content-between gap-4">
                    <div class="card-title mb-0 me-1">
                        <h5 class="mb-0">Articles</h5>
                    </div>
                    <div class="d-flex justify-content-md-end align-items-center gap-6 flex-wrap">
                        <!-- Filter form for categories -->
                        <form method="GET" action="{{ route('student.articles.index') }}" id="category-filter-form">
                            <select class="form-select form-select-sm w-px-250" name="category"
                                onchange="document.getElementById('category-filter-form').submit();">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}"
                                        {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <div class="card-body mt-1">
                    <div class="row gy-6 mb-6">
                        <!-- Loop over articles -->
                        @foreach ($articles as $article)
                            <div class="col-sm-6 col-lg-4">
                                <div class="card shadow-none border p-2 h-100 rounded-3">
                                    <div class="rounded-4 text-center mb-5">
                                        <a href="{{ route('student.articles.show', $article->slug) }}">
                                            <img class="img-fluid img-thumbnail article-thumbnail"
                                                src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}" />
                                        </a>
                                    </div>
                                    <div class="card-body p-3 pt-0">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <span
                                                class="badge rounded-pill bg-label-warning">{{ $article->category->name }}</span>
                                            <p class="d-flex align-items-center justify-content-center gap-1 mb-0">
                                                {{ $article->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <a class="h5" href="{{ route('student.articles.show', $article->slug) }}">
                                            {{ $article->title }}
                                        </a>
                                        <p class="mt-1">{!! \Illuminate\Support\Str::limit($article->content, 100) !!}</p>
                                        <a class="w-100 btn btn-outline-primary"
                                            href="{{ route('student.articles.show', $article->slug) }}">
                                            <i class="ri-bookmark-line ri-16px me-2"></i>Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
                        {{ $articles->onEachSide(1)->appends(request()->query())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
