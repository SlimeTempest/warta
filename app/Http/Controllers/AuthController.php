<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
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

        // Normalize email: trim whitespace and convert to lowercase
        $email = strtolower(trim($request->email));
        
        $credentials = [
            'email' => $email,
            'password' => $request->password,
        ];
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
        // Normalize email: trim whitespace and convert to lowercase
        $email = strtolower(trim($request->email));
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Double check email uniqueness with normalized email
        if (User::where('email', $email)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Email sudah terdaftar.']);
        }

        $resetToken = Str::random(32);

        $user = User::create([
            'name' => trim($request->name),
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => true,
            'reset_token' => $resetToken,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Token reset password Anda: ' . $resetToken . ' - Simpan token ini dengan aman!');
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
