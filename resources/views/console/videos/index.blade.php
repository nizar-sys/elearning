@extends('layouts.app')
@section('title', 'Videos')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Filters</h5>
                <div class="d-flex justify-content-between align-items-center row gx-5 pt-4 gap-5 gap-md-0">
                    <div class="col-md-6 category_id_filter">
                        <select id="category_id_filter" class="select2 form-select" data-placeholder="All Categories"
                            name="category_id_filter" multiple>
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (Auth::user()->hasRole('Administrator'))
                        <div class="col-md-6 created_by_filter">
                            <select id="created_by_filter" class="form-select" data-filter="created_by"
                                name="created_by_filter">
                                <option value="">All Creators</option>
                                @foreach ($creators as $creator)
                                    <option value="{{ $creator->id }}">{{ $creator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
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
        var urlDelete = "{{ route('videos.destroy', ':id') }}";
    </script>
    @vite('resources/js/console/videos/script.js')
@endpush
