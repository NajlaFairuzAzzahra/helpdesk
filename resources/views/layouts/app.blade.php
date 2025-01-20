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
document.addEventListener('DOMContentLoaded', function () {
    // Dropdowns for Software
    const systemDropdown = document.getElementById('system');
    const subSystemDropdown = document.getElementById('sub_system');

    if (systemDropdown) {
        systemDropdown.addEventListener('change', function () {
            const selectedSystem = this.value;

            // Reset sub-system dropdown
            subSystemDropdown.innerHTML = '<option value="">-- Select Sub-system --</option>';

            if (selectedSystem) {
                fetch(`/get-sub-systems?system=${selectedSystem}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length) {
                            data.forEach(subSystem => {
                                const option = document.createElement('option');
                                option.value = subSystem;
                                option.textContent = subSystem;
                                subSystemDropdown.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching sub-systems:', error);
                    });
            }
        });
    }

    // Dropdowns for Hardware
    const infrastructureDropdown = document.getElementById('infrastructure');
    const hardwareDropdown = document.getElementById('hardware');

    if (infrastructureDropdown) {
        infrastructureDropdown.addEventListener('change', function () {
            const selectedInfrastructure = this.value;

            // Reset hardware dropdown
            hardwareDropdown.innerHTML = '<option value="">-- Select Hardware --</option>';

            if (selectedInfrastructure) {
                fetch(`/get-hardwares?infrastructure=${selectedInfrastructure}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length) {
                            data.forEach(hardware => {
                                const option = document.createElement('option');
                                option.value = hardware;
                                option.textContent = hardware;
                                hardwareDropdown.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching hardware:', error);
                    });
            }
        });
    }
});
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const dropdownButton = document.getElementById('dropdownMenuButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (dropdownButton && dropdownMenu) {
        // Toggle dropdown on button click
        dropdownButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
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
