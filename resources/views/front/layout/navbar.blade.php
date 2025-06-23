<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4" style="z-index: 1100; position: relative;" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" data-aos="fade-right" data-aos-delay="200">Paleo Atlas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/') }}" data-aos="fade-left" data-aos-delay="300">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/blog') }}" data-aos="fade-left" data-aos-delay="350">Blog</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/articles') }}" data-aos="fade-left" data-aos-delay="400">Article</a></li>
                <li class="nav-item dropdown" data-aos="fade-left" data-aos-delay="450">
                    <button class="btn btn-dark dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        @foreach ($categories as $item)
                        <li><a class="dropdown-item" href="{{ url('category/'.$item->slug) }}">{{ $item->name }}</a></li>
                        @endforeach
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('all-category') }}">All Categories</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/about') }}" data-aos="fade-left" data-aos-delay="500">About</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/contact') }}" data-aos="fade-left" data-aos-delay="550">Contact</a></li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->profile_photo ? asset('storage/profile/' . Auth::user()->profile_photo) : asset('front/assets/img/default-profile.png') }}"
                        alt="Profile" class="rounded-circle" width="32" height="32">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarProfileDropdown">
                        <li><a href="{{ route('profil.show') }}" class="text-center d-block text-decoration-none text-white"><h5>{{ Auth::user()->name }}</h5></a></li>
                        <li><hr class="dropdown-divider"></li>
                        @if(Auth::user()->role === 1)
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('my-articles.index') }}">My Articles</a></li>
                        <li><a class="dropdown-item" href="{{ route('my-articles.create') }}">Create Article</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.index') }}">Setting</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>