<!-- resources/views/partials/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Sol tarafa hizalanmış ANA SAYFA -->
        <a class="navbar-brand" href="/">
            ANA SAYFA
        </a>
        <a href="{{ url('/books') }}" class="navbar-title">KİTAPLIK</a>
        <a href="{{ url('/authors/approval') }}" class="navbar-title">&nbsp;YAZAR ONAYLAMA</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto"> <!-- Sağ tarafa hizalanmış diğer menüler -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">Profilim</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Çıkış Yap</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Kayıt Ol</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
