<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimyController extends Controller
{
    /**
     * Display the SIMY dashboard.
     */
    public function index()
    {
        return view('simy');
    }
}
