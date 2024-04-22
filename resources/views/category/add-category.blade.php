@extends('layouts.main')

@section('title', 'Add Category')

@section('content')

    <h1>Tambah Kategori</h1>

        <div class="mt-5 w-50">
        <form action="store-category" method="post">
            @csrf
            <div>
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Kategori">
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection