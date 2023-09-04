<nav id="navbar" class="navbar">
    <ul>
        <li><a class="nav-link active" href="#hero">Home</a></li>
        <li><a class="nav-link" href="#about">Penyewaan Kostum</a></li>
        <li><a class="nav-link" href="#services">Pengembalian Kostum</a></li>
        <li><a class="nav-link" href="#portfolio">Daftar Kursus</a></li>
        <li><a class="nav-link" href="#team">Profil Sanggar</a></li>
        @if (session('email'))
            <li class="dropdown">
                <a href="#">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" width="35" height="35">
                    </div>
                    <span style="padding-left: 10px;">{{ session('email') }}</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('logout') }}"" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="post">
                                @csrf
                                <span class="align-middle">Log Out</span>
                            </form>
                        </a>
                    </li>
                </ul>
            </li>
        @else
        <li><a class="nav-link" href="{{ route('form-login') }}">Login</a></li>
        @endif
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
</nav>
<!-- .navbar -->