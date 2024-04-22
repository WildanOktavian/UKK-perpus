@extends('layouts.main')

@section('title', 'Kategori')

@section('content')
    <h1> Daftar Kategori </h1>

    <div class="mt-5 d-flex justify-content-end">
        @if (Auth::user()->role == 'admin')
        <a href="view-delete-category" class="btn btn-info me-3"><i class="fa-regular fa-eye"></i></a>
        @endif
        <a href="add-category" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
    </div>

    <div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th style="width: 70%; text-align: center;">Nama</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($category->count() > 0)
            @foreach ($category as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: center;">{{ $kategori->name }}</td>
                    <td style="display: flex; justify-content: space-around; width: 30%;">
                        <a href="{{ route('edit-category', ['slug' => $kategori->slug]) }}" class="btn btn-primary me-5"><i class="fa-regular fa-pen-to-square"></i></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteCategory{{ $kategori->slug }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            @include('category.category-delete')
                    </td>
                </tr>
            @endforeach
            @else
           <tr>
            <td colspan="6" class="text-center">
                Tidak ada data
            </td>
           </tr>
            @endif

        </tbody>
    </table>
</div>
@include('sweetalert::alert')

@endsection