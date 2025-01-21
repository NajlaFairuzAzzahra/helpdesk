@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Admin Dashboard</h1>

    <!-- Filter Form -->
    <form id="filter-form" method="GET" action="{{ route('admin.dashboard') }}" class="mb-6 flex items-center space-x-4">
        <select name="status" class="px-4 py-2 border rounded" onchange="document.getElementById('filter-form').submit();">
            <option value="">-- All Status --</option>
            <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
            <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Closed" {{ request('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <select name="type" class="px-4 py-2 border rounded" onchange="document.getElementById('filter-form').submit();">
            <option value="">-- All Types --</option>
            <option value="Software" {{ request('type') === 'Software' ? 'selected' : '' }}>Software</option>
            <option value="Hardware" {{ request('type') === 'Hardware' ? 'selected' : '' }}>Hardware</option>
        </select>

        <select name="user" class="px-4 py-2 border rounded" onchange="document.getElementById('filter-form').submit();">
            <option value="">-- All Users --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Ticket Table -->
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="py-2 px-4">Ticket ID</th>
                <th class="py-2 px-4">Type</th>
                <th class="py-2 px-4">User</th>
                <th class="py-2 px-4">Status</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $ticket->id }}</td>
                    <td class="py-2 px-4">{{ ucfirst($ticket->type) }}</td>
                    <td class="py-2 px-4">{{ $ticket->user->name }}</td>
                    <td class="py-2 px-4">{{ ucfirst($ticket->status) }}</td>
                    <td class="py-2 px-4">
                        <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}">
                            @csrf
                            <select name="status" class="px-2 py-1 border rounded">
                                <option value="Open" {{ $ticket->status === 'Open' ? 'selected' : '' }}>Open</option>
                                <option value="Pending" {{ $ticket->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded ml-2">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
            </table>
    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
</div>
@endsection
