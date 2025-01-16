<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="relative flex items-center justify-center min-h-screen bg-gray-100">
        @auth
            <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="btn btn-primary">
                Dashboard
            </a>
        @else
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            </div>
        @endauth
    </div>
</body>
</html>
