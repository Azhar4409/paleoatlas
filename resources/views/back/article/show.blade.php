@extends('front.layout.template')

@section('title', $article->title . ' - PaleoAtlas')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                <div class="card mb-4 shadow-sm border-0" data-aos="zoom-in">
                    <a href="{{ url('p/'.$article->slug) }}" class="d-block position-relative">
                        <img 
                            class="card-img-top single-img rounded-4 img-fluid shadow-sm transition"
                            src="{{ $article->img ? asset('storage/back/'.$article->img) : asset('images/no-image.png') }}"
                            alt="{{ $article->title }}"
                            style="object-fit:cover; max-height:400px; width:100%; transition:transform 0.3s;"
                            onmouseover="this.style.transform='scale(1.03)'"
                            onmouseout="this.style.transform='scale(1)'"
                        />
                        @if($article->Category)
                            <span class="position-absolute top-0 start-0 m-2 px-3 py-1 bg-primary text-white rounded-pill small shadow">
                                {{ $article->Category->name }}
                            </span>
                        @endif
                    </a>
                </div>
                <div class="card mb-4 shadow-sm" data-aos="fade-up">
                    <div class="card-body">
                        <div class="small text-muted">
                            <span class="ml-2">Ditulis oleh 
                                <b>
                                    <a class="text-decoration-none" href="{{ route('profil.public', $article->user) }}">{{ $article->user->name }}</a>
                                </b> | 
                            </span>
                            <span class="ml-2">{{ $article->created_at->format('D-M-Y') }} | </span>
                            <span class="ml-2">Kategori : <a class="text-decoration-none" href="{{ url('category/'.$article->Category->slug) }}">{{ $article->Category->name }}</a> | </span>
                            <span class="ml-2">{{ $article->views }}</span>
                        </div>
                        <h1 class="card-title">{{ $article->title }}</h1>
                        @php
                            $content = $article->desc;
                            $currentBaseUrl = request()->getSchemeAndHttpHost();

                            // Replace absolute URLs with fixed hosts to current base URL
                            $content = preg_replace_callback('/<img[^>]+src="([^">]+)"/i', function ($matches) use ($currentBaseUrl) {
                                $src = $matches[1];
                                // Hosts to replace - add more if needed
                                $hostsToReplace = [
                                    'http://172.16.2.110:8000',
                                    'http://127.0.0.1:8000',
                                    // Add domain if needed
                                ];
                                foreach ($hostsToReplace as $host) {
                                    if (strpos($src, $host) === 0) {
                                        $newSrc = $currentBaseUrl . substr($src, strlen($host));
                                        return str_replace($src, $newSrc, $matches[0]);
                                    }
                                }
                                // Fix relative URLs
                                if (!preg_match('/^(http|https):\/\//', $src)) {
                                    return str_replace($src, $currentBaseUrl . '/' . ltrim($src, '/'), $matches[0]);
                                }
                                return $matches[0];
                            }, $content);
                        @endphp
                        <p class="card-text">{!! $content !!}</p>

                        <div class="mt-5">
                            <p style="font-size: 15px"><b>Share this</b></p>
                            <div class="d-flex gap-2">
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-primary rounded-circle"
                                   title="Share on Facebook"
                                   style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <!-- Twitter/X -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-info rounded-circle"
                                   title="Share on Twitter"
                                   style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <!-- WhatsApp -->
                                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-success rounded-circle"
                                   title="Share on WhatsApp"
                                   style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($article->title) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-primary rounded-circle"
                                   title="Share on LinkedIn"
                                   style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <!-- Telegram -->
                                <a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}"
                                   target="_blank"
                                   class="btn btn-outline-primary rounded-circle"
                                   title="Share on Telegram"
                                   style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fab fa-telegram-plane"></i>
                                </a>
                            </div>
                        </div>

                        {{-- Comments Section --}}
                        <div class="mt-5">
                            <h4>Comments ({{ $comments->count() }})</h4>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @auth
                                <form action="{{ route('front.article.comment.store', $article->slug) }}" method="POST" class="mb-4">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="comment_text" class="form-label">Add a comment</label>
                                        <textarea class="form-control @error('comment_text') is-invalid @enderror" id="comment_text" name="comment_text" rows="3" required>{{ old('comment_text') }}</textarea>
                                        @error('comment_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @else
                                <p><a href="{{ route('login') }}">Log in</a> to post a comment.</p>
                            @endauth

                            @forelse ($comments as $comment)
                                <div class="mb-3 border rounded p-3 d-flex align-items-start gap-3">
                                    <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                                    <div class="flex-grow-1">
                                        <strong>{{ $comment->user->name }}</strong> <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        <p>{{ $comment->comment_text }}</p>
                                    </div>
                                    @auth
                                        @if(Auth::id() === $comment->user_id)
                                            <form id="delete-comment-form-{{ $comment->id }}" action="{{ route('front.article.comment.delete', $comment->id) }}" method="POST" style="display:none;">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $comment->id }})">🗑️</button>
                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                            <script>
                                                function confirmDelete(commentId) {
                                                    Swal.fire({
                                                        title: 'Apakah Anda yakin ingin menghapus komentar ini?',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ya, hapus!',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById('delete-comment-form-' + commentId).submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        @endif
                                    @endauth
                                </div>
                            @empty
                                <p>No comments yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widgets-->
            @include('front.layout.side-widget')
        </div>
    </div>
@endsection
