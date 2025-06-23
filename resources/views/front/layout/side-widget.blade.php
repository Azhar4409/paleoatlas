<!-- Side widgets-->
<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4 shadow-sm" data-aos="fade-up">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-search me-2"></i>Search
        </div>
        <div class="card-body">
            <form action="{{ route('search') }}" method="post">
                @csrf
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input class="form-control" type="text" name="keyword" placeholder="Search articles..." />
                    <button class="btn btn-primary" id="button-search" type="submit">Go</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4 shadow-sm" data-aos="fade-up" data-aos-delay="100">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-tags me-2"></i>Categories
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                @foreach ($categories as $item)
                    <a href="{{ url('category/'.$item->slug) }}" class="badge bg-gradient-primary category-badge text-white text-decoration-none px-3 py-2">
                        {{ $item->name }}
                        @if (!empty($item->articles_count))
                            <span class="badge bg-light text-primary ms-1">{{ $item->articles_count }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <div class="card mb-4 shadow-sm" data-aos="fade-up" data-aos-delay="200">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-lightbulb me-2"></i>Did You Know?
        </div>
        <div class="card-body fst-italic text-muted">
            @if(isset($knowledge) && $knowledge)
                {{ $knowledge->content }}
            @else
                "Tidak ada pengetahuan yang tersedia saat ini."
            @endif
        </div>
    </div>
    <!-- Popular Post -->
    <div class="card mb-4 shadow-sm" data-aos="fade-up" data-aos-delay="300">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-fire me-2"></i>Popular Posts
        </div>
        <div class="card-body p-2">
            @forelse ($popular_posts as $i => $item)
            <a href="{{ url('p/'.$item->slug) }}" class="d-flex mb-3 align-items-center border-bottom pb-2 hover-shadow text-decoration-none" style="color: inherit;">
                <span class="badge bg-danger me-2 align-self-start">{{ $i+1 }}</span>
                <span class="me-3 flex-shrink-0" style="width: 70px;">
                <img src="{{ asset('storage/back/'.$item->img) }}" alt="{{ $item->title }}" class="img-fluid rounded hover-zoom" style="height: 50px; object-fit: cover; width: 70px;">
                </span>
                <div>
                <span class="fw-semibold text-dark text-decoration-none small">
                    {{ Str::limit($item->title, 50) }}
                </span>
                <div class="text-muted small mt-1">
                    <i class="bi bi-eye"></i> {{ $item->views ?? 0 }} views &middot;
                    <i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}
                </div>
                </div>
            </a>
            @empty
            <div class="text-muted text-center">No popular posts yet.</div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .hover-zoom:hover { transform: scale(1.08); transition: .2s; }
    .hover-shadow:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08); }
    .bg-gradient-primary { background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%) !important; }

    .category-badge {
    transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
    cursor: pointer;
    padding: 0.35em 0.8em !important; /* lebih kecil dari px-3 py-2 */
    font-size: 0.95em;
    border-radius: 1.2em;
    line-height: 1.2;
    }
    
    .category-badge:hover {
    transform: translateY(-1px) scale(1.03); /* lebih kecil dari sebelumnya */
    box-shadow: 0 2px 8px rgba(0,123,255,0.10);
    background: linear-gradient(90deg, #00c6ff 0%, #007bff 100%) !important;
    color: #fff !important;
    text-decoration: none;
    }
</style>