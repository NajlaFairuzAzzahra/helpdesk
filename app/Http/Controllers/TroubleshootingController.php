<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TroubleshootingController extends Controller
{
    public function index()
    {
        return view('troubleshooting');
    }
}
