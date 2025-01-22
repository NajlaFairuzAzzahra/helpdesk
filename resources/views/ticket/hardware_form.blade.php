@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">IT H/W Work Order Request Form</h1>

    <form action="{{ route('ticket.software.submit') }}" method="POST">
        @csrf

        <!-- Order Metadata -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label for="order_id" class="block text-gray-700 font-bold mb-2">Order ID:</label>
                <input type="text" name="order_id" id="order_id" value="Auto number" class="w-full px-3 py-2 border rounded" readonly>
            </div>
            <div>
                <label for="request_date" class="block text-gray-700 font-bold mb-2">Request Date:</label>
                <input type="date" name="request_date" id="request_date" value="{{ now()->format('Y-m-d') }}" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div>
                <label for="organization" class="block text-gray-700 font-bold mb-2">Organization:</label>
                <input type="text" name="organization" id="organization" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div>
                <label for="requester" class="block text-gray-700 font-bold mb-2">Requester:</label>
                <input type="text" name="requester" id="requester" value="{{ auth()->user()->name }}" class="w-full px-3 py-2 border rounded" readonly>
            </div>
        </div>

        <!-- Dropdowns -->
        <div class="mb-6">
            <label for="infrastructure" class="block text-gray-700 font-bold mb-2">Infrastructure:</label>
            <select name="infrastructure" id="infrastructure" class="w-full px-3 py-2 border rounded" required>
                <option value="">-- Select Infrastructure --</option>
                <option value="Peripheral">Peripheral</option>
                <option value="Server">Server</option>
                <option value="Internet">Internet</option>
            </select>
        </div>
        <div class="mb-6">
            <label for="hardware" class="block text-gray-700 font-bold mb-2">Hardware:</label>
            <select name="hardware" id="hardware" class="w-full px-3 py-2 border rounded" required>
                <option value="">-- Select Hardware --</option>
            </select>

        <!-- Scope -->
        <div class="mb-6">
            <label for="scope" class="block text-gray-700 font-bold mb-2">Scope:</label>
            <textarea name="scope" id="scope" rows="5" class="w-full px-3 py-2 border rounded"></textarea>
        </div>
        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-bold mb-2">Detail Description:</label>
            <textarea name="description" id="description" rows="6" class="w-full px-3 py-2 border rounded"></textarea>
        </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>

<script>
    CKEDITOR.replace('scope', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script>

@endsection
