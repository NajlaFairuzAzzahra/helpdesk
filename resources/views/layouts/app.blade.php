<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-o5Rm8aWDW39UL4qqvdn4Piz61Kp61nOTsP6ZLbEUMdAa4uNPup9EgFkwZ0+0z5P7" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/ticket.js'])
    @vite(['resources/js/hardware_ticket.js'])

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
    <div class="min-h-screen bg-gray-100">
        @yield('content')
    </div>
</body>
</html>
