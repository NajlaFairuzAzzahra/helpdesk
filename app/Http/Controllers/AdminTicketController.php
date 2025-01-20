<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    // Dashboard Admin
    public function index(Request $request)
    {
        $query = Ticket::query();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tipe
        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan user
        if ($request->has('user') && $request->user !== '') {
            $query->where('user_id', $request->user);
        }

        $tickets = $query->with('user')->paginate(10);
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
