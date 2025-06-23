@extends('front.layout.template')

@section('title', 'Create Article - PaleoAtlas')

@section('content')
    <div class="container py-4">
        <h2>Create New Article</h2>
        <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
                @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="myeditor" class="form-control" rows="8" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Publish</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="publish_date" class="form-label">Publish Date (optional)</label>
                <input type="date" name="publish_date" id="publish_date" class="form-control" value="{{ old('publish_date') }}">
                @error('publish_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('article.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
