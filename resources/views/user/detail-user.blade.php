@extends('layouts.main')

@section('title', 'Regis user')

@section('content')
    <h1> Detail User</h1>

    <div class="mt-5 d-flex justify-content-end">
        @if($user->status == 'inactive')
            <a href="{{ route('approve-users', $user->slug) }}" class="btn btn-info"><i class="fa-solid fa-user me-3"></i>Approved User</a>
        @endif
    </div>
    {{-- approve-users/slug?petugas --}}

    <div class="my-5 w-25">
        <div class="mb-3">
            <label for="" class="form-label">Username</label>
            <input type="text" class="form-control" readonly value="{{ $user->username }}">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="text" class="form-control" readonly value="{{ $user->phone }}">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Addres</label>
            <textarea name="" id="" cols="30" rows="7" style="resize: none">{{ $user->address }}</textarea>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Status</label>
            <input type="text" class="form-control" readonly value="{{ $user->status }}">
        </div>
    </div>

    <div class="mt-5">
        <h3>Log peminjaman pengguna</h3>
        <x-browwing-table :browwing='$peminjaman' />
    </div>
    
    @include('sweetalert::alert')
@endsection