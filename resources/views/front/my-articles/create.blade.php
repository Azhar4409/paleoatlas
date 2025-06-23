@extends('front.layout.template')

@section('title', 'Buat Artikel Baru')

@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Buat Artikel Baru</h2>
    </div>
    @if ($errors->any())
        <div class="my-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
<form action="{{ route('my-articles.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" hidden>Pilih Kategori</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="myeditor" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="myeditor" name="desc" rows="8" required>{{ old('desc') }}</textarea>
        </div>
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Gambar (Max 2MB)</label>
                <input type="file" class="form-control" id="thumbnail" name="img">
                <div class="mt-2">
                    <img src="" class="img-thumbnail img-preview" width="120" style="display:none;">
                </div>
            </div>
            <script>
                document.getElementById('thumbnail').addEventListener('change', function(e) {
                    const [file] = this.files;
                    if (file) {
                        const preview = document.querySelector('.img-preview');
                        preview.style.display = 'block';
                        preview.src = URL.createObjectURL(file);
                    }
                });
            </script>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="publish_date" class="form-label">Tanggal Publish</label>
                <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ old('publish_date') }}">
            </div>
        </div>
        <div class="float-end">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('my-articles.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
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