<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ticket.js', 'resources/js/hardware_ticket.js'])

</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    @if (auth()->check() && auth()->user()->role === 'admin')
        <!-- Navbar for Admin -->
        <nav class="bg-gray-800 text-white py-4 px-8 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Admin Dashboard</a>

            <!-- Navbar Menu -->
            <div class="flex items-center space-x-6">
                <!-- Dropdown Monitoring -->
                <div class="relative">
                    <button id="dropdownMonitoringButton" class="hover:underline focus:outline-none">
                        Monitoring ▼
                    </button>
                    <div id="dropdownMonitoringMenu" class="hidden absolute bg-gray-700 mt-2 rounded shadow-lg z-10">
                        <a href="{{ route('software.monitoring') }}" class="block px-4 py-2 hover:bg-gray-600">S/W Monitoring</a>
                        <a href="{{ route('hardware.monitoring') }}" class="block px-4 py-2 hover:bg-gray-600">H/W Monitoring</a>
                    </div>
                </div>

                <!-- Troubleshooting -->
                <a href="{{ route('admin.troubleshooting') }}" class="hover:underline">Troubleshooting</a>

                <!-- Export -->
                <a href="{{ route('admin.tickets.export') }}" class="hover:underline">Export PDF</a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline text-red-500">Logout</button>
                </form>
            </div>
        </nav>
    @else
        <!-- Navbar for User -->
        <nav class="bg-gray-800 text-white py-4 px-8 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('user.dashboard') }}" class="text-xl font-bold">Helpdesk System</a>

            <!-- Navbar Menu -->
            <div class="flex items-center space-x-6">
                <!-- Dropdown IT Requirements -->
                <div class="relative">
                    <button id="dropdownMenuButton" class="hover:underline focus:outline-none">
                        IT Requirements ▼
                    </button>
                    <div id="dropdownMenu" class="hidden absolute bg-gray-700 mt-2 rounded shadow-lg z-10">
                        <a href="{{ route('work_order.list') }}" class="block px-4 py-2 hover:bg-gray-600">Work Order List</a>
                        <a href="{{ route('software.monitoring') }}" class="block px-4 py-2 hover:bg-gray-600">IT S/W WO Monitoring</a>
                        <a href="{{ route('hardware.monitoring') }}" class="block px-4 py-2 hover:bg-gray-600">IT H/W WO Monitoring</a>
                        <a href="{{ route('troubleshooting') }}" class="block px-4 py-2 hover:bg-gray-600">Troubleshooting</a>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline text-red-500">Logout</button>
                </form>
            </div>
        </nav>
    @endif

    <!-- Main Content -->
    <main class="py-6 px-8">
        @yield('content')
    </main>

    <!-- Dropdown Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dropdown for Monitoring (Admin)
            const monitoringButton = document.getElementById('dropdownMonitoringButton');
            const monitoringMenu = document.getElementById('dropdownMonitoringMenu');

            if (monitoringButton && monitoringMenu) {
                monitoringButton.addEventListener('click', function () {
                    monitoringMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function (event) {
                    if (!monitoringButton.contains(event.target) && !monitoringMenu.contains(event.target)) {
                        monitoringMenu.classList.add('hidden');
                    }
                });
            }

            // Dropdown for IT Requirements (User)
            const dropdownButton = document.getElementById('dropdownMenuButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener('click', function () {
                    dropdownMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function (event) {
                    if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>
