@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Tickets</h1>
    <a href="{{ route('ticket.create') }}" class="btn btn-primary">Create New Ticket</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Status</th>
                <th>System</th>
                <th>Work Order Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->type }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->system }}</td>
                    <td>{{ $ticket->wo_type }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">View</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
