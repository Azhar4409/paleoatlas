@extends('front.layout.template')

@section('title', 'All Category - PaleoAtlas')

@section('content')
    <div class="container py-4">
        <div class="alert alert-info py-2">
            Showing all articles with category:
        </div>
        <div class="row">
            @foreach ($category as $item)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0 category-card transition" style="border-radius: 1rem;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                            <a href="{{ url('category/'.$item->slug) }}" class="text-decoration-none text-dark w-100">
                                <span class="d-block mb-2">
                                    <i class="fas fa-folder fa-4x d-none d-md-inline"></i>
                                    <i class="fas fa-folder fa-2x d-inline d-md-none"></i>
                                </span>
                                <h5 class="card-title mt-2 mb-0">{{ $item->name }}</h5>
                                <small class="text-muted">({{ $item->articles_count }} articles)</small>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- <div class="pagination justify-content-center my-4">
            {{ $articles->links() }}
        </div> --}}
    </div>
    <style>
        .category-card:hover {
            box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.12);
            transform: translateY(-4px) scale(1.03);
            transition: all 0.2s;
        }
        .category-card .fa-folder {
            color: #ffc107;
        }
    </style>
@endsection