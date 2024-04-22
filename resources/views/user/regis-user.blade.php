@extends('layouts.main')

@section('title', 'Regis user')

@section('content')
    <h1> Register User</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="{{ route('users') }}" class="btn btn-primary"><i class="fa-solid fa-user me-3"></i>Approved User</a>
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
                @foreach ($regisUser as $user)
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
                        <a href="{{ route('detail-users', $user->slug) }}" class="btn btn-primary me-5">Detail</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('sweetalert::alert')
@endsection