<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    // Dashboard Admin with Filters and Search
    public function index(Request $request)
    {
        $query = Ticket::query();

        // Filter by Status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by Ticket ID or Search Query
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by User ID
        if ($request->has('user') && $request->user !== '') {
            $query->where('user_id', $request->user);
        }

        // Get Paginated Results
        $tickets = $query->with('user')->paginate(10);

        // Get All Users for Filtering Dropdown
        $users = User::all();

        return view('admin.dashboard', compact('tickets', 'users'));
    }

    // Update Ticket Status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Open,Pending,Closed',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->save();

        return back()->with('success', 'Ticket status updated successfully.');
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'status' => 'required',
    ]);

    $ticket = Ticket::findOrFail($id);
    $ticket->status = $request->status;
    $ticket->save();

    return redirect()->route('admin.dashboard')->with('success', 'Ticket updated successfully.');
    }


    public function show($id)
    {
    $ticket = Ticket::with('user')->findOrFail($id);

    return view('admin.tickets.show', compact('ticket'));
    }



    // Delete a Ticket
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return back()->with('success', 'Ticket deleted successfully.');
    }

    // Respond to Troubleshooting Tickets
    public function respondToTroubleshooting(Request $request)
    {
        $request->validate([
            'response' => 'required|string',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $ticket->response = $request->response;
        $ticket->save();

        return back()->with('success', 'Response sent to user.');
    }
}
