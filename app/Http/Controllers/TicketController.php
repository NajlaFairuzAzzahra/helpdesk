<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|file|max:2048',
        ]);

        // Store ticket logic (dummy for now)
        return back()->with('success', 'Ticket submitted successfully!');
    }
}
