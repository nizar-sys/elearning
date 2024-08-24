@extends('layouts.app')
@section('title', 'My Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Welcome Message -->
        <div class="card bg-transparent shadow-none border-0 mb-6">
            <div class="card-body row g-6 p-0 pb-5">
                <div class="col-12 col-md-8">
                    <h5 class="mb-2">Welcome back,<span class="h4 fw-semibold"> {{ Auth::user()->name }} 👋🏻</span></h5>
                    <p>Your progress this week is impressive. Continue the great work and earn more rewards!</p>
                </div>
            </div>
        </div>

        <!-- Monitoring Widgets -->
        <div class="row mb-6">
            <!-- Elearnings -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded-3 bg-label-primary">
                                    <i class="ri-book-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $totalElearnings }}</h4>
                        </div>
                        <h6 class="mb-0 fw-normal">Total Elearnings</h6>
                    </div>
                </div>
            </div>

            <!-- Videos -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded-3 bg-label-warning">
                                    <i class="ri-video-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $totalVideos }}</h4>
                        </div>
                        <h6 class="mb-0 fw-normal">Total Videos</h6>
                    </div>
                </div>
            </div>

            <!-- Articles -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded-3 bg-label-danger">
                                    <i class="ri-file-list-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $totalArticles }}</h4>
                        </div>
                        <h6 class="mb-0 fw-normal">Total Articles</h6>
                    </div>
                </div>
            </div>

            <!-- Materials -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded-3 bg-label-info">
                                    <i class="ri-folder-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $totalMaterials }}</h4>
                        </div>
                        <h6 class="mb-0 fw-normal">Total Materials</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Elearnings -->
        <div class="row mb-6 g-6">
            <div class="col-12 col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Latest Elearnings</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach ($latestCourses as $course)
                                <li class="d-flex mb-7">
                                    <div class="avatar flex-shrink-0 me-4">
                                        <span class="avatar-initial rounded-3 bg-label-primary"><i
                                                class="ri-vidicon-line ri-24px"></i></span>
                                    </div>
                                    <div class="d-sm-flex w-100 align-items-center">
                                        <div class="w-100 mb-2 mb-sm-0 me-sm-4">
                                            <h6 class="mb-0">{{ $course->title }}</h6>
                                        </div>
                                        <div class="badge bg-label-secondary rounded-pill">{{ $course->views ?? 0 }} Views</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Popular Instructors -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Popular Instructors</h5>
                    </div>
                    <div class="px-5 py-4 border border-start-0 border-end-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fs-xsmall text-uppercase fw-normal">Instructors</h6>
                            <h6 class="mb-0 fs-xsmall text-uppercase fw-normal">Courses</h6>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        @foreach ($popularInstructors as $instructor)
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar me-4">
                                        <img src="{{ $instructor->avatar_url }}" alt="Avatar" class="rounded-circle" />
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-truncate">{{ $instructor->name }}</h6>
                                        <small class="text-truncate">{{ $instructor->roles?->first()?->name??'alomani' }}</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">{{ $instructor->elearnings_count ?? 0 }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
