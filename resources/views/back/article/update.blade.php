@extends('back.layout.template')

@section('title', 'Update Articles - Admin')

@section('content')
    {{-- main --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Update Articles</h1>
        </div>

        <div class="mt-3">
 
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
            
            <form action="{{ url('article/'.$article->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <input type="hidden" name="oldImg" value="{{ $article->img }}">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="" hidden>Select Category</option>
                                @foreach ($categories as $item)
                                    @if ($item->id == $article->category_id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea class="form-control" id="myeditor" name="desc" cols="38" rows="10">{{ old('desc', $article->desc) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Image (Max 2MB)</label>
                    <input type="file" class="form-control" id="img" name="img">
                    <div class="mt-2">
                        <small>Preview</small><br></br>
                        <img src="{{ asset('storage/back/'.$article->img) }}" class="img-thumbnail img-preview" width="100px">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="" hidden>Select Status</option>
                                <option value="1" {{ $article->status == 1 ? 'selected' : null }}>Publish</option>
                                <option value="0" {{ $article->status == 0 ? 'selected' : null }}>Private</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="publish_date" class="form-label">Publish Date</label>
                            <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ old('publish_date', $article->publish_date) }}">
                        </div>
                    </div>
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            var content = $('#myeditor').val();
            $('#myeditor').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        // You can add your image upload logic here if needed
                    }
                }
            });
            $('#myeditor').summernote('code', content);
        });
        // preview image
        $('#img').change(function() {
            previewImage(this);
        });
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
