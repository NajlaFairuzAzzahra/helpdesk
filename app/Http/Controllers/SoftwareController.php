<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class SoftwareController extends Controller
{
    public function monitoring(Request $request)
{
    $query = Ticket::where('type', 'software');

    if ($request->has('status') && $request->status !== '') {
        $query->where('status', $request->status);
    }

    if ($request->has('search') && $request->search !== '') {
        $query->where('id', 'like', '%' . $request->search . '%');
    }

    $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('software_monitoring', compact('tickets'));
}

}
