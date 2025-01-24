@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Admin Dashboard</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-6 flex items-center space-x-4">
        <select name="status" class="px-4 py-2 border rounded">
            <option value="">-- All Status --</option>
            <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
            <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Closed" {{ request('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>
        <select name="type" class="px-4 py-2 border rounded">
            <option value="">-- All Types --</option>
            <option value="Software" {{ request('type') === 'Software' ? 'selected' : '' }}>Software</option>
            <option value="Hardware" {{ request('type') === 'Hardware' ? 'selected' : '' }}>Hardware</option>
        </select>
        <select name="user" class="px-4 py-2 border rounded">
            <option value="">-- All Users --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        <input type="text" name="search" placeholder="Search Tickets" value="{{ request('search') }}" class="px-4 py-2 border rounded">
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
                    <td class="py-2 px-4">{{ $ticket->type }}</td>
                    <td class="py-2 px-4">{{ $ticket->user->name ?? 'Unknown' }}</td>
                    <td class="py-2 px-4">{{ $ticket->status }}</td>
                    <td class="py-2 px-4 space-x-4">
                        <button
                            type="button"
                            class="text-blue-500 hover:underline"
                            onclick="openEditModal({{ $ticket->id }})">
                            Edit
                        </button>
                        <button
                            type="button"
                            class="text-red-500 hover:underline"
                            onclick="openDeleteModal({{ $ticket->id }})">
                            Delete
                        </button>
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

<!-- Modals -->
@foreach ($tickets as $ticket)
<!-- Edit Modal -->
<div id="editModal-{{ $ticket->id }}" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded shadow p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Edit Ticket</h2>
        <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}" onsubmit="return false;">
            @csrf
            @method('POST')
            <label for="status" class="block text-gray-700 font-bold mb-2">Status:</label>
            <select
                name="status"
                id="status-{{ $ticket->id }}"
                class="w-full px-3 py-2 border rounded mb-4"
                onchange="handleStatusChange(event, {{ $ticket->id }})"
            >
                <option value="Open" {{ $ticket->status === 'Open' ? 'selected' : '' }}>Open</option>
                <option value="Pending" {{ $ticket->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
            </select>
            <div class="flex justify-end space-x-4">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="closeEditModal({{ $ticket->id }})">Cancel</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>


<!-- Delete Modal -->
<div id="deleteModal-{{ $ticket->id }}" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded shadow p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Confirm Delete</h2>
        <p>Are you sure you want to delete ticket ID: <strong>{{ $ticket->id }}</strong>?</p>
        <div class="mt-4 flex justify-end space-x-4">
            <button
                type="button"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded"
                onclick="closeDeleteModal({{ $ticket->id }})">
                Cancel
            </button>
            <form method="POST" action="{{ route('admin.tickets.delete', $ticket->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Confirm
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
