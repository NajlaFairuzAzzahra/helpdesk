<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TicketController extends Controller
{
    // Display the list of tickets for the authenticated user
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->paginate(10);
        return view('ticket.index', compact('tickets'));
    }

    // Display the software ticket form
    public function showSoftwareForm()
    {
        return view('ticket.software_form');
    }

    // Display the hardware ticket form
    public function showHardwareForm()
    {
        return view('ticket.hardware_form');
    }

    // Display monitoring tickets with filters
    public function monitoring(Request $request)
    {
        $query = Ticket::where('user_id', Auth::id());

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search !== '') {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('ticket.monitoring', compact('tickets'));
    }

    // Display a single ticket details
    public function show($id)
    {
        $ticket = Ticket::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();
        return view('ticket.show', compact('ticket'));
    }

    // Submit a new software ticket
    public function submitSoftwareTicket(Request $request)
    {
        $request->validate([
            'system' => 'required|string',
            'sub_system' => 'required|string',
            'sw_wo_type' => 'required|string',
            'scope' => 'required|string',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'type' => 'Software',
            'system' => $request->system,
            'sub_system' => $request->sub_system,
            'wo_type' => $request->sw_wo_type,
            'scope' => $request->scope,
            'description' => $request->description,
            'status' => 'Open',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Software ticket submitted successfully.');
    }

    // Submit a new hardware ticket
    public function submitHardwareTicket(Request $request)
    {
        $request->validate([
            'infrastructure' => 'required|string',
            'hardware' => 'required|string',
            'scope' => 'required|string',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'type' => 'Hardware',
            'infrastructure' => $request->infrastructure,
            'hardware' => $request->hardware,
            'scope' => $request->scope,
            'description' => $request->description,
            'status' => 'Open',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Hardware ticket submitted successfully.');
    }

    // Get subsystems dynamically based on the selected system
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
            default:
                $subSystems = ['No Subsystems Available'];
        }

        return response()->json($subSystems);
    }

    // Get hardware dynamically based on the selected infrastructure
    public function getHardwares(Request $request)
    {
        return response()->json(match($request->infrastructure) {
            'Peripheral' => ['Computer', 'Printer', 'FAX', 'Scanner', 'Telephone', 'Modem', 'Others'],
            'Server' => ['Email Server', 'SAP Server', 'Web Server'],
            'Internet' => ['-'],
            default => [],
        });
    }

    // Display the user's work order list
    public function workOrderList(Request $request)
    {
        $query = Ticket::where('user_id', Auth::id());

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search !== '') {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('ticket.work_order_list', compact('tickets'));
    }

    // Delete a ticket
    public function destroy($id)
    {
        $ticket = Ticket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $ticket->delete();

        return redirect()->route('user.tickets.monitoring')->with('success', 'Ticket deleted successfully.');
    }
}
