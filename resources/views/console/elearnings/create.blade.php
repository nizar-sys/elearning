@extends('layouts.app')
@section('title', 'Create Elearning')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">
                    <span class="fw-normal">Add Elearning</span>
                </h5>
            </div>

            <div class="card-body">
                <div class="offcanvas-body mx-0 flex-grow-0 h-100 mt-2">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <h4 class="alert-heading d-flex align-items-center">
                                <span class="alert-icon rounded">
                                    <i class="ri-error-warning-line ri-22px"></i>
                                </span>
                                Something went wrong!
                            </h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="elearning pt-0" id="elearningForm" method="POST" action="{{ route('elearnings.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Teacher -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <select class="form-control @error('teacher_id') is-invalid @enderror"
                                        id="elearning-teacher" name="teacher_id" aria-label="Teacher">
                                        <option value="" disabled selected>Select Teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="elearning-teacher">Teacher</label>
                                    @error('teacher_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Benefit -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <select class="form-control @error('benefit_id') is-invalid @enderror"
                                        id="elearning-benefit" name="benefit_id" aria-label="Benefit">
                                        <option value="" disabled selected>Select Benefit</option>
                                        @foreach ($benefits as $benefit)
                                            <option value="{{ $benefit->id }}"
                                                {{ old('benefit_id') == $benefit->id ? 'selected' : '' }}>
                                                {{ $benefit->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="elearning-benefit">Benefit</label>
                                    @error('benefit_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Title -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="elearning-title" name="title" aria-label="Title" placeholder="Title"
                                        value="{{ old('title') }}" />
                                    <label for="elearning-title">Title</label>
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Duration -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                        id="elearning-duration" name="duration" aria-label="Duration"
                                        placeholder="Duration (e.g. 1h 30m)" value="{{ old('duration') }}" />
                                    <label for="elearning-duration">Duration</label>
                                    @error('duration')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Description -->
                            <div class="col-sm-12">
                                <label for="elearning-description">Description</label>
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <textarea class="form-control @error('description') is-invalid @enderror full-editor" id="elearning-description"
                                        name="description" aria-label="Description" placeholder="Description" cols="30" rows="10">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Thumbnail -->
                            <div class="col-sm-12 col-md-6 dropzone-upload">
                                <label for="elearning-thumbnail">Thumbnail</label>
                                <div class="form-floating form-floating-outline mb-5 mt-2 dropzone-box">
                                    <div id="dropzone-preview" class="mb-3"></div>
                                    <div class="dz-message needsclick">
                                        Drop files here or click here to upload
                                    </div>
                                    <input type="file" name="thumbnail" id="elearning-thumbnail" class="d-none" />
                                    @error('thumbnail')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-sm-12 col-md-6">

                                {{-- material --}}
                                <div class="form-floating form-floating-outline mb-5 mt-5">
                                    <select id="material_id[]" class="select2 form-select" data-placeholder="All Materials"
                                        name="material_id[]" multiple>
                                        <option value="">All Materials</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->title }}</option>
                                        @endforeach
                                    </select>
                                    <label for="elearning-material">Materials</label>
                                    @error('created_by')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- category --}}
                                <div class="form-floating form-floating-outline mb-5 mt-5">
                                    <select id="category_id[]" class="select2 form-select" data-placeholder="All Categories"
                                        name="category_id[]" multiple>
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="elearning-category">Categories</label>
                                    @error('created_by')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating form-floating-outline mb-5 mt-3">
                                    <select class="form-control @error('status') is-invalid @enderror" id="elearning-status"
                                        name="status" aria-label="Status">
                                        <option value="" disabled selected>Select Status</option>
                                        @foreach ($elearningStatus as $status)
                                            <option value="{{ $status }}"
                                                {{ old('status') == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="elearning-status">Status</label>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                            <a href="{{ route('elearnings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/console/elearnings/create_validation_script.js')
@endpush
