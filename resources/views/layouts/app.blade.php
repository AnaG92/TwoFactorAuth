<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Upmind') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('images/icon.png') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <main>
            <div class="row header-container">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <a href="/">
                                <img src="{{ asset('images/icon.png') }}" width="60px" height="60px" alt="company icon"/>
                            </a>
                        </div>
                        <div class="col-10"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
