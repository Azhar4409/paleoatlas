@extends('front.layout.template')

@section('title', 'About - PaleoAtlas')

@push('css')
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/about.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="hero-about" data-aos="fade-right" data-aos-duration="800">
  <h1 class="display-4 fw-bold">Jejak yang Terlupakan</h1>
  <p class="lead">Ikuti petualangan kami menelusuri miliaran tahun sejarah planet kita</p>
  <a href="#tentang" class="btn btn-light mt-3">Pelajari Lebih Lanjut</a>
</section>

<section id="tentang" class="py-5 bg-dark">
  <h2 class="section-title text-center text-white" data-aos="fade-down">Di Balik Layar PaleoBlog</h2>
  <p class="text-center text-white-50" data-aos="fade-down" data-aos-delay="100">PaleoBlog adalah ruang digital yang menghidupkan kembali dunia purba melalui tulisan, ilustrasi, dan inspirasi dari penemuan fosil hingga kisah kehidupan masa lalu Bumi.</p>

  <div class="container d-flex justify-content-center align-items-stretch mt-4">
    <div class="card bg-secondary text-white m-2 equal-card" data-aos="fade-left" data-aos-duration="800" style="max-width: 500px;">
      <div class="card-body d-flex flex-column h-100">
        <h3 class="card-title mt-1 section-title text-white">Misi Kami:</h3>
        <ul class="list-unstyled flex-grow-1">
          <li><span class="feature-icon">🧠</span> Meningkatkan kesadaran publik tentang sejarah kehidupan di Bumi.</li>
          <li><span class="feature-icon">📚</span> Menyediakan sumber informasi yang edukatif dan terpercaya.</li>
          <li><span class="feature-icon">🔍</span> Menginspirasi generasi muda untuk mengeksplorasi paleontologi.</li>
        </ul>
      </div>
    </div>
    <div class="card bg-secondary text-white m-2 equal-card" data-aos="fade-right" data-aos-duration="1000" style="max-width: 500px;">
      <div class="card-body d-flex flex-column h-100">
        <h3 class="card-title mt-1 section-title text-white">Jelajahi:</h3>
        <ul class="list-unstyled flex-grow-1">
          <li><span class="feature-icon">🦖</span> Artikel tentang Dinosaurus</li>
          <li><span class="feature-icon">🦴</span> Penemuan Fosil Terbaru</li>
          <li><span class="feature-icon">🎬</span> Rekomendasi Film & Buku</li>
          <li><span class="feature-icon">🌋</span> Visualisasi Lanskap Prasejarah</li>
        </ul>
      </div>
    </div>
  </div>
</section>


<section class="py-5 bg-white">
  <div class="container">
    <h2 class="section-title text-center mb-4">Tim di Balik PaleoBlog</h2>
    <div class="row text-center">
      <div class="col-md-4" data-aos="fade-up">
        <img src="{{ asset('front/assets/img/pelajar.png') }}" alt="Harrys" class="rounded-circle mb-3 team-profile-image">
        <h5>Harrys</h5>
        <p class="text-muted">Front-End Dev</p>
        <div class="d-flex justify-content-center gap-2">
          <a href="https://www.instagram.com/_rtzznotfound/" target="_blank" class="text-secondary" title="Instagram">
            <i class="bi bi-instagram sosmed-icon"></i>
          </a>
          <a href="https://www.youtube.com/@RitzzYo" target="_blank" class="text-secondary" title="YouTube">
            <i class="bi bi-youtube sosmed-icon"></i>
          </a>
          <a href="https://www.tiktok.com/@ritzzajaa" target="_blank" class="text-secondary" title="TikTok">
            <i class="bi bi-tiktok sosmed-icon"></i>
          </a>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <img src="{{ asset('front/assets/img/dante.jpg') }}" alt="Arip" class="rounded-circle mb-3 team-profile-image">
        <h5>Arip</h5>
        <p class="text-muted">Presenter</p>
        <div class="d-flex justify-content-center gap-2">
          <a href="https://www.instagram.com/aiiippp__/" target="_blank" class="text-secondary" title="Instagram">
            <i class="bi bi-instagram sosmed-icon"></i>
          </a>
          <a href="https://youtube.com/@harrys" target="_blank" class="text-secondary" title="YouTube">
            <i class="bi bi-youtube sosmed-icon"></i>
          </a>
          <a href="https://tiktok.com/@harrys" target="_blank" class="text-secondary" title="TikTok">
            <i class="bi bi-tiktok sosmed-icon"></i>
          </a>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
        <img src="{{ asset('front/assets/img/bluarcip.jpg') }}" alt="Azhar" class="rounded-circle mb-3 team-profile-image">
        <h5>Azhar</h5>
        <p class="text-muted">Full-Stack Dev</p>
        <div class="d-flex justify-content-center gap-2">
          <a href="https://www.instagram.com/azhar49.exe/" target="_blank" class="text-secondary" title="Instagram">
            <i class="bi bi-instagram sosmed-icon"></i>
          </a>
          <a href="https://www.youtube.com/@azhar49shorts" target="_blank" class="text-secondary" title="YouTube">
            <i class="bi bi-youtube sosmed-icon"></i>
          </a>
          <a href="https://www.tiktok.com/@azhar49.exe" target="_blank" class="text-secondary" title="TikTok">
            <i class="bi bi-tiktok sosmed-icon"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-5 bg-light" data-aos="fade-up">
  <div class="container">
    <h2 class="section-title text-center mb-4">Galeri Inspirasi</h2>
    <div class="row g-3">
      <div class="col-6 col-md-3">
        <img src="{{ asset('front/assets/img/fossil.jpg') }}" class="galeri-img" alt="Fosil">
      </div>
      <div class="col-6 col-md-3">
        <img src="{{ asset('front/assets/img/paleontologist.jpg') }}" class="galeri-img" alt="Paleontologist">
      </div>
      <div class="col-6 col-md-3">
        <img src="{{ asset('front/assets/img/paleon.jpg') }}" class="galeri-img" alt="Sketsa Paleontologi">
      </div>
      <div class="col-6 col-md-3">
        <img src="{{ asset('front/assets/img/prehistory.jpeg') }}" class="galeri-img" alt="Lanskap purba">
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light" data-aos="flip-left">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-lg border-0">
          <div class="card-body p-5">
            <h3 class="card-title text-center mb-4 text-primary">Tertarik Berkolaborasi?</h3>
            <p class="card-text text-center mb-4">Kami terbuka untuk kerja sama, pertanyaan, atau sekadar berbagi ide! Jangan ragu menghubungi kami.</p>
            <form method="POST" action="{{ route('about.send') }}">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="emailanda@example.com" required>
              </div>
              <div class="mb-3">
                <label for="message" class="form-label">Pesan</label>
                <textarea name="message" class="form-control" id="message" rows="4" placeholder="Tulis pesan Anda di sini..." required></textarea>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Kirim Pesan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cta-section" data-aos="zoom-in">
  <h2 class="mb-3">Tertarik Menggali Lebih Dalam?</h2>
  <p>Bergabunglah dalam petualangan kami mengungkap jejak kehidupan purba.</p>
  <a href="{{ url('/blog') }}" class="btn-cta">Mulai Petualangan Anda</a>
</section>
@endsection

@push('js')
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      once: true
    });
  </script>
@endpush