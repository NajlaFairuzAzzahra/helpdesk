@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Ticket Details</h1>

    <div class="bg-white shadow rounded p-6">
        <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
        <p><strong>Type:</strong> {{ ucfirst($ticket->type) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
        <p><strong>System:</strong> {{ $ticket->system ?? '-' }}</p>
        <p><strong>Sub-system:</strong> {{ $ticket->sub_system ?? '-' }}</p>
        <p><strong>Scope:</strong> {!! nl2br(e($ticket->scope)) !!}</p>
        <p><strong>Description:</strong> {!! nl2br(e($ticket->description)) !!}</p>
        <p><strong>Created At:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}</p>
    </div>

    <a href="{{ route('user.tickets.monitoring') }}" class="mt-4 inline-block text-blue-500 hover:underline">Back to Tickets</a>
</div>
@endsection
