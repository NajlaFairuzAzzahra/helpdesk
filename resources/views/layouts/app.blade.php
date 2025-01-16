<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <div>
                <a href="{{ url('/') }}" class="text-lg font-bold">Helpdesk System</a>
            </div>
            <div>
                @auth
                    <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="mr-4">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-4">Login</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="py-8">
        @yield('content')
    </main>
</body>
</html>
