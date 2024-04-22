@extends('layouts.main')

@section('title', 'Add Book')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <h1>Tambah Buku</h1>

        <div class="mt-5 w-50">
        <form action="store-book" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="code" class="form-label">Kode Buku</label>
                <input type="text" name="book_code" id="book_code" class="form-control" placeholder="Kode Buku" value="{{ old('book_code') }}">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Judul Buku" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Penulis</label>
                <input type="text" name="penulis" id="title" class="form-control" placeholder="Penulis" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Tahun terbit</label>
                <input type="text" name="tahun_terbit" id="title" class="form-control" placeholder="Tahun terbit" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Sinopsis</label>
                <input type="text" name="sinopsis" id="title" class="form-control" placeholder="Tahun terbit" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select name="categories[]" id="categories" class="form-control select-multiple" multiple>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>
@endsection