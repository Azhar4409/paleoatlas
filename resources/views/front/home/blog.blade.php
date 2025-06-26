@extends('front.layout.template')

@section('title', 'Blog - PaleoAtlas')

@section('content')
    <header class="py-5 bg-light border-bottom mb-4 animated-gradient-header" data-aos="fade-down">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Paleo Atlas Blog!</h1>
                <p class="lead mb-0">PaleoBlog adalah ruang digital yang menghidupkan kembali dunia purba melalui tulisan, ilustrasi, dan inspirasi dari penemuan fosil hingga kisah kehidupan masa lalu Bumi.</p>
            </div>
        </div>
    </header>

    <div class="container py-4">
        <div class="row">
            <!-- Blog entries area -->
            <div class="col-lg-8">
                <!-- Featured blog post in article style -->
                <div class="card h-100 shadow-sm border-0 mb-5" data-aos="fade-up">
                    <div class="overflow-hidden">
                        <a href="{{ url('p/'.$latest_post->slug) }}">
                            <img 
                                class="card-img-top rounded-4 img-hover img-fluid"
                                src="{{ asset('storage/back/'.$latest_post->img) }}"
                                alt="{{ $latest_post->title }}"
                                style="object-fit:cover; max-height:220px; width:100%; transition:transform 0.3s;"
                                onmouseover="this.style.transform='scale(1.05)'"
                                onmouseout="this.style.transform='scale(1)'"
                            />
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="small text-muted mb-2">
                            {{ $latest_post->created_at->format('d M Y') }}
                            <span class="mx-1">|</span>
                            <a href="{{ url('category/'.$latest_post->Category->slug) }}" class="text-decoration-none text-primary">
                                {{ $latest_post->Category->name }}
                            </a>
                            <span class="mx-1">|</span>
                            <i class="bi bi-person"></i> {{ $latest_post->user->name }}
                        </div>
                        <h2 class="card-title h5 mb-2">
                            <a href="{{ url('p/'.$latest_post->slug) }}" class="text-decoration-none text-dark">{{ $latest_post->title }}</a>
                        </h2>
                        <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($latest_post->desc), 120, '...') }}</p>
                        <a class="btn btn-sm btn-outline-primary mt-auto" href="{{ url('p/'.$latest_post->slug) }}">Read more →</a>
                    </div>
                </div>

                <!-- Grid of other blog posts -->
                <div class="row">
                    @foreach($articles as $item)
                        <div class="col-lg-6 col-md-6 col-12 mb-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="card h-100 shadow-sm blog-card border-0">
                                <div class="overflow-hidden">
                                    <a href="{{ url('p/'.$item->slug) }}">
                                        <img class="card-img-top post-img rounded-top img-hover" src="{{ asset('storage/back/'.$item->img) }}" alt="{{ $item->title }}" style="max-height: 220px; object-fit: cover; width: 100%;">
                                    </a>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="small text-muted">
                                            <i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}
                                            <span class="mx-2">·</span>
                                            <i class="bi bi-clock"></i> {{ ceil(str_word_count(strip_tags($item->desc))/200) }} min read
                                        </div>
                                        <a href="{{ url('category/'.$item->Category->slug) }}" class="category-badge">
                                            <i class="bi bi-tag"></i> {{ $item->Category->name }}
                                        </a>
                                    </div>
                                    <h2 class="card-title h6">
                                        <a href="{{ url('p/'.$item->slug) }}" class="text-decoration-none text-dark">{{ $item->title }}</a>
                                    </h2>
                                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($item->desc), 120, '...') }}</p>
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

                <!-- Pagination -->
                <div class="pagination justify-content-center my-4" data-aos="fade-up" data-aos-delay="200">
                    {{ $articles->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            @include('front.layout.side-widget')
        </div>
    </div>
@endsection