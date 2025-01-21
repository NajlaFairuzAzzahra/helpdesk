<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Show the list of tickets
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->get();
        return view('ticket.index', compact('tickets'));
    }

    // Show the form for creating a new software ticket
    public function showSoftwareForm()
    {
        return view('ticket.software_form'); // Pastikan file view ini ada
    }

    public function showHardwareForm()
    {
        return view('ticket.hardware_form'); // Pastikan file view ini ada
    }

    public function monitoring(Request $request)
    {
        $query = Ticket::where('user_id', Auth::id());

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search !== '') {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        // Paginate tiket
        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('ticket.monitoring', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('ticket.show', compact('ticket'));
    }

    public function submitSoftwareTicket(Request $request)
    {
        $request->validate([
            'system' => 'required',
            'sub_system' => 'required',
            'scope' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'type' => 'software',
            'status' => 'Open',
            'system' => $request->system,
            'sub_system' => $request->sub_system,
            'scope' => $request->scope,
            'description' => $request->description,
        ]);

        // Redirect ke dashboard user
        return redirect()->route('user.dashboard')->with('success', 'Software ticket submitted successfully!');
    }

    // Store a new ticket
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'system' => 'nullable',
            'sub_system' => 'nullable',
            'wo_type' => 'required',
            'scope' => 'required',
            'description' => 'required',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'system' => $request->system,
            'sub_system' => $request->sub_system,
            'wo_type' => $request->wo_type,
            'scope' => $request->scope,
            'description' => $request->description,
        ]);

        return redirect()->route('ticket.index')->with('success', 'Ticket created successfully!');
    }
    public function getSubSystems(Request $request)
    {
        $system = $request->query('system');
        $subSystems = [];

        switch ($system) {
            case 'SAP':
                $subSystems = ['Material Management (MM)', 'Sales Distribution', 'Production Planning', 'Plant Maintenance (PM)'];
                break;
            case 'SAP Report':
                $subSystems = ['All Module'];
                break;
            case 'PAYROLL':
                $subSystems = ['Module'];
                break;
            case 'DDIS':
                $subSystems = ['Sales'];
                break;
            case 'OPEX':
                $subSystems = ['Sales'];
                break;
            case 'MSF':
                $subSystems = ['Sales'];
                break;
        }

        return response()->json($subSystems);
    }

    public function getHardwares(Request $request)
    {
        $infrastructure = $request->query('infrastructure');
        $hardwares = [];

        switch ($infrastructure) {
            case 'Peripheral':
                $hardwares = ['Computer', 'Printer', 'FAX', 'Scanner', 'Telephone', 'Modem', 'Others'];
                break;
            case 'Server':
                $hardwares = ['Email Server', 'SAP Server', 'Web Server'];
                break;
            case 'Internet':
                $hardwares = ['-'];
                break;
        }

        return response()->json($hardwares);
    }

    public function submitHardwareTicket(Request $request)
    {
        $request->validate([
            'infrastructure' => 'required',
            'hardware' => 'required',
            'scope' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'type' => 'hardware',
            'status' => 'Open',
            'system' => $request->infrastructure,
            'sub_system' => $request->hardware,
            'scope' => $request->scope,
            'description' => $request->description,
        ]);

        // Redirect ke dashboard user
        return redirect()->route('user.dashboard')->with('success', 'Hardware ticket submitted successfully!');
    }

    public function workOrderList(Request $request)
    {
        $query = Ticket::where('user_id', Auth::id());

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search !== '') {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        // Paginate tiket
        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('ticket.work_order_list', compact('tickets'));
    }


}
