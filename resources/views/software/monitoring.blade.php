@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">IT S/W WO Monitoring</h1>

    <!-- Filter Form -->
    <form id="filterForm" method="GET" action="{{ route('software.monitoring') }}" class="mb-6 flex items-center space-x-4">
        <select name="status" id="statusFilter" class="px-4 py-2 border rounded">
            <option value="">-- All Status --</option>
            <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
            <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Closed" {{ request('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <input type="text" name="search" id="searchInput" placeholder="Search Ticket ID" value="{{ request('search') }}" class="px-4 py-2 border rounded">
    </form>

    <!-- Table -->
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="py-2 px-4">Ticket ID</th>
                <th class="py-2 px-4">Type</th>
                <th class="py-2 px-4">Status</th>
                <th class="py-2 px-4">Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $ticket->id }}</td>
                    <td class="py-2 px-4">{{ ucfirst($ticket->type) }}</td>
                    <td class="py-2 px-4">
                        @if ($ticket->status === 'Open')
                            <span class="text-green-500">{{ $ticket->status }}</span>
                        @elseif ($ticket->status === 'Pending')
                            <span class="text-yellow-500">{{ $ticket->status }}</span>
                        @else
                            <span class="text-red-500">{{ $ticket->status }}</span>
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $ticket->created_at->format('d M Y, H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterForm = document.getElementById('filterForm');
        const statusFilter = document.getElementById('statusFilter');
        const searchInput = document.getElementById('searchInput');

        // Trigger form submission when status dropdown changes
        statusFilter.addEventListener('change', () => {
            filterForm.submit();
        });

        // Trigger form submission when search input loses focus
        searchInput.addEventListener('input', () => {
            clearTimeout(searchInput.dataset.timer);
            searchInput.dataset.timer = setTimeout(() => {
                filterForm.submit();
            }, 500); // Delay to avoid spamming requests
        });
    });
</script>
@endsection
