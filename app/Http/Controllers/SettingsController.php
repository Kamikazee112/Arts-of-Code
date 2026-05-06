<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . auth()->id()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'bio' => ['nullable', 'string'],
        ]);

        auth()->user()->update($validated);

        // Update or create profile
        if (auth()->user()->profile) {
            auth()->user()->profile->update([
                'bio' => $validated['bio'] ?? null,
            ]);
        } else {
            auth()->user()->profile()->create([
                'bio' => $validated['bio'] ?? null,
            ]);
        }

        return back()->with('profile_success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('password_success', 'Password updated successfully!');
    }
}
