<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $query = User::query();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Get statistics
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalSuperAdmins = User::where('role', 'super_admin')->count();
        $totalActive = User::where('is_active', true)->count();
        $totalInactive = User::where('is_active', false)->count();
        
        return view('dashboard.super_admin.users.index', compact('users', 'totalUsers', 'totalAdmins', 'totalSuperAdmins', 'totalActive', 'totalInactive'));
    }

    public function create()
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        return view('dashboard.super_admin.users.create');
    }

    public function store(Request $request)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        // Normalize email: trim whitespace and convert to lowercase
        $email = strtolower(trim($request->email));

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,super_admin',
            'is_active' => 'boolean',
        ]);

        // Double check email uniqueness with normalized email
        if (User::where('email', $email)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Email sudah terdaftar.']);
        }

        $resetToken = Str::random(32);

        User::create([
            'name' => trim($request->name),
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => $request->has('is_active') ? true : false,
            'reset_token' => $resetToken,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun berhasil dibuat! Token reset password: ' . $resetToken);
    }

    public function edit(User $user)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        // Allow editing all users
        return view('dashboard.super_admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        // Normalize email: trim whitespace and convert to lowercase
        $email = strtolower(trim($request->email));

        // Validation rules based on user role
        if (in_array($user->role, ['admin', 'super_admin'])) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
                'role' => 'required|in:admin,super_admin',
                'is_active' => 'boolean',
            ]);

            // Double check email uniqueness with normalized email (excluding current user)
            if (User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['email' => 'Email sudah terdaftar.']);
            }

            // Prevent changing role from admin to super_admin or vice versa
            if ($request->role !== $user->role) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['role' => 'Role tidak dapat diubah. Admin tidak dapat diubah menjadi Super Admin atau sebaliknya.']);
            }

            $data = [
                'name' => trim($request->name),
                'email' => $email,
                'role' => $user->role, // Keep original role
                'is_active' => $request->has('is_active') ? (bool)$request->is_active : $user->is_active, // Preserve current status if not provided
            ];
        } else {
            // For regular users, only allow name, email, password, and is_active changes
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
                'is_active' => 'boolean',
            ]);

            // Double check email uniqueness with normalized email (excluding current user)
            if (User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['email' => 'Email sudah terdaftar.']);
            }

            $data = [
                'name' => trim($request->name),
                'email' => $email,
                'role' => $user->role, // Keep original role (user)
                'is_active' => $request->has('is_active') ? (bool)$request->is_active : $user->is_active, // Preserve current status if not provided
            ];
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        // Allow deleting all users except yourself

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus!');
    }

    public function toggleStatus(User $user)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Prevent toggling your own status
        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'Tidak dapat mengubah status akun sendiri.'], 400);
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $user->is_active,
            'message' => $user->is_active ? 'Akun berhasil diaktifkan!' : 'Akun berhasil dinonaktifkan!'
        ]);
    }

    /**
     * Reset password for user (Super Admin only).
     */
    public function resetPassword(Request $request, User $user)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Password untuk ' . $user->name . ' berhasil direset!');
    }
}
