@extends('layouts.app')
@section('title', 'Elearnings')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Filters</h5>
                <div class="d-flex justify-content-start align-items-center row gx-5 pt-4 gap-5 gap-md-0">
                    @if (Auth::user()->hasRole('Administrator'))
                        <div class="col-md-4 teacher_id_filter">
                            <select id="teacher_id_filter" class="form-select" data-filter="teacher_id"
                                name="teacher_id_filter">
                                <option value="">All Teachers</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-md-4 benefit_id_filter">
                        <select id="benefit_id_filter" class="form-select" data-filter="benefit_id"
                            name="benefit_id_filter">
                            <option value="">All Benefits</option>
                            @foreach ($benefits as $benefit)
                                <option value="{{ $benefit->id }}">{{ $benefit->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 status_filter">
                        <select id="status_filter" class="form-select" data-filter="status" name="status_filter">
                            <option value="">All Status</option>
                            @foreach ($elearningStatus as $status)
                                <option value="{{ $status }}">
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-start align-items-center row gx-5 pt-4 gap-5 gap-md-0">
                    <div class="col-md-4 category_id_filter">
                        <select id="category_id_filter" class="select2 form-select" data-placeholder="All Categories"
                            name="category_id_filter" multiple>
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 material_id_filter">
                        <select id="material_id_filter" class="select2 form-select" data-placeholder="All Materials"
                            name="material_id_filter" multiple>
                            <option value="">All Materials</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->title }}</option>
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
        var urlDelete = "{{ route('elearnings.destroy', ':id') }}";
    </script>
    @vite('resources/js/console/elearnings/script.js')
@endpush
