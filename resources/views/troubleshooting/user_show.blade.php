@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Ticket Details</h1>
    <div class="bg-white shadow rounded p-6">
        <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
        <p><strong>Status:</strong> {{ $ticket->status }}</p>
        <p><strong>Issue:</strong> {{ $ticket->description }}</p>
        <p><strong>Admin Response:</strong> {{ $ticket->response ?? 'No response yet' }}</p>
    </div>
    <a href="{{ route('user.troubleshooting') }}" class="text-blue-500 hover:underline mt-4 inline-block">Back</a>
</div>
@endsection
