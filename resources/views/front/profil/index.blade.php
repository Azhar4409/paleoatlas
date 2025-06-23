@extends('front.layout.template')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-4">
    <h2>Profil Saya</h2>
    @if(session('success'))
        <div class="swal" data-swal="{{ session('success') }}" style="display:none;"></div>
    @endif
    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Bio / Tagline</label>
                <input type="text" name="bio" class="form-control" value="{{ old('bio', $user->bio) }}">
            </div>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $user->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Foto Profil</label>
            <div class="row align-items-center">
                <div class="col-auto">
                    <img id="profilePreview"
                    src="{{ $user->profile_photo ? asset('storage/profile/'.$user->profile_photo) : asset('front/assets/img/default-profile.png') }}"
                    alt="Profile" class="rounded-circle" width="80" height="80">
                </div>
                <div class="col">
                    <input type="file" name="profile_photo" class="form-control w-100" onchange="previewProfilePhoto(event)">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label>Link YouTube</label>
            <input type="url" name="yt" class="form-control" value="{{ old('yt', $user->yt) }}">
        </div>
        <div class="mb-3">
            <label>Link Instagram</label>
            <input type="url" name="ig" class="form-control" value="{{ old('ig', $user->ig) }}">
        </div>
        <div class="mb-3">
            <label>Link Facebook</label>
            <input type="url" name="fb" class="form-control" value="{{ old('fb', $user->fb) }}">
        </div>
        <div class="mb-3">
            <label>Link TikTok</label>
            <input type="url" name="tiktok" class="form-control" value="{{ old('tiktok', $user->tiktok) }}">
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary">Simpan</button>
        </div>
    </form>

    <hr>
    <h3>Artikel Saya</h3>
    <a href="{{ route('my-articles.create') }}" class="btn btn-success mb-3">Buat Artikel Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->status ? 'Published' : 'Draft' }}</td>
                <td>{{ $article->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('my-articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('my-articles.destroy', $article) }}" method="POST" style="display:inline;" class="delete-article-form">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada artikel.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $articles->links() }}
</div>
@endsection

@push('js')
<script>
function previewProfilePhoto(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('profilePreview').src = URL.createObjectURL(file);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.delete-article-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin hapus artikel ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
