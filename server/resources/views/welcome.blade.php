<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ZuSa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="">
        <div class="">
            <div class="navbar navbar-expand-sm bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('img/icon.jpg') }}" width="30" height="24" alt="ZuSa" class="d-inline-block align-text-top">
                        ZuSa
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarId" aria-controls="navbarId" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>                    
                    <div class="collapse navbar-collapse" id="navbarId">
                        <ul class="navbar-nav ms-auto">
                            @if (Route::has('login'))
                                @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                    </li>

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                                        </li>
                                    @endif
                                @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row mt-4">
                    <div class="col">
                        <img src="{{ asset('img/welcome.jpg') }}" class="img-fluid rounded" alt="Welcome to the cloud">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col text-end">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
