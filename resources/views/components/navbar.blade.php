<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="text-white text-lg font-bold">Helpdesk System</a>
        <ul class="flex space-x-4">
            <li>
                <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-300">Dashboard</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
