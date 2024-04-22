@extends('layouts.main')

@section('title', 'View Delete Category')

@section('content')
    <h1> Daftar Kategori yang sudah di hapus </h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="{{ route('categories') }}" class="btn btn-primary"><i class="fa-solid fa-circle-chevron-left"></i></a>
    </div>

    <div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viewCategory as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->name }}</td>
                    <td>
                        <form action="{{ route('restore-category', ['slug' => $kategori->slug]) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-rotate-left"></i></button>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteCategory{{ $kategori->slug }}">
                        <i class="fa-solid fa-trash"></i>
                        </button>
                        @include('category.permanent-category')
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@include('sweetalert::alert')

@endsection