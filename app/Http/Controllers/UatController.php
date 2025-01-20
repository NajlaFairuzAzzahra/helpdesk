<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UatController extends Controller
{
    public function preparing()
    {
        return view('uat.preparing'); // resources/views/uat/preparing.blade.php
    }

    public function review()
    {
        return view('uat.review'); // resources/views/uat/review.blade.php
    }

    public function conduct()
    {
        return view('uat.conduct'); // resources/views/uat/conduct.blade.php
    }

    public function reviewIt()
    {
        return view('uat.review_it'); // resources/views/uat/review_it.blade.php
    }

    public function justify()
    {
        return view('uat.justify'); // resources/views/uat/justify.blade.php
    }

    public function monitoring()
    {
        return view('uat.monitoring'); // resources/views/uat/monitoring.blade.php
    }
}
