@extends('front.layout.template')

@section('title', 'Articles - PaleoAtlas')

@section('content')
    <div class="container py-4">
        <div class="mb-4 " data-aos="fade-down">
            <form action="{{ url('/articles') }}" method="get" role="search" aria-label="Search articles" class="flex-grow-1 me-3">
                <div class="input-group">
                    <input class="form-control rounded-start-pill" type="text" name="keyword" placeholder="Search articles..." value="{{ old('keyword', $keyword ?? '') }}" aria-label="Search articles" />
                    <a href="{{ url('/articles') }}" class="btn btn-outline-secondary" title="Reset search">Reset</a>
                    <button class="btn btn-primary rounded-end-pill" id="button-search" type="submit" aria-label="Submit search">Search</button>
                </div>
            </form>
        </div>
        @if (!empty($keyword))
            <div class="alert alert-info py-2">
                Showing <b>{{ $articles->total() }}</b> articles with keyword: <b>{{ $keyword }}</b>
            </div>
        @endif
        <div class="row">
            @forelse ($articles as $item)
                <div class="col-lg-4 col-md-6 col-12 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="overflow-hidden">
                            <a href="{{ url('p/'.$item->slug) }}">
                                <img 
                                    class="card-img-top post-img rounded-4 img-fluid transition"
                                    src="{{ $item->img ? asset('storage/back/'.$item->img) : asset('images/no-image.png') }}"
                                    alt="{{ $item->title }}"
                                    style="object-fit:cover; max-height:220px; width:100%; transition:transform 0.3s;"
                                    onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'"
                                />
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="small text-muted mb-2">
                                {{ $item->created_at->format('d M Y') }}
                                <span class="mx-1">|</span>
                                <a href="{{ url('category/'.$item->Category->slug) }}" class="text-decoration-none text-primary">
                                    {{ $item->Category->name }}
                                </a>
                                <span class="mx-1">|</span>
                                <i class="bi bi-person"></i> {{ $item->user->name }}
                            </div>
                            <h2 class="card-title h5 mb-2">
                                <a href="{{ url('p/'.$item->slug) }}" class="text-decoration-none text-dark">{{ $item->title }}</a>
                            </h2>
                            <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($item->desc), 120, '...') }}</p>
                            <a class="btn btn-sm btn-outline-primary mt-auto" href="{{ url('p/'.$item->slug) }}">Read more →</a>
                        </div>
                    </div>
                </div>
            @empty
                <h3>Not Found</h3>
            @endforelse
        </div>
        <div class="pagination justify-content-center my-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
