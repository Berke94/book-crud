@extends('layouts.main')

@section('title', 'Kitap Düzenle')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Kitap Düzenle</h1>

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
                        <input type="text" class="form-control @error('book_name') is-invalid @enderror" id="book_name" name="book_name" required value="{{ old('book_name', $book->book_name) }}">
                        @error('book_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author_name" class="form-label">Yazar</label>
                        <input type="text" class="form-control @error('author_name') is-invalid @enderror" id="author_name" name="author_name" required value="{{ old('author_name', $book->author->name) }}">
                        <input type="hidden" id="author_id" name="author_id" value="{{ old('author_id', $book->author_id) }}">
                        @error('author_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $book->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        <input type="number" class="form-control @error('number_of_pages') is-invalid @enderror" id="number_of_pages" name="number_of_pages" required value="{{ old('number_of_pages', $book->number_of_pages) }}">
                        @error('number_of_pages')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bookstores" class="form-label">Satışta Olduğu Kitapçılar</label>
                        <div class="d-flex flex-wrap">
                            @foreach($bookstores as $bookstore)
                                <div class="form-check me-4">
                                    <input class="form-check-input" type="checkbox" name="bookstores[]" value="{{ $bookstore->id }}" id="bookstore{{ $bookstore->id }}"
                                        {{ $book->bookstores->contains($bookstore->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="bookstore{{ $bookstore->id }}">
                                        {{ $bookstore->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-outline-success px-4 py-2 btn-block">
                            <i class="bi bi-save"></i> Güncelle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Eğer edit.blade.php için özel bir script varsa buraya eklenir.
    </script>
@endpush
