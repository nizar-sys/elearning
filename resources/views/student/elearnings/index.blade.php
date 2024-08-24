@extends('layouts.app')
@section('title', 'E-Learnings')

@push('styles')
    <style>
        .elearning-thumbnail {
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
                            Education, talents, and career<br />
                            opportunities. <span class="text-primary text-nowrap">All in one place</span>.
                        </span>
                        <p class="mb-4 px-0 px-md-2">
                            Grow your skill with the most reliable online Elearnings and certifications in<br />
                            marketing, information technology, programming, and data science.
                        </p>
                        <!-- Form for search and category filter -->
                        <form method="GET" action="{{ route('student.elearnings.index') }}" id="search-category-form"
                            class="d-flex">
                            <input type="search" name="search" value="{{ request('search') }}"
                                placeholder="Find your course" class="form-control form-control-sm me-4" />
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
                        <h5 class="mb-0">My Elearnings</h5>
                    </div>
                    <div class="d-flex justify-content-md-end align-items-center gap-6 flex-wrap">
                        <!-- Filter form for categories -->
                        <form method="GET" action="{{ route('student.elearnings.index') }}" id="category-filter-form">
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
                        @foreach ($elearnings as $elearning)
                            <div class="col-sm-6 col-lg-4">
                                <div class="card shadow-none border p-2 h-100 rounded-3">
                                    <div class="rounded-4 text-center mb-5">
                                        <a href="{{ route('student.elearnings.show', $elearning->slug) }}">
                                            <img class="img-fluid img-thumbnail elearning-thumbnail"
                                                src="{{ asset($elearning->thumbnail) }}" alt="{{ $elearning->title }}" />
                                        </a>
                                    </div>
                                    <div class="card-body p-3 pt-0">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            @foreach ($elearning->categories as $category)
                                                <span
                                                    class="badge rounded-pill bg-label-warning">{{ $category->name }}</span>
                                            @endforeach
                                            <p class="d-flex align-items-center justify-content-center gap-1 mb-0">
                                                {{ number_format($elearning->reviews?->avg('rating'), 1) }}
                                                <span class="text-warning">
                                                    <i class="ri-star-s-fill ri-24px me-1"></i>
                                                </span>
                                                <span class="fw-normal">({{ $elearning->reviews?->count() ?? 0 }})</span>
                                            </p>
                                        </div>
                                        <a class="h5"
                                            href="{{ route('student.elearnings.show', $elearning->slug) }}">{{ $elearning->title }}</a>
                                        <p class="mt-1">{!! \Illuminate\Support\Str::limit($elearning->description, 50) !!}</p>
                                        <a class="w-100 btn btn-outline-primary"
                                            href="{{ route('student.elearnings.show', $elearning->slug) }}">
                                            <i class="ri-refresh-line ri-16px me-2"></i>Start Over
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
                        {{ $elearnings->onEachSide(1)->appends(request()->query())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
