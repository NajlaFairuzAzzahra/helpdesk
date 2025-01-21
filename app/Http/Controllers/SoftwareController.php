<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class SoftwareController extends Controller
{
    public function monitoring(Request $request)
{
    $query = Ticket::where('type', 'software');

    // Filter berdasarkan status
    if ($request->has('status') && $request->status !== '') {
        $query->where('status', $request->status);
    }

    // Filter berdasarkan pencarian (misalnya berdasarkan Ticket ID)
    if ($request->has('search') && $request->search !== '') {
        $query->where('id', 'like', '%' . $request->search . '%');
    }

    // Sortir berdasarkan kolom (jika ada parameter sort)
    if ($request->has('sort') && in_array($request->sort, ['id', 'status', 'created_at'])) {
        $sortOrder = $request->get('order', 'asc'); // Default ascending
        $query->orderBy($request->sort, $sortOrder);
    } else {
        $query->orderBy('created_at', 'desc'); // Default sort by created_at
    }

    $tickets = $query->paginate(10);

    return view('software.monitoring', compact('tickets'));
    }
}
