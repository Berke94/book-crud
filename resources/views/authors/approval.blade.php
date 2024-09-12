@extends('layouts.main')

@section('title', 'Yazar Onaylama')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="text-center mb-4 ">Yazar Onaylama</h1>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('danger') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive shadow-sm">
                    <table class="table table-hover align-middle">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col"><i class="bi bi-pencil-square"></i></th>
                            <th scope="col">Yazar Adı</th>
                            <th scope="col">Onay Durumu</th>
                            <th scope="col" class="text-end">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($authors as $author)
                            <tr class="border-bottom">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $author->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $author->approved ? 'success' : 'warning' }} rounded-pill py-2 px-3">
                                        {{ $author->approved ? 'Onaylı' : 'Onaysız' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    @if(!$author->approved)
                                        <form action="{{ route('authors.approve', $author->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-sm px-3 py-2">
                                                <i class="bi bi-check-circle"></i> Onayla
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-outline-secondary btn-sm px-3 py-2" disabled>
                                            <i class="bi bi-check-circle-fill"></i> Onaylandı
                                        </button>
                                    @endif
                                    @if(!$author->approved)
                                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Bu yazarı silmek istediğinizden emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-3 py-2">
                                                <i class="bi bi-trash"></i> Sil
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">Onay bekleyen yazar bulunmuyor.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
