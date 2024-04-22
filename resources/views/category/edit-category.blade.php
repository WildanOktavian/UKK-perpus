@extends('layouts.main')

@section('title', 'edit category')

@section('content')

    <h1>Edit Kategori</h1>

        <div class="mt-5 w-50">
        <form action="{{ route('update-category', ['slug' => $category->slug]) }}" method="post">
            @csrf
            <div>
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Kategori" value="{{ $category->name }}">
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection