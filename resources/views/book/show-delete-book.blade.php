@extends('layouts.main')

@section('title', 'Show Delete Book')

@section('content')
    <h1> Daftar Buku yang sudah di hapus </h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="{{ route('books') }}" class="btn btn-primary"><i class="fa-solid fa-circle-chevron-left"></i></a>
    </div>

    <div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($showBook as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->book_code }}</td>
                    <td>{{ $book->title }}</td>
                    <td>
                        <form action="{{ route('restore-book', ['slug' => $book->slug]) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-rotate-left"></i></button>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#permanentModal{{ $book->slug }}">
                        <i class="fa-solid fa-trash"></i>
                        </button>
                        @include('book.permanent-destroy-book')
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@include('sweetalert::alert')

@endsection