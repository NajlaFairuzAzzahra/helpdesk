<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    public function monitoring(Request $request)
    {
        // Filter data berdasarkan type hardware
        $query = Ticket::where('type', 'hardware');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan Ticket ID
        if ($request->has('search') && $request->search !== '') {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        // Ambil data yang sudah difilter dan paginate
        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('hardware.monitoring', compact('tickets'));
    }
}
