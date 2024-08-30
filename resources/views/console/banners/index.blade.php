@extends('layouts.app')
@section('title', 'Banner Management')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">
                    <span class="fw-normal">Banner Management</span>
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

                    <form class="banner pt-0" id="bannerForm" method="POST"
                        action="{{ route('banners.update', $banner ? $banner->id : 1) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- Thumbnail -->
                            <div class="col-sm-12 col-md-6 dropzone-upload">
                                <div class="form-floating form-floating-outline mb-5 mt-2 dropzone-box">
                                    <div id="dropzone-preview" class="mb-3">
                                    </div>
                                    <div class="dz-message needsclick">
                                        Drop files here or click here to upload
                                    </div>
                                    <input type="file" name="image" id="banner-image" class="d-none" />
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="banner-title" name="title" aria-label="Article Title"
                                        placeholder="Article Title"
                                        value="{{ old('title', $banner ? $banner->title : '') }}" />
                                    <label for="banner-title">Title</label>
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <!-- Description -->
                            <div class="col-sm-12">
                                <label for="banner-description">Description</label>
                                <div class="form-floating form-floating-outline mb-5 mt-2">
                                    <textarea class="form-control @error('description') is-invalid @enderror full-editor" id="banner-description"
                                        name="description" aria-label="Description" placeholder="Description" cols="30" rows="10">{{ old('description', $banner ? $banner->description : '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/console/banners/script.js')
    @if ($banner && $banner->image)
        <script>
            var existingFiles = @json(asset($banner->image));
        </script>
    @endif
@endpush
