@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">IT S/W WO Monitoring</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('hardware.monitoring') }}" class="mb-6 flex items-center space-x-4">
        <select name="status" class="px-4 py-2 border rounded">
            <option value="">-- All Status --</option>
            <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
            <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Closed" {{ request('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <input type="text" name="search" placeholder="Search Ticket ID" value="{{ request('search') }}" class="px-4 py-2 border rounded">

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
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
                    <td class="py-2 px-4">{{ $ticket->status }}</td>
                    <td class="py-2 px-4">{{ $ticket->created_at->format('d M Y, H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
