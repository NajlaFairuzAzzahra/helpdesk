<nav class="bg-gray-800 text-white py-4 px-8 flex justify-between items-center">
    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Admin Dashboard</a>

    <!-- Navbar Menu -->
    <div class="flex items-center space-x-6">
        <!-- Dropdown Monitoring -->
        <div class="relative">
            <button id="dropdownMonitoringButton" class="hover:underline focus:outline-none">
                Monitoring
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

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="hover:underline text-red-500">Logout</button>
        </form>
    </div>
</nav>

<!-- Dropdown Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownButton = document.getElementById('dropdownMonitoringButton');
        const dropdownMenu = document.getElementById('dropdownMonitoringMenu');

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
