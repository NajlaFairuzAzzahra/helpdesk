@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">All Troubleshooting Tickets</h1>
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="py-2 px-4">Ticket ID</th>
                <th class="py-2 px-4">User</th>
                <th class="py-2 px-4">Status</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td class="py-2 px-4">{{ $ticket->id }}</td>
                    <td class="py-2 px-4">{{ $ticket->user->name }}</td>
                    <td class="py-2 px-4">{{ $ticket->status }}</td>
                    <td class="py-2 px-4">
                        <form action="{{ route('admin.troubleshooting.respond', $ticket->id) }}" method="POST">
                            @csrf
                            <textarea name="response" class="border rounded w-full px-3 py-2" placeholder="Enter response">{{ $ticket->response }}</textarea>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-2">Send Response</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
