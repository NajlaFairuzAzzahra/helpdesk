navigation_user.blade.php
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
                <a href="{{ route('work_order.list') }}" class="block px-4 py-2 hover:bg-gray-600">Work Order List</a>
                <a href="{{ route('software.monitoring') }}" class="block px-4 py-2 hover:bg-gray-600">IT S/W WO Monitoring</a>
                <a href="{{ route('hardware.monitoring') }}" class="block px-4 py-2 hover:bg-gray-600">IT H/W WO Monitoring</a>
                <a href="{{ route('troubleshooting') }}" class="block px-4 py-2 hover:bg-gray-600">Troubleshooting</a>
            </div>
        </div>

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
