<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    public function list()
    {
        return view('software.list');
    }

    public function monitoring()
    {
        return view('software.monitoring');
    }
}
