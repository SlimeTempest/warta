<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Check if user is active
            if (!Auth::user()->is_active) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Akun Anda telah dinonaktifkan.',
                ]);
            }

            return $this->redirectToDashboard();
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => true,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        // Logout and clear remember me cookie
        Auth::logout();
        
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear remember me cookie by setting it to expire in the past
        // Laravel's remember cookie name format: remember_web_{hash}
        $cookieName = 'remember_web_' . hash('sha256', config('app.key'));
        $cookie = Cookie::forget($cookieName);
        
        return redirect()->route('login')->withCookie($cookie);
    }

    protected function redirectToDashboard()
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'super_admin':
                return redirect()->route('dashboard.super_admin');
            case 'admin':
                return redirect()->route('dashboard.admin');
            case 'user':
                return redirect()->route('dashboard.user');
            default:
                return redirect()->route('login');
        }
    }
}
