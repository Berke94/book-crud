<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script>
        $(document).ready(function() {
            $('#author').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('authors.search') }}",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response(data);
                        },
                        error: function() {
                            response([]);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#author_id').val(ui.item.id); // Seçilen yazarın ID'sini form alanına ekleyin
                    $('#author').val(ui.item.label); // Seçilen yazarın adını input alanına ekleyin
                    return false; // Bu, seçilen öğenin inputa yerleştirilmesini önler
                }
            });
        });
    </script>
    <script>
        function formatISBN(input) {
            let value = input.value.replace(/\D/g, ''); // Sadece rakamları al
            let formattedValue = '';

            // Her 3 rakamdan sonra tire ekle
            for (let i = 0; i < value.length && i < 13; i++) {
                if (i > 0 && i % 3 === 0 && i < 13) {
                    formattedValue += '-';
                }
                formattedValue += value[i];
            }

            input.value = formattedValue;
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
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
    <h1 class="mb-4">Kitap Düzenle</h1>

    <!-- Hata mesajlarını göstermek için -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="bookForm" action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="book_name" class="form-label">Kitap Adı</label>
            <input type="text" class="form-control" id="book_name" name="book_name" required value="{{ old('book_name', $book->book_name) }}">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Yazar</label>
            <input type="text" class="form-control" id="author" name="author" required value="{{ old('author', $book->author->name ?? '') }}">
            <input type="hidden" id="author_id" name="author_id" value="{{ old('author_id', $book->author_id) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $book->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="isbn_number" class="form-label">ISBN Numarası</label>
            <input type="text" class="form-control @error('isbn_number') is-invalid @enderror" id="isbn_number" name="isbn_number" oninput="formatISBN(this)" required value="{{ old('isbn_number', $book->isbn_number) }}">
            @error('isbn_number')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="number_of_pages" class="form-label">Sayfa Sayısı</label>
            <input type="number" class="form-control" id="number_of_pages" name="number_of_pages" required value="{{ old('number_of_pages', $book->number_of_pages) }}">
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
