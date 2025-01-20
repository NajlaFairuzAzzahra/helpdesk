@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Your Troubleshooting Tickets</h1>
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="py-2 px-4">Ticket ID</th>
                <th class="py-2 px-4">Status</th>
                <th class="py-2 px-4">Created At</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td class="py-2 px-4">{{ $ticket->id }}</td>
                    <td class="py-2 px-4">{{ $ticket->status }}</td>
                    <td class="py-2 px-4">{{ $ticket->created_at->format('d M Y') }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('user.troubleshooting.show', $ticket->id) }}" class="text-blue-500 hover:underline">View</a>
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
