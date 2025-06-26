@extends('front.layout.template')

@section('title', 'Blog - PaleoAtlas')

@section('content')
    <!-- Page header with logo and tagline-->
    <head>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <header class="py-5 bg-light border-bottom mb-4 animated-gradient-header" data-aos="fade-down">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Paleo Atlas Blog!</h1>
                <p class="lead mb-0">PaleoBlog adalah ruang digital yang menghidupkan kembali dunia purba melalui tulisan, ilustrasi, dan inspirasi dari penemuan fosil hingga kisah kehidupan masa lalu Bumi.</p>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                <div class="card mb-4 shadow-lg featured-card" data-aos="fade-up">
                    <a href="{{ url('p/'.$latest_post->slug) }}">
                        <img class="card-img-top featured-img img-hover" src="{{ asset('storage/back/'.$latest_post->img) }}" alt="..." />
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="small text-muted">
                                <i class="bi bi-calendar"></i> {{ $latest_post->created_at->format('d M Y') }}
                                <span class="mx-2">·</span>
                                <span class="text-secondary"><i class="bi bi-clock"></i> {{ ceil(str_word_count(strip_tags($latest_post->desc))/200) }} min read
                                </span>
                            </div>
                            <a href="{{ url('category/'.$latest_post->Category->slug) }}" class="category-badge">
                                <i class="bi bi-tag"></i> {{ $latest_post->Category->name }}
                            </a>
                        </div>
                        <h2 class="card-title">{{ $latest_post->title }}</h2>
                        <p class="card-text">{{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($latest_post->desc)), 200, '...') }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="small text-muted">
                            <i class="bi bi-person"></i> {{ $latest_post->user->name }}
                            <span class="mx-2">·</span>
                            <i class="bi bi-chat-dots"></i> {{ $latest_post->comments_count ?? 0 }} comments
                        </div>
                        <a class="btn btn-outline-primary btn-sm" href="{{ url('p/'.$latest_post->slug) }}">Read more →</a>
                    </div>
                </div>

                </div>
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    @foreach($articles as $item)
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                        <!-- Blog post-->
                        <div class="card mb-4 shadow-sm blog-card">
                            <a href="{{ url('p/'.$item->slug) }}">
                                <img class="card-img-top post-img img-hover" src="{{ asset('storage/back/'.$item->img) }}" alt="..." />
                            </a>
                            <div class="card-body card-height">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="small text-muted">
                                        <i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}
                                        <span class="mx-2">·</span>
                                        <span class="text-secondary"><i class="bi bi-clock"></i> {{ ceil(str_word_count(strip_tags($item->desc))/200) }} min read</span>
                                    </div>
                                    <a href="{{ url('category/'.$item->Category->slug) }}" class="category-badge">
                                        <i class="bi bi-tag"></i> {{ $item->Category->name }}
                                    </a>
                                </div>
                                <h2 class="card-title h5">{{ $item->title }}</h2>
                                <p class="card-text">{{ Str::limit(strip_tags($item->desc), 120, '...') }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="small text-muted">
                                        <i class="bi bi-person"></i> {{ $item->user->name }}
                                        <span class="mx-2">·</span>
                                        <i class="bi bi-chat-dots"></i> {{ $item->comments_count ?? 0 }} comments
                                    </div>
                                    <a class="btn btn-outline-primary btn-sm" href="{{ url('p/'.$item->slug) }}">Read more →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagination-->
                <div class="pagination justify-content-center my-4" data-aos="fade-up" data-aos-delay="200">
                    {{ $articles->links() }}
                </div>
            </div>
            <!-- Side widgets-->
            @include('front.layout.side-widget')
        </div>
    </div>
@endsection