<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AdminTicketController extends Controller
{
    // Dashboard Admin
    public function index(Request $request)
    {
        $query = Ticket::query();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tipe (Software/Hardware)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan pengguna
        if ($request->filled('user')) {
            $query->where('user_id', $request->user);
        }

        // Ambil tiket dengan paginasi
        $tickets = $query->with('user')->paginate(10);

        // Semua pengguna untuk dropdown
        $users = User::all();

        return view('admin.dashboard', compact('tickets', 'users'));
    }


    // Update Status Tiket
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('admin.dashboard')->with('success', 'Ticket status updated successfully!');
    }
}
