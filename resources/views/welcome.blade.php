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
            background-color: #f0f2f5; /* Modern light background */
            color: #212529; /* Dark text */
        }
        .navbar-custom {
            background-color: #ffffff; /* White for navbar */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .nav-link {
            color: #212529; /* Dark text for links */
        }
        .nav-link:hover, .nav-link.active {
            color: #007bff; /* Blue color for active and hover */
        }
        .alert {
            background-color: #ffffff; /* White background for alert */
            color: #212529; /* Dark text for alert */
            border: 1px solid #d3d3d3; /* Light grey border */
            border-radius: 0.375rem; /* Rounded corners */
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
            font-weight: 600; /* Bold title */
            font-size: 1.5rem; /* Adjusted font size */
            color: #212529; /* Dark color for title */
            text-decoration: none;
        }
        .navbar-brand .navbar-title:hover {
            color: #007bff; /* Blue color on hover */
        }
        .container-custom {
            max-width: 800px;
            margin-top: 5rem;
        }
        .text-dark {
            color: #212529; /* Dark color for text */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="/books">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-logo">
            <span class="navbar-title">Book Store</span>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
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
                                    <button class="dropdown-item btn btn-danger" type="submit">Çıkış Yap</button>
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

<div class="container container-custom">
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
