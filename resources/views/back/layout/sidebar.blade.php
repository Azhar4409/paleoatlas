<div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ url('/') }}">
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#"></use>
                    </svg>
                    <h3 style="color: black">Paleo Atlas</h3>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ url('dashboard') }}">
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#house-fill"></use>
                    </svg>
                    Dashboard

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('article') }}">
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#journals"></use>
                    </svg>
                    Article

                </a>
            </li>

            @if (auth()->user()->role == 1)
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ url('categories') }}">
                        <svg class="bi" aria-hidden="true">
                            <use xlink:href="#tag"></use>
                        </svg>
                        Categories

                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('users') }}">
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#people"></use>
                    </svg>
                    Users

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('config') }}">
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#database-fill-gear"></use>
                    </svg>
                    Config

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('knowledge') }}">
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#lightbulb-fill"></use>
                    </svg>
                    Knowledge

                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#gear-wide-connected"></use>
                    </svg>
                    Settings

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg class="bi" aria-hidden="true">
                        <use xlink:href="#door-closed"></use>
                    </svg>
                    Sign out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>