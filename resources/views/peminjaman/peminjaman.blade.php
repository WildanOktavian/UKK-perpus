@extends('layouts.main')

@section('title', 'Peminjaman')

@section('content')
    <h1> Daftar Peminjaman Buku</h1>

    <div class="mt-5">
        <x-browwing-table :browwing='$peminjaman' />
    </div>
@endsection