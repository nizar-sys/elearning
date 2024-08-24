@extends('layouts.app')

@section('title', $article->title)

@push('styles')
    <style>
        .article-thumbnail {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .article-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .sidebar-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .sidebar-card h5 {
            font-weight: 600;
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Article Content -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <img class="article-thumbnail img-fluid rounded-top" src="{{ asset($article->thumbnail) }}"
                        alt="{{ $article->title }}">

                    <div class="card-body">
                        <h1 class="card-title">{{ $article->title }}</h1>

                        <div class="article-meta d-flex justify-content-between mb-4">
                            <span>By <strong>{{ $article->creator->name }}</strong></span>
                            <span>Published on {{ $article->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="card-text">
                            {!! $article->content !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section (Author, Category, Published Date) -->
            <div class="col-lg-4">
                <div class="card sidebar-card p-4 mb-4">
                    <h5>Article Details</h5>
                    <p><strong>Category:</strong> {{ $article->category->name }}</p>
                    <p><strong>Author:</strong> {{ $article->creator->name }}</p>
                    <p><strong>Published on:</strong> {{ $article->created_at->format('M d, Y') }}</p>
                </div>

                <!-- Optional: Latest Articles or Related Articles Section -->
                <div class="card sidebar-card p-4">
                    <h5>Related Articles</h5>
                    <ul class="list-unstyled">
                        @foreach ($relatedArticles as $relatedArticle)
                            <li class="mb-2">
                                <a href="{{ route('student.articles.show', $relatedArticle->slug) }}">
                                    {{ $relatedArticle->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
