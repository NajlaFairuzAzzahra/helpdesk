<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-800 text-white py-4 px-8 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('user.dashboard') }}" class="text-xl font-bold">Helpdesk System</a>

        <!-- Navbar Menu -->
        <div class="flex items-center space-x-6">
            <!-- Dropdown IT Requirements -->
            <div class="relative">
                <button id="dropdownMenuButton" class="hover:underline focus:outline-none">
                    IT Requirements 
                </button>
                <div id="dropdownMenu" class="hidden absolute bg-gray-700 mt-2 rounded shadow-lg z-10">
                    <a href="{{ route('software.list') }}" class="block px-4 py-2 hover:bg-gray-600">IT S/W Work Order List</a>
                    <a href="{{ route('software.monitoring') }}" class="block px-4 py-2 hover:bg-gray-600">IT S/W WO Monitoring</a>
                    <a href="{{ route('hardware.monitoring') }}" class="block px-4 py-2 hover:bg-gray-600">IT H/W WO Monitoring</a>
                    <a href="{{ route('troubleshooting') }}" class="block px-4 py-2 hover:bg-gray-600">Troubleshooting</a>
                </div>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hover:underline text-red-500">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-6 px-8">
        @yield('content')
    </main>

    <!-- Dropdown Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownButton = document.getElementById("dropdownMenuButton");
            const dropdownMenu = document.getElementById("dropdownMenu");

            dropdownButton.addEventListener("click", () => {
                dropdownMenu.classList.toggle("hidden");
            });

            // Close dropdown when clicked outside
            document.addEventListener("click", (e) => {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        });
    </script>
</body>
</html>
