<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query();

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        if ($request->has('user') && $request->user !== '') {
            $query->where('user_id', $request->user);
        }

        $tickets = $query->with('user')->paginate(10);
        $users = \App\Models\User::all();

        return view('admin.dashboard', compact('tickets', 'users'));
    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status updated successfully!');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Ticket deleted successfully!');
    }
}
