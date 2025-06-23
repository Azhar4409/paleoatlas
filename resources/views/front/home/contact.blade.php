@extends('front.layout.template')

@section('title', 'Contact - PaleoAtlas')

@push('css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/contact.css') }}" rel="stylesheet" >
@endpush

@section('content')
<div class="contact-wrapper">
  <div class="contact-box text-center">
    <div class="contact-title">Hubungi Kami</div>
    <form method="POST" action="{{ route('contact.send') }}">
      @csrf
      <div class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Nama" required>
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-3">
        <textarea name="message" class="form-control" rows="4" placeholder="Pesan" required></textarea>
      </div>
      <button type="submit" class="btn btn-send w-100">KIRIM</button>
    </form>
    <div class="footer-contact mt-4">
      <p><i class="fas fa-envelope"></i> info@paleoblog.com</p>
      <p><i class="fas fa-phone"></i> (23) 456-7890</p>
      <div class="social-icons mt-2">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection