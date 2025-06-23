@extends('front.layout.template')

@section('title', 'Artikel Saya')

@section('content')
<div class="container py-4">
    <div class="mb-4 " data-aos="fade-down">
        <a hrdef="{{ route('my-articles.create') }}" class="btn btn-success">Buat Artikel Baru</a>
    </div>
    <div class="row">
    @forelse ($articles as $item)
        <div class="col-lg-4 col-md-6 col-12 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="card h-100 shadow-sm border-0">
                <div class="overflow-hidden">
                    <a href="{{ route('my-articles.show', $item) }}">
                        <img 
                            class="card-img-top post-img rounded-4 img-fluid transition"
                            src="{{ $item->img ? asset('storage/back/'.$item->img) : asset('images/no-image.png') }}"
                            alt="{{ $item->title }}"
                            style="object-fit:cover; max-height:220px; width:100%; transition:transform 0.3s;"
                            onmouseover="this.style.transform='scale(1.05)'"
                            onmouseout="this.style.transform='scale(1)'"
                        />
                    </a>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="small text-muted mb-2">
                        {{ $item->created_at->format('d M Y') }}
                        <span class="mx-1">|</span>
                        <a href="{{ url('category/'.$item->Category->slug) }}" class="text-decoration-none text-primary">
                            {{ $item->Category->name }}
                        </a>
                        <span class="mx-1">|</span>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Publish</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </div>
                    <h2 class="card-title h5 mb-2">
                        <a href="{{ route('my-articles.show', $item) }}" class="text-decoration-none text-dark">{{ $item->title }}</a>
                    </h2>
                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($item->desc), 120, '...') }}</p>
                    <div class="d-flex gap-2 mt-auto">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('my-articles.show', $item) }}">Read more →</a>
                        <a class="btn btn-sm btn-outline-warning" href="{{ route('my-articles.edit', $item) }}">Edit</a>
                        <form action="{{ route('my-articles.destroy', $item) }}" method="POST" class="delete-article-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <h3>Belum ada artikel.</h3>
    @endforelse

@if(session('success'))
<div class="swal" data-swal="{{ session('success') }}" style="display:none;"></div>
@endif

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(function() {
        const swalMessage = $('.swal').data('swal');
        if (swalMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: swalMessage,
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        }
    });

    // Optimize delete confirmation event listener
    const deleteForms = document.querySelectorAll('.delete-article-form');
    deleteForms.forEach(form => {
        form.removeEventListener('submit', handleDeleteSubmit);
        form.addEventListener('submit', handleDeleteSubmit);
    });

    function handleDeleteSubmit(e) {
        e.preventDefault();
        const form = e.target;
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
    }
</script>
@endpush
    </div>
    <div class="pagination justify-content-center my-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection
