<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BkDashboardController extends Controller
{
    public function index()
    {
        return view('backroom.dashboard');
    }
}
