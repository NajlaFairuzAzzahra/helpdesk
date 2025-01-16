@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Submit a Ticket</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('ticket.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
            <input type="text" name="title" id="title" class="w-full px-3 py-2 border rounded focus:outline-none" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
            <textarea name="description" id="description" class="w-full px-3 py-2 border rounded focus:outline-none" rows="4" required></textarea>
        </div>
        <div class="mb-4">
            <label for="attachment" class="block text-gray-700 font-bold mb-2">Attachment:</label>
            <input type="file" name="attachment" id="attachment" class="w-full px-3 py-2 border rounded focus:outline-none">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Ticket</button>
    </form>
</div>
@endsection
