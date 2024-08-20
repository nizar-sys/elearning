@extends('layouts.app')
@section('title', 'Reviews')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Filters</h5>
                <div class="d-flex justify-content-start align-items-center row gx-5 pt-4 gap-5 gap-md-0">
                    <div class="col-md-4 elearning_id_filter">
                        <select id="elearning_id_filter" class="form-select" data-filter="elearning_id" name="elearning_id_filter">
                            <option value="">All Elearnings</option>
                            @foreach ($elearnings as $elearning)
                                <option value="{{ $elearning->id }}">{{ $elearning->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 reviewer_id_filter">
                        <select id="reviewer_id_filter" class="form-select" data-filter="reviewer_id"
                            name="reviewer_id_filter">
                            <option value="">All Reviewers</option>
                            @foreach ($reviewers as $reviewer)
                                <option value="{{ $reviewer->id }}">{{ $reviewer->name }}</option>
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
        var urlDelete = "{{ route('reviews.destroy', ':id') }}";
    </script>
    @vite('resources/js/console/reviews/script.js')
@endpush
