<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpus Digital| Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        @if(Session('status'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <div class="login-box bounce-in">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h1 class="login"> Login</h1>
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>

                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class=" form-control" required>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>

                <div class="text-center">
                    don't have account? <a href="{{ route('register') }}">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>