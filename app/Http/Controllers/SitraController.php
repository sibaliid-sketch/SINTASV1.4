<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitraController extends Controller
{
    /**
     * Display the SITRA dashboard.
     */
    public function index()
    {
        return view('sitra');
    }
}
