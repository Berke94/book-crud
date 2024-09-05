<!-- resources/views/books/index.blade.php -->

@extends('layouts.main')

@section('title', 'Kitap Listesi')

@section('content')
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
                        <p><strong>Yazar:</strong> {{ $book->author->name ?? 'Yazar bulunamadı' }}</p>
                        <p><strong>ISBN:</strong> {{ $book->isbn_number }}</p>
                        <p><strong>Açıklama:</strong> {{ $book->description }}</p>
                        <p><strong>Sayfa Sayısı:</strong> {{ $book->number_of_pages }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
