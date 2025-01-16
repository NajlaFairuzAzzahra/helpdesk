<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function showSoftwareForm()
    {
        return view('ticket.software_form');
    }

    public function submitSoftwareTicket(Request $request)
    {
        $request->validate([
            'system' => 'required',
            'sub_system' => 'required',
            'sw_wo_type' => 'required', // Tambahkan validasi untuk S/W WO Type
            'scope' => 'required',
            'description' => 'required',
        ]);

        // Simpan data ke database atau logic lain
        // Ticket::create($request->all());

        return redirect()->route('ticket.software.form')->with('success', 'Ticket created successfully.');
    }

    public function getSubSystems(Request $request)
    {
        $system = $request->input('system');
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

    public function showHardwareForm()
{
    return view('ticket.hardware_form');
}

public function submitHardwareTicket(Request $request)
{
    $request->validate([
        'infrastructure' => 'required',
        'hardware' => 'required',
        'scope' => 'required',
        'description' => 'required',
    ]);

    // Simpan data ke database atau logic lain
    return redirect()->route('ticket.hardware.form')->with('success', 'Hardware ticket created successfully.');
}

public function getHardwares(Request $request)
{
    $infrastructure = $request->input('infrastructure');
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



}
