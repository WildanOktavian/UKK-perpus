@extends('layouts.main')

@section('title', 'Buku')

@section('content')
    <h1> Daftar Buku</h1>

    <div class="my-5 d-flex justify-content-end">
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('show-delete-book') }}" class="btn btn-info bg-opacity-50 text-secondary me-3"><i class="fa-regular fa-eye"></i></a>
        @endif
        <a href="add-book" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
    </div>

    <div class="my-5">
        <table class="table">
            <thead>
                <a href="{{ route('export-buku') }}" class="btn btn-success">Ekspor Buku (CSV)</a>
                <tr>
                    <th>No.</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun terbit</th>
                    <th>Kategori</th>
                    {{-- <th>Status</th> --}}
                    <th>Gambar</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($books->count() > 0)
                @foreach ($books as $buku)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buku->book_code }}</td>
                        <td>{{ $buku->title }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>
                            @foreach ($buku->categories as $category)
                                {{ $category->name }} <br>
                            @endforeach
                        </td>
                        {{-- <td>{{ $buku->status }}</td> --}}
                        <td>
                            <img src="{{ asset('storage/cover/' . $buku->cover) }}" alt="Gambar Prestasi" style="max-width: 150px;">
                        </td>
                        <td style="display: flex; justify-content: space-around; width: 30%;">
                            <a href="{{ route('edit-book', ['slug' => $buku->slug]) }}" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i></a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $buku->slug }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                           @include('book.delete-book')
                        </td>
                    </tr>
                @endforeach
                {{-- @else
                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data
                    </td>
                </tr> --}}
                @endif
            </tbody>
        </table>
        {!! $books->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>

    @include('sweetalert::alert')

@endsection