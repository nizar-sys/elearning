@extends('layouts.app')
@section('title', 'Articles')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Filters</h5>
                <div class="d-flex justify-content-between align-items-center row gx-5 pt-4 gap-5 gap-md-0">
                    <div class="col-md-4 category_id_filter">
                        <select id="category_id_filter" class="form-select" data-filter="category_id" name="category_id_filter">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 created_by_filter">
                        <select id="created_by_filter" class="form-select" data-filter="created_by"
                            name="created_by_filter">
                            <option value="">All Creators</option>
                            @foreach ($creators as $creator)
                                <option value="{{ $creator->id }}">{{ $creator->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 status_filter">
                        <select id="status_filter" class="form-select" data-filter="status" name="status_filter">
                            <option value="">All Status</option>
                            @foreach ($articleStatus as $status)
                                <option value="{{ $status }}">
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-datatable table-responsive">
                {{ $dataTable->table(['class' => 'datatables-permissions table']) }}
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        var urlDelete = "{{ route('articles.destroy', ':id') }}";
    </script>
    @vite('resources/js/console/articles/script.js')
@endpush
