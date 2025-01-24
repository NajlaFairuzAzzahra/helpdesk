@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
   <h1 class="text-3xl font-bold text-gray-700 mb-6">IT H/W Work Order Request Form</h1>

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

   <form id="hardwareForm" action="{{ route('ticket.hardware.submit') }}" method="POST">
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

       <!-- Infrastructure & Hardware Selection -->
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
           <select name="hardware" id="hardware" class="w-full px-3 py-2 border rounded" required disabled>
               <option value="">-- Select Hardware --</option>
           </select>
       </div>

       <!-- Scope & Description -->
       <div class="mb-6">
           <label for="scope" class="block text-gray-700 font-bold mb-2">Scope:</label>
           <textarea name="scope" id="scope" rows="5" class="w-full px-3 py-2 border rounded" required></textarea>
       </div>

       <div class="mb-6">
           <label for="description" class="block text-gray-700 font-bold mb-2">Detail Description:</label>
           <textarea name="description" id="description" rows="6" class="w-full px-3 py-2 border rounded" required></textarea>
       </div>

       <!-- Submit Button -->
       <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
   </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
   const infrastructureSelect = document.getElementById('infrastructure');
   const hardwareSelect = document.getElementById('hardware');
   const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

   async function updateHardwareOptions(infrastructure) {
       try {
           const response = await fetch(`/get-hardwares?infrastructure=${infrastructure}`, {
               headers: {
                   'X-CSRF-TOKEN': csrfToken,
                   'Accept': 'application/json'
               }
           });

           if (!response.ok) throw new Error('Network response was not ok');

           const data = await response.json();

           hardwareSelect.innerHTML = '<option value="">-- Select Hardware --</option>';
           data.forEach(hardware => {
               const option = document.createElement('option');
               option.value = hardware;
               option.textContent = hardware;
               hardwareSelect.appendChild(option);
           });

           hardwareSelect.disabled = false;

       } catch (error) {
           console.error('Error fetching hardware options:', error);
           hardwareSelect.innerHTML = '<option value="">Error loading options</option>';
       }
   }

   if (infrastructureSelect) {
       infrastructureSelect.addEventListener('change', function(e) {
           e.preventDefault();
           hardwareSelect.disabled = true;

           if (this.value) {
               updateHardwareOptions(this.value);
           } else {
               hardwareSelect.innerHTML = '<option value="">-- Select Hardware --</option>';
               hardwareSelect.disabled = true;
           }
       });
   }
});

// CKEditor Configuration
CKEDITOR.replace('scope', {
   filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
   filebrowserUploadMethod: 'form'
});

CKEDITOR.replace('description', {
   filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
   filebrowserUploadMethod: 'form'
});
</script>
@endpush
@endsection
