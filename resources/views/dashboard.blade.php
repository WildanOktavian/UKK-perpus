@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<h1>Welcome, {{ Auth::user()->username }}</h1>

    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card-data buku">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journals"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Buku</div>
                        <div class="card-count">{{ $book }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-data kategori">
                <div class="row">
                    <div class="col-6"><i class="bi bi-list"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Kategori</div>
                        <div class="card-count">{{ $category }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-data pengguna">
                <div class="row">
                    <div class="col-6"><i class="bi bi-people"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Pengguna</div>
                        <div class="card-count">{{ $user }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2>#Peminjaman</h2>
        <div class="mt-5">
            @if ($peminjaman->isEmpty())
                <p>No Data</p>
            @else
            <x-browwing-table :browwing='$peminjaman' />
            @endif
        </div>
    </div>

@endsection