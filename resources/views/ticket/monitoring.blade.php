@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Your Tickets</h1>

    <!-- Indikator Filter Aktif -->
    @if (request('status') || request('search'))
        <div class="mb-4 text-sm text-gray-500">
            <p>
                Showing results for:
                @if (request('status'))
                    <span class="text-blue-500 font-bold">Status: {{ request('status') }}</span>
                @endif
                @if (request('search'))
                    <span class="text-green-500 font-bold">Search: {{ request('search') }}</span>
                @endif
            </p>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 text-green-500">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('user.tickets.monitoring') }}" class="mb-6 flex items-center space-x-4">
        <!-- Filter Status -->
        <select name="status" class="px-4 py-2 border rounded">
            <option value="">-- All Status --</option>
            <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
            <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Closed" {{ request('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <!-- Search -->
        <input
            type="text"
            name="search"
            placeholder="Search by Ticket ID"
            value="{{ request('search') }}"
            class="px-4 py-2 border rounded"
        >

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>
    </form>

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="py-2 px-4">Ticket ID</th>
                <th class="py-2 px-4">Type</th>
                <th class="py-2 px-4">Status</th>
                <th class="py-2 px-4">Created At</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $ticket->id }}</td>
                    <td class="py-2 px-4">{{ ucfirst($ticket->type) }}</td>
                    <td class="py-2 px-4">
                        @if ($ticket->status === 'Open')
                            <span class="text-green-500 font-bold">{{ $ticket->status }}</span>
                        @elseif ($ticket->status === 'Pending')
                            <span class="text-yellow-500 font-bold">{{ $ticket->status }}</span>
                        @else
                            <span class="text-red-500 font-bold">{{ $ticket->status }}</span>
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $ticket->created_at->format('d M Y, H:i') }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('user.tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 text-center text-gray-500">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
</div>
@endsection
