@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Ticket Details</h1>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Ticket ID: {{ $ticket->id }}</h2>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-700"><strong>Type:</strong> {{ $ticket->type }}</p>
                <p class="text-gray-700"><strong>Status:</strong> {{ $ticket->status }}</p>
                <p class="text-gray-700"><strong>Requester:</strong> {{ $ticket->user->name }}</p>
                <p class="text-gray-700"><strong>Submitted At:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-700"><strong>System:</strong> {{ $ticket->system ?? 'N/A' }}</p>
                <p class="text-gray-700"><strong>Sub-System:</strong> {{ $ticket->sub_system ?? 'N/A' }}</p>
                <p class="text-gray-700"><strong>Infrastructure:</strong> {{ $ticket->infrastructure ?? 'N/A' }}</p>
                <p class="text-gray-700"><strong>Hardware:</strong> {{ $ticket->hardware ?? 'N/A' }}</p>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-bold mb-2">Scope:</h3>
            <p class="text-gray-700">{{ $ticket->scope }}</p>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-bold mb-2">Description:</h3>
            <p class="text-gray-700">{{ $ticket->description }}</p>
        </div>

        @if($ticket->response)
        <div class="mt-6">
            <h3 class="text-lg font-bold mb-2">Response:</h3>
            <p class="text-gray-700">{{ $ticket->response }}</p>
        </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
