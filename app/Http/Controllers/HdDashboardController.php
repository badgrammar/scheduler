<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HdDashboardController extends Controller
{
    public function index()
    {
        return view('helpdesk.dashboard');
    }
}
