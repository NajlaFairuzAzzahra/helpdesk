@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">User Dashboard</h1>
    <p class="mb-4">Pilih jenis tiket yang ingin Anda buat:</p>

    <div class="flex space-x-4">
        <a href="{{ route('ticket.software.form') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            IT S/W Work Order Request
        </a>
        <a href="{{ route('ticket.hardware.form') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            IT H/W Work Order Request
        </a>
    </div>
</div>
@endsection
