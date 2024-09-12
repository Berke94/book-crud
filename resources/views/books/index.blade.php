@extends('layouts.main')

@section('title', 'Kitap Listesi')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="text-center mb-4">Kitap Listesi</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('books.create') }}" class="btn btn-outline-success px-4 py-2">
                        <i class="bi bi-plus-circle"></i> Yeni Kitap Ekle
                    </a>
                    <span class="text-muted">Toplam Kitap: {{ $books->count() }}</span>
                </div>

                <div class="accordion" id="bookAccordion">
                    @forelse ($books as $book)
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="heading{{ $book->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $book->id }}" aria-expanded="false" aria-controls="collapse{{ $book->id }}">
                                    <strong>{{ $book->book_name }}</strong>
                                </button>
                            </h2>
                            <div id="collapse{{ $book->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $book->id }}" data-bs-parent="#bookAccordion">
                                <div class="accordion-body">
                                    <div class="d-flex justify-content-end mb-3">
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning btn-sm px-3 py-2 me-2">
                                            <i class="bi bi-pencil"></i> Düzenle
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Kitabı silmek istediğinize emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-3 py-2">
                                                <i class="bi bi-trash"></i> Sil
                                            </button>
                                        </form>
                                    </div>

                                    <p><strong>Yazar:</strong> {{ $book->author->name ?? 'Yazar bulunamadı' }}</p>
                                    <p><strong>ISBN:</strong> {{ $book->isbn_number }}</p>
                                    <p><strong>Açıklama:</strong> {{ $book->description }}</p>
                                    <p><strong>Sayfa Sayısı:</strong> {{ $book->number_of_pages }}</p>

                                    <!-- Kitapçılar bilgisi -->
                                    <p><strong>Satışta Olduğu Kitapçılar:</strong></p>
                                    @if($book->bookstores->isEmpty())
                                        <p class="text-muted">Bu kitap henüz hiçbir kitapçıda satışta değil.</p>
                                    @else
                                        <ul class="list-unstyled">
                                            @foreach ($book->bookstores as $bookstore)
                                                <li><i class="bi bi-book"></i> {{ $bookstore->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Henüz eklenmiş bir kitap yok.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
