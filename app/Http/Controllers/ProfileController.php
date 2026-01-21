<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        $user = $request->user();

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && \Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                \Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.jpg';

            // Store the file
            $path = $request->file('avatar')->storeAs('avatars', $filename, 'public');

            // Update user
            $user->update(['avatar' => $filename]);
        }

        return response()->json(['success' => true, 'message' => 'Avatar updated successfully']);
    }

    /**
     * Update the user's preferences.
     */
    public function updatePreferences(Request $request): RedirectResponse
    {
        $request->validate([
            'language' => 'required|in:en,id',
            'email_notifications' => 'boolean',
        ]);

        $user = $request->user();
        $user->update([
            'language' => $request->language,
            'notification_settings' => array_merge($user->notification_settings ?? [], [
                'email_notifications' => $request->boolean('email_notifications'),
            ]),
        ]);

        return Redirect::route('profile.edit')->with('status', 'preferences-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
