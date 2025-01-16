@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">IT S/W Work Order Request Form</h1>

    @if ($errors->any())
        <div class="mb-6 text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 text-green-500">
            {{ session('success') }}
        </div>
    @endif

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
            <label for="system" class="block text-gray-700 font-bold mb-2">System:</label>
            <select name="system" id="system" class="w-full px-3 py-2 border rounded" required>
                <option value="">-- Select System --</option>
                <option value="SAP">SAP</option>
                <option value="SAP Report">SAP Report</option>
                <option value="PAYROLL">PAYROLL</option>
                <option value="DDIS">DDIS</option>
                <option value="OPEX">OPEX</option>
                <option value="MSF">MSF</option>
            </select>
        </div>
        <div class="mb-6">
            <label for="sub_system" class="block text-gray-700 font-bold mb-2">Sub-system:</label>
            <select name="sub_system" id="sub_system" class="w-full px-3 py-2 border rounded" required>
                <option value="">-- Select Sub-system --</option>
            </select>
        </div>

        <!-- s/w wo   -->
        <div class="mb-6">
            <label for="sw_wo_type" class="block text-gray-700 font-bold mb-2">S/W WO Type:</label>
            <select name="sw_wo_type" id="sw_wo_type" class="w-full px-3 py-2 border rounded" required>
                <option value="">-- Select S/W WO Type --</option>
                <option value="Modification">Modification</option>
                <option value="Problem">Problem</option>
                <option value="Enhancement">Enhancement</option>
                <option value="Others">Others</option>
            </select>
        </div>

        <!-- Scope -->
        <div class="mb-6">
            <label for="scope" class="block text-gray-700 font-bold mb-2">Scope:</label>
            <textarea name="scope" id="scope" rows="3" class="w-full px-3 py-2 border rounded" required></textarea>
        </div>
        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-bold mb-2">Detail Description:</label>
            <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border rounded" required></textarea>
        </div>

        <!-- Submit -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>
@endsection
