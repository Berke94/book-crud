<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa; /* Light grey background */
            color: #343a40; /* Dark text */
        }
        .navbar-custom {
            background-color: #ffffff; /* White for navbar */
        }
        .nav-link {
            color: #343a40; /* Dark text for links */
        }
        .nav-link:hover, .nav-link.active {
            color: #007bff; /* Blue color for active and hover */
        }
        .alert {
            background-color: #ffffff; /* White background for alert */
            color: #343a40; /* Dark text for alert */
            border: 1px solid #d3d3d3; /* Light grey border */
        }
        .btn-danger {
            background-color: #dc3545; /* Red background for logout button */
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333; /* Darker red for hover */
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand .navbar-logo {
            max-height: 40px;
        }
        .navbar-brand .navbar-title {
            margin-left: 15px;
            font-weight: bold;
            font-size: 2rem; /* Larger font size for title */
            color: #343a40; /* Dark color for title */
            text-decoration: none;
        }
        .navbar-brand .navbar-title:hover {
            color: #007bff; /* Blue color on hover */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-logo">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto"> <!-- Added ms-auto for right alignment -->
                @auth
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

<div class="container mt-5">
    @auth
        <div class="alert alert-success">
            Merhaba, {{ Auth::user()->name }}! Hoş geldiniz.
        </div>
        <h1 class="text-dark">Dashboard</h1>
        <p>Bu alan kullanıcıya özel içerikler için ayrılmıştır.</p>
    @else
        <h1 class="text-dark">Hoş Geldiniz</h1>
        <p>Lütfen giriş yapın veya kayıt olun.</p>
    @endauth
</div>
</body>
</html>
