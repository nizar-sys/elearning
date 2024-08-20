@extends('layouts.app')
@section('title', 'Create Video')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">
                    <span class="fw-normal">Add Video</span>
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

                    <form class="video pt-0" id="videoForm" method="POST" action="{{ route('videos.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Created By -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <select class="form-control @error('created_by') is-invalid @enderror"
                                        id="video-creator" name="created_by" aria-label="Creator">
                                        <option value="" disabled selected>Select Creator</option>
                                        @foreach ($creators as $creator)
                                            <option value="{{ $creator->id }}"
                                                {{ old('created_by') == $creator->id ? 'selected' : '' }}>
                                                {{ $creator->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="video-creator">Creator</label>
                                    @error('created_by')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="video-title" name="title" aria-label="Video Title" placeholder="Video Title"
                                        value="{{ old('title') }}" />
                                    <label for="video-title">Title</label>
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Description -->
                            <div class="col-sm-12">
                                <label for="video-description">Description</label>
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <textarea class="form-control @error('description') is-invalid @enderror full-editor" id="video-description"
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
                                <label for="video-thumbnail">Thumbnail</label>
                                <div class="form-floating form-floating-outline mb-5 mt-2 dropzone-box">
                                    <div id="dropzone-preview" class="mb-3"></div>
                                    <div class="dz-message needsclick">
                                        Drop files here or click here to upload
                                    </div>
                                    <input type="file" name="thumbnail" id="video-thumbnail" class="d-none" />
                                    @error('thumbnail')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Video URL & Categories -->
                            <div class="col-sm-12 col-md-6">

                                <div class="form-floating form-floating-outline mb-5 mt-5">
                                    <select id="category_id[]" class="select2 form-select" data-placeholder="All Categories"
                                        name="category_id[]" multiple>
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="video-category">Categories</label>
                                    @error('created_by')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating form-floating-outline mb-3 mt-5">
                                    <input type="url" class="form-control @error('video') is-invalid @enderror"
                                        id="video-url" name="video" aria-label="Video URL" placeholder="Video URL"
                                        value="{{ old('video') }}" />
                                    <label for="video-url">Video URL</label>
                                    @error('video')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                            <a href="{{ route('videos.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/console/videos/create_validation_script.js')
@endpush
