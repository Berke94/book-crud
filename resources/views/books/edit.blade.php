<!-- resources/views/books/edit.blade.php -->

@extends('layouts.main')

@section('title', 'Kitap Düzenle')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@endpush

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Kitap Düzenle</h1>
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
                <label for="author_name" class="form-label">Yazar</label>
                <input type="text" class="form-control" id="author_name" name="author_name" required value="{{ old('author_name', $book->author->name) }}">
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
@endsection

@push('scripts')
    <script>
        // Eğer edit.blade.php için özel bir script varsa buraya eklenir.
    </script>
@endpush
