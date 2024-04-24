<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpus Digital | Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        @if ($errors->any())
            <div class="alert alert-danger" style="width: 370px">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session('status'))
            <div class="alert alert-success" style="width: 370px">
                {{ session('message') }}
            </div>
        @endif
        <div class="register-box fade-in">
            <form action="{{ route('store.regis') }}" method="post">
                <h1 class="register">Register</h1>
                @csrf
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>

                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div>
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>

                <div>
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="profil" class="form-label">Gambar</label>
                    <input type="file" name="profil" class="form-control">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary form-control">Register</button>
                </div>

                <div class="text-center">
                    Have account? <a href="{{ route('login') }}">Login</a>
                </div>

            </form>
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>