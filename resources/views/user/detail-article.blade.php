@extends('layouts.user')
@section('title', 'Detail Articles')

@push('css')
    <style>
        .article-detail {
            padding: 60px 0;
        }

        .article-header {
            margin-bottom: 30px;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }

        .article-date {
            font-size: 1rem;
            color: #777;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
        }

        .article-body {
            line-height: 1.6;
            color: #555;
        }

        .sidebar {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            overflow-y: auto;
            max-height: 400px;
        }

        .sidebar-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .related-article-link {
            color: #8B93FF;
            text-decoration: none;
        }

        .related-article-link:hover {
            text-decoration: underline;
        }

        .related-article-link {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        .related-article-link:hover {
            background-color: #8B93FF;
            color: #fff;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-decoration: none;
        }

        .list-group-item {
            padding: 0;
            margin: 0;
        }
    </style>
@endpush

@section('content')
    <main class="main">
        <section id="article-detail" class="article-detail section">
            <div class="container">
                <!-- Article Header -->
                <div class="article-header text-center">
                    <h1 class="article-title">{{ $article->title }}</h1>
                    <p class="article-date">{{ $article->created_at->format('F j, Y') }}</p>
                </div>

                <!-- Article Content -->
                <div class="row mt-5">
                    <div class="col-lg-8">
                        <div class="article-content" data-aos="fade-up">
                            <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="img-fluid rounded mb-4">
                            <div class="article-body">
                                {!! $article->content !!}
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="sidebar mt-5">
                            <h3 class="sidebar-title text-center" data-aos="fade-left">Related Articles</h3>
                            <ul class="list-group list-group-flush">
                                @foreach ($relatedArticles as $related)
                                    <li class="list-group-item">
                                        <a href="{{ route('detail-article', ['articleId' => $related->id]) }}"
                                            class="related-article-link">
                                            {{ $related->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
