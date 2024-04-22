@extends('layouts.main')

@section('title', 'Pengembalian Buku')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
        <h1 class="mb-5">Form Pengembalian Buku </h1>
        <form action="return-book" method="post">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">Pengguna</label>
                <select name="user_id" id="user" class="form-control input-box">
                    <option value="">Pilih Pengguna</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="book" class="form-label">Buku</label>
                <select name="book_id" id="book" class="form-control input-box">
                    <option value="">Pilih Buku</option>
                    @foreach ($books as $buku)
                        <option value="{{ $buku->id }}">{{ $buku->book_code }} {{ $buku->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>

    @include('sweetalert::alert')
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.input-box').select2();
        });
    </script>

    @include('sweetalert::alert')

@endsection