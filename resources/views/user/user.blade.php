@extends('layouts.main')

@section('title', 'User')

@section('content')
    <h1> Daftar Pengguna</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="{{ route('show-ban-users') }}" class="btn btn-info me-3"><i class="fa-regular fa-eye me-2"></i>Banned User</a>
        <a href="{{ route('register-users') }}" class="btn btn-primary"><i class="fa-solid fa-registered me-2"></i>New Regis User</a>
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
                @foreach ($users as $user)
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

                    <td style="display: flex; justify-content: space-around; width: 30%;">
                        <a href="{{ route('detail-users', $user->slug) }}" class="btn btn-primary me-5"><i class="fa-solid fa-circle-info "></i></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteUser{{ $user->slug }}">
                                <i class="fa-solid fa-trash"></i>
                        </button>
                        @include('user.ban-users')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('sweetalert::alert')
@endsection