@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Stats Overview -->
        <div class="row mb-4">
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
                            <h4 class="mb-0">{{ $totals['totalElearnings'] }}</h4>
                        </div>
                        <h6 class="mb-0 fw-normal">Total Elearnings</h6>
                    </div>
                </div>
            </div>

            <!-- Users -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded-3 bg-label-warning">
                                    <i class="ri-user-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $totals['totalUsers'] }}</h4>
                        </div>
                        <h6 class="mb-0 fw-normal">Total Users</h6>
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
                            <h4 class="mb-0">{{ $totals['totalArticles'] }}</h4>
                        </div>
                        <h6 class="mb-0 fw-normal">Total Articles</h6>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded-3 bg-label-info">
                                    <i class="ri-star-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $totals['totalReviews'] }}</h4>
                        </div>
                        <h6 class="mb-0 fw-normal">Total Reviews</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Elearnings -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Recent Elearnings</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Teacher</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentElearnings as $elearning)
                                    <tr>
                                        <td>{{ $elearning->title }}</td>
                                        <td>{{ $elearning->teacher->name }}</td>
                                        <td>{{ $elearning->duration }}</td>
                                        <td>{{ ucfirst($elearning->status) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Latest Reviews -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Latest Reviews</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($latestReviews as $review)
                            <li class="list-group-item">
                                <p class="mb-0">
                                    <strong>{{ $review->reviewer->name }}</strong> reviewed
                                    <strong>{{ $review->elearning->title }}</strong>
                                </p>
                                <p class="text-muted mb-0">Rating: {{ $review->rating }}/5</p>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Data Overview</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const datachart = @json(array_values($totals));
    </script>
    @vite('resources/js/dashboard.js')
@endpush
