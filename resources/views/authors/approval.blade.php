@extends('layouts.main')

@section('title', 'Yazar Onaylama')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Yazar Onaylama</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Yazar Adı</th>
                <th>Onay Durumu</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($authors as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->approved ? 'Onaylı' : 'Onaysız' }}</td>
                    <td>
                        @if(!$author->approved)
                            <form action="{{ route('authors.approve', $author->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Onayla</button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Onaylandı</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Onay bekleyen yazar bulunmuyor.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
