@extends('front.layout.template')

@section('title', 'PaleoBlog - Home')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('front/css/home.css') }}">
@endpush

@section('content')
  <!-- Hero Section with Video Background -->
  <section class="hero" data-aos="fade-up" data-aos-duration="1200">
    <video autoplay muted loop id="heroVideo">
      <source src="{{ asset('front/assets/video/paleo.mp4') }}" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <div class="overlay"></div>
    <div class="hero-content text-center text-white">
      <h1 class="display-3 fw-bold">Selamat Datang di PaleoBlog!</h1>
      <p class="lead">Selami Dunia Prasejarah yang Penuh Keajaiban dan Temukan Kisah-Kisah Purba yang Menakjubkan.</p>
      <a href="#artikel" class="btn btn-outline-light mt-3">Jelajahi Lebih Lanjut</a>
    </div>
  </section>

  <!-- Artikel Terbaru -->
    <section id="artikel" class="py-5 bg-light">
  <div class="container text-center" data-aos="fade-up" data-aos-duration="1200">
    <h2 class="mb-4">Artikel Terbaru</h2>
    <div class="row g-4">
      @foreach($latest_articles as $article)
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="card h-100">
                <a href="{{ url('p/'.$article->slug) }}">
                    <img class="card-img-top featured-img img-hover" src="{{ asset('storage/back/'.$article->img) }}" alt="..." />
                </a>
                <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($article->desc), 80) }}</p>
                <a href="{{ url('p/'.$article->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
            </div>
        @endforeach
        </div>
    </div>
    </section>

  <!-- Fakta Menarik -->
  <section class="py-5 bg-dark text-white text-center" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
      <h2 class="mb-4">Tahukah Kamu?</h2>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="p-4 bg-secondary rounded">
            @if($knowledge)
              <p class="fs-5 mb-2">
                {{ $knowledge->content }}
              </p>
            @else
              <p class="fs-5 mb-0">Belum ada fakta menarik.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@stack('js')