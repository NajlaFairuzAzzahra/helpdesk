<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TroubleshootingController extends Controller
{
    // User - Lihat semua tiket troubleshooting miliknya
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->where('type', 'Troubleshooting')->get();
        return view('troubleshooting.user_index', compact('tickets'));
    }

    // User - Lihat detail tiket troubleshooting
    public function show($id)
    {
        $ticket = Ticket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('troubleshooting.user_show', compact('ticket'));
    }

    // Admin - Lihat semua tiket troubleshooting
    public function adminIndex()
    {
        $tickets = Ticket::where('type', 'Troubleshooting')->get();
        return view('troubleshooting.admin_index', compact('tickets'));
    }

    // Admin - Berikan respons untuk tiket troubleshooting
    public function respond(Request $request, $id)
    {
        $request->validate([
            'response' => 'required',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->response = $request->response;
        $ticket->save();

        return redirect()->route('admin.troubleshooting')->with('success', 'Response sent successfully!');
    }
}
