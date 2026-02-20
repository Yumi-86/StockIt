<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <header class="bg-dark text-white py-3 px-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="w-25"></div>
            <div class="w-50 text-center">
                @auth
                @if (auth()->user()->role === 1)
                <a href="{{ route('general.dashboard') }}" class="text-white fs-3 fw-bold">StockIt</a>
                @else
                <a href="{{ route('admin.dashboard') }}" class="text-white fs-3 fw-bold">StockIt</a>
                @endif
                @else
                <a href="{{ route('login') }}" class="text-white fs-3 fw-bold">StockIt</a>
                @endauth
            </div>
            <nav class="w-25">
                <div class="nav-menu">
                    @auth
                    <form action="{{ route('logout') }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">ログアウト</button>
                    </form>
                    @endauth
                </div>
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>