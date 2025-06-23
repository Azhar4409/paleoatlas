@extends('front.layout.template')

@section('title')
    @if(isset($authUserId) && $authUserId === $user->id)
        Profil Saya
    @else
        Profil {{ $user->name }}
    @endif
@endsection

@section('content')
<div class="container mt-4">
    <h2>
        @if(isset($authUserId) && $authUserId === $user->id)
            Profil Saya
        @else
            Profil {{ $user->name }}
        @endif
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="{{ $user->profile_photo ? asset('storage/profile/' . $user->profile_photo) : asset('front/assets/img/default-profile.png') }}"
                        alt="Profile" class="rounded-circle" width="100" height="100">
                </div>
                <div class="col">
                    <h3>
                        {{ $user->name }}
                        <span class="ms-2 badge 
                            @if ($user->role === 1)
                                bg-danger
                            @elseif ($user->role === 0)
                                bg-primary
                            @else
                                bg-secondary
                            @endif
                            " style="font-weight: normal; font-size: 0.75em; padding: 0.2em 0.4em;">
                            @if ($user->role === 1)
                                Admin
                            @elseif ($user->role === 0)
                                Member
                            @else
                                Unknown
                            @endif
                        </span>
                    </h3>
                    <p><strong>Tagline / Bio:</strong> {{ $user->bio }}</p>
                    <p><strong>Deskripsi:</strong> {{ $user->description }}</p>
                    <a href="{{ $user->yt }}" target="_blank" class="me-3 text-decoration-none">
                        <i class="fab fa-youtube fa-2x" style="color: #FF0000;"></i>
                    </a>
                    <a href="{{ $user->ig }}" target="_blank" class="me-3 text-decoration-none">
                        <i class="fab fa-instagram fa-2x" style="color: #E1306C;"></i>
                    </a>
                    <a href="{{ $user->fb }}" target="_blank" class="me-3 text-decoration-none">
                        <i class="fab fa-facebook fa-2x" style="color: #1877F2;"></i>
                    </a>
                    <a href="{{ $user->tiktok }}" target="_blank" class="me-3 text-decoration-none">
                        <i class="fab fa-tiktok fa-2x" style="color: #000000;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
