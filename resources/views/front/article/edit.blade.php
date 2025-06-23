@extends('front.layout.template')

@section('title', 'Edit Article - PaleoAtlas')

@section('content')
    <div class="container py-4">
        <h2>Edit Article</h2>
        <form action="{{ route('article.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail (optional)</label>
                @if($article->img)
                    <div class="mb-2">
                        <img src="{{ asset('storage/back/' . $article->img) }}" alt="Thumbnail" width="120">
                    </div>
                @endif
                <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
                @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="myeditor" class="form-control" rows="8" required>{{ old('content', $article->desc) }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1" {{ old('status', $article->status) == '1' ? 'selected' : '' }}>Publish</option>
                    <option value="0" {{ old('status', $article->status) == '0' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="publish_date" class="form-label">Publish Date (optional)</label>
                <input type="date" name="publish_date" id="publish_date" class="form-control" value="{{ old('publish_date', $article->publish_date ? $article->publish_date->format('Y-m-d') : '') }}">
                @error('publish_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('article.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
