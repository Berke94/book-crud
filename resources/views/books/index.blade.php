<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            padding-left: 0; /* Sol boşluğu kaldırır */
        }
        .navbar-brand {
            margin-left: 300px; /* Ana sayfa bağlantısını hizalamak için margin eklenir */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
    <div class="container-fluid">
        <!-- Sol tarafa hizalanmış ANA SAYFA -->
        <a class="navbar-brand" href="/">
            ANA SAYFA
        </a>
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

<div class="container mt-4">
    <h1 class="mb-4">Kitap Listesi</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Yeni Kitap Ekle</a>
    <div class="accordion" id="bookAccordion">
        @foreach ($books as $book)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $book->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $book->id }}" aria-expanded="false" aria-controls="collapse{{ $book->id }}">
                        <strong>{{ $book->book_name }}</strong>
                    </button>
                </h2>
                <div id="collapse{{ $book->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $book->id }}" data-bs-parent="#bookAccordion">
                    <div class="accordion-body">
                        <div class="btn-group mb-3" style="float: right;">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </div>
                        <p><strong>Yazar:</strong> {{ $book->author }}</p>
                        <p><strong>ISBN:</strong> {{ $book->isbn_number }}</p>
                        <p><strong>Açıklama:</strong> {{ $book->description }}</p>
                        <p><strong>Sayfa Sayısı:</strong> {{ $book->number_of_pages }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
