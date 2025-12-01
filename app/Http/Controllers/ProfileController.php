<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the user profile.
     */
    public function show()
    {
        $user = Auth::user();
        
        // Load relationships based on role
        if ($user->role === 'admin') {
            $user->load('instansi');
        }
        
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Normalize email: trim whitespace and convert to lowercase
        $email = strtolower(trim($request->email));

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Double check email uniqueness with normalized email (excluding current user)
        if (User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Email sudah terdaftar.']);
        }

        $user->update([
            'name' => trim($request->name),
            'email' => $email,
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        // Update password
        // Note: Token reset password TIDAK berubah saat mengubah password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Password berhasil diubah!');
    }

    /**
     * Generate new reset token for user.
     */
    public function generateNewToken()
    {
        $user = Auth::user();
        $newToken = Str::random(32);
        
        $user->update([
            'reset_token' => $newToken,
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Token reset password baru berhasil dibuat: ' . $newToken . ' - Simpan token ini dengan aman!');
    }
}

