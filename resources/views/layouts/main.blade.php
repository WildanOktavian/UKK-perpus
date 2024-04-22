<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpus Digital | @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.css') }}">
</head>

<body>
    <div class="main d-flex flex-column justify-content-justify">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary fixed-top z-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Perpus Digital</a>
                <div class="dropdown me-3 ps-5">
                    <button class="btn border border-0 text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> {{ Auth::user()->username }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right pe-2"></i>Logout</a>
                        </li>
                    </ul>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    {{-- <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> --}}
            </div>
        </nav>

        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-3 collapse d-lg-block" id="navbarSupportedContent">
                    <div class="fixed-top col-lg-3 d-lg-block mt-5 z-0">
                    @if(Auth::user())
                        @if(Auth::user()->role != 'user')
                            <a href="/dashboard" @if (request()->route()->uri == 'dashboard') class="active" @endif><i
                                class="bi bi-house-door-fill p-2"></i>Dashboard</a>

                            <a href="books" @if (
                                request()->route()->uri == 'books' ||
                                request()->route()->uri == 'add-book' ||
                                request()->route()->uri == 'edit-book/{slug}' ||
                                request()->route()->uri == 'show-delete-book' ||
                                request()->route()->uri == 'delete-book/{slug}') class = "active" @endif>
                                <i class="fa-solid fa-book p-2"></i>Buku
                            </a>
                            <a href="categories" @if (
                                request()->route()->uri == 'categories' ||
                                request()->route()->uri == 'add-category' ||
                                request()->route()->uri == 'category-edit/{slug}' ||
                                request()->route()->uri == 'view-delete-category' ||
                                request()->route()->uri == 'category-delete/{slug}') class = "active" @endif>
                                <i class="bi bi-list p-2"></i>Kategori
                            </a>

                            @if(Auth::user()->role == 'admin')
                            <a href="{{ route('users') }}" @if (request()->route()->uri == 'users' || request()->route()->uri == 'register-users' || request()->route()->uri == 'detail-users/{slug}') class = "active" @endif><i class="bi bi-person-square p-2"></i>Pengguna</a>
                            @endif

                            <a href="rent-logs" @if (request()->route()->uri == 'rent-logs') class = "active" @endif><i
                                class="bi bi-bookmarks-fill p-2"></i>Peminjaman</a>

                            {{-- <a href="/" @if (request()->route()->uri == '/') class="active" @endif><i class="fa-solid fa-book p-2"></i>Buku</a> --}}
                            {{-- <a href="{{ route('return-book') }}" @if (request()->route()->uri == 'book-return') class="active" @endif><i class="fa-solid fa-book p-2"></i>Peminjaman</a> --}}

                            <a href="{{ route('logout') }}"><i class="bi bi-box-arrow-right p-2"></i>Logout</a>
                        @else
                        
                        {{-- <a href="profile" @if (request()->route()->uri == 'profile') class = "active" @endif><i
                            class="bi bi-bookmarks-fill p-2"></i>Profile</a> --}}

                        <a href="/" @if (request()->route()->uri == '/') class="active" @endif><i class="fa-solid fa-book p-2"></i>Buku</a>
                        {{-- <a href="{{ route('book-rent') }}" @if (request()->route()->uri == 'book-rent') class="active" @endif><i class="fa-solid fa-book p-2"></i>Peminjaman buku</a>
                        <a href="{{ route('return-book') }}" @if (request()->route()->uri == 'book-return') class="active" @endif><i class="fa-solid fa-book p-2"></i>Pengembalian buku</a> --}}
                        <a href="{{ route('return-book') }}" @if (request()->route()->uri == 'pengembalian') class="active" @endif><i class="fa-solid fa-book p-2"></i>Pengembalian</a>
                        <a href="{{ route('collections') }}" @if (request()->route()->uri == 'collections') class="active" @endif><i class="fa-solid fa-book p-2"></i>Koleksi</a>
                        <a href="rent-logs" @if (request()->route()->uri == 'rent-logs') class = "active" @endif><i
                                class="bi bi-bookmarks-fill p-2"></i>Peminjaman</a>
                        <a href="{{ route ('logout') }}">Logout</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endif
                        
                    </div>
                </div>

                <div class="content mt-5 p-5 col-lg-9">

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    
</body>

</html>
