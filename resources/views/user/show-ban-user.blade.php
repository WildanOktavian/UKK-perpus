@extends('layouts.main')

@section('title', 'Show Ban Users')

@section('content')
    <h1> Daftar User yang sudah di hapus </h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="{{ route('users') }}" class="btn btn-primary"><i class="fa-solid fa-circle-chevron-left"></i></a>
    </div>

    <div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>No telp</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($showUser as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        @if ($user->phone)
                            {{ $user->phone }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <form action="{{ route('restore-ban-users', ['slug' => $user->slug]) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-rotate-left"></i></button>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#permanentModal{{ $user->slug }}">
                        <i class="fa-solid fa-trash"></i>
                        </button>
                        @include('user.permanent-user')
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@include('sweetalert::alert')

@endsection