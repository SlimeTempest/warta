<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    /**
     * Show the form for resetting password with token.
     */
    public function showResetForm()
    {
        if (auth()->check()) {
            $user = auth()->user();
            switch ($user->role) {
                case 'super_admin':
                    return redirect()->route('dashboard.super_admin');
                case 'admin':
                    return redirect()->route('dashboard.admin');
                default:
                    return redirect()->route('dashboard.user');
            }
        }
        return view('auth.passwords.reset');
    }

    /**
     * Reset password using token.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'reset_token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Normalize email: trim whitespace and convert to lowercase
        $email = strtolower(trim($request->email));

        $user = User::where('email', $email)
            ->where('reset_token', $request->reset_token)
            ->first();

        if (!$user) {
            return back()->withErrors(['reset_token' => 'Email atau token reset password tidak valid.']);
        }

        if (!$user->is_active) {
            return back()->withErrors(['email' => 'Akun Anda telah dinonaktifkan.']);
        }

        // Update password
        // Note: Token reset password TIDAK diubah, masih bisa digunakan lagi di masa depan
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }
}

