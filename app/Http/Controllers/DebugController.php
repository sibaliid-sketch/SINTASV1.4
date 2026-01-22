<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebugController extends Controller
{
    /**
     * Show current session data
     */
    public function sessionDebug(Request $request)
    {
        $sessionData = [
            'intended_redirect' => session('intended_redirect'),
            'auth_user' => auth()->check() ? auth()->user()->email : 'Not authenticated',
            'all_sessions' => $request->session()->all(),
        ];

        return response()->json($sessionData, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Test set session
     */
    public function setSession(Request $request)
    {
        $request->session()->put('intended_redirect', '/departments/operations/dashboard');
        
        return response()->json([
            'message' => 'Session set',
            'intended_redirect' => session('intended_redirect'),
        ]);
    }
}
