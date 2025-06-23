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
                            <span class="ml-2">Ditulis oleh <b>{{ $article->user->name }}</b> | </span>
                            <span class="ml-2">{{ $article->created_at->format('D-M-Y') }} | </span>
                            <span class="ml-2">Kategori : <a href="{{ url('category/'.$article->Category->slug) }}">{{ $article->Category->name }}</a> | </span>
                            <span class="ml-2">{{ $article->views }}</span>
                        </div>
                        <h1 class="card-title">{{ $article->title }}</h1>
                        <p class="card-text">{!! $article->desc !!}</p>
                        <div class="mt-5 d-flex gap-2">
                            <a href="{{ route('my-articles.edit', $article) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                            <form action="{{ route('my-articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Yakin hapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" type="submit">Hapus</button>
                            </form>
                        </div>
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
                    </div>
                </div>
            </div>
            <!-- Side widgets-->
            @include('front.layout.side-widget')
        </div>
    </div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myeditor').summernote({
            height: 300,
            toolbar: [
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['misc', ['undo', 'redo']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        uploadImage(files[i]);
                    }
                }
            }
        });

            function uploadImage(file) {
                let data = new FormData();
                data.append("upload", file);
                data.append("_token", "{{ csrf_token() }}");
                $.ajax({
                    url: '{{ route('my-articles.upload-image') }}',
                    method: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response.url) {
                            // Insert image with width and height 100%
                            var img = $('<img>').attr('src', response.url).css({width: '100%', height: '100%'});
                            $('#myeditor').summernote('insertNode', img[0]);
                        } else {
                            console.error('Upload failed:', response);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
    });

    // Sync Summernote content to textarea on form submit
    $('form').on('submit', function() {
        var markup = $('#myeditor').summernote('code');
        $('textarea[name=desc]').val(markup);
    });
</script>
@endpush
