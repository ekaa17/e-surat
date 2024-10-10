<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicons -->
    <link href="{{ asset('model/img/logo.jpg') }}" rel="icon" class="rounded-circle">
    <link href="{{ asset('model/img/logo.jpg') }}" rel="apple-touch-icon" class="rounded-circle">

    <link rel="stylesheet" href="{{ asset('model/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('model/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Login Sistem</title>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="{{ asset('landing/img/LogoIDKY.png') }}" alt="">
        </div>
        <div class="text-center mt-4 name">
            PT.Indokarya Jasa Prima <br>

            @if(session('wrong'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{ session('wrong') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <form class="p-3 mt-3" method="post" action="/login" >
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="email" placeholder="email">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <button type="submit" class="btn mt-3">Login</button>
        </form>
    </div>

    <script src="{{ asset('model/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>