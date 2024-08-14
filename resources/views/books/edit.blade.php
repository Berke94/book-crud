<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="book_name" class="form-label">Kitap Adı</label>
            <input type="text" class="form-control" id="book_name" name="book_name" required value="{{ old('book_name', $book->book_name) }}">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Yazar</label>
            <input type="text" class="form-control" id="author" name="author" required value="{{ old('author', $book->author) }}">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
