<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
