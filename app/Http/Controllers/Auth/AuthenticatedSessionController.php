<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Store redirect URL in session for after welcome page
        $user = Auth::user();
        $redirectUrl = $this->getRedirectUrlForRole($user);

        // Method 1: Store in session
        $request->session()->put('intended_redirect', $redirectUrl);

        // Method 2: Also pass as query parameter for fallback
        // This way if session fails, we still have the redirect URL
        $welcomeRoute = match ($user->role) {
            'guardian' => 'sitra.welcome',
            default => 'sintas.welcome',
        };

        return redirect()
            ->route($welcomeRoute)
            ->with('intended_redirect', $redirectUrl);
    }

    /**
     * Get the redirect URL based on user role and department.
     */
    private function getRedirectUrlForRole($user): ?string
    {
        $redirectUrl = match ($user->role) {
            'student_under_18', 'student_over_18' => '/simy',
            'guardian' => '/sitra/welcome',
            'superadmin' => '/sintas',
            'admin' => '/departments/operations',
            'admin_operational' => '/departments/operations',
            'karyawan', 'employee' => '/sintas/welcome',
            default => '/sintas',
        };

        // Ensure URL is properly formatted
        return trim($redirectUrl, '/') ? '/' . trim($redirectUrl, '/') : '/sintas';
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/welcome-guest');
    }
}
