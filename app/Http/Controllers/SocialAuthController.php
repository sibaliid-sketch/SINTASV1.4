<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                // Check if user exists with same email
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if ($existingUser) {
                    // Link Google account to existing user
                    $existingUser->update([
                        'google_id' => $googleUser->getId(),
                        'google_token' => $googleUser->token,
                        'google_refresh_token' => $googleUser->refreshToken,
                    ]);
                    $user = $existingUser;
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'google_token' => $googleUser->token,
                        'google_refresh_token' => $googleUser->refreshToken,
                        'avatar' => $googleUser->getAvatar(),
                        'password' => Hash::make(Str::random(24)),
                        'email_verified_at' => now(),
                        'referral_code' => Str::random(8),
                    ]);
                }
            } else {
                // Update tokens
                $user->update([
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                ]);
            }

            // Update login statistics
            $user->update([
                'login_count' => $user->login_count + 1,
                'last_login_at' => now(),
            ]);

            Auth::login($user);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google authentication failed. Please try again.');
        }
    }

    public function disconnectGoogle(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'google_id' => null,
            'google_token' => null,
            'google_refresh_token' => null,
        ]);

        return back()->with('success', 'Google account disconnected successfully.');
    }
}
