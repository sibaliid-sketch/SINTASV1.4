<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'student' || $user->role === 'student_under_18') {
            return redirect()->route('simy');
        } elseif ($user->role === 'guardian') {
            return redirect()->route('sitra');
        } elseif ($user->role === 'karyawan' || $user->role === 'admin') {
            return redirect()->route('sintas.welcome');
        } else {
            return view('dashboard');
        }
    }
}
