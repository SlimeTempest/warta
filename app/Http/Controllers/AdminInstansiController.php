<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instansi;

class AdminInstansiController extends Controller
{
    public function index()
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $admins = User::whereIn('role', ['admin', 'super_admin'])
            ->with('instansi')
            ->orderBy('name')
            ->get();
        
        $instansi = Instansi::with('admins')->orderBy('nama')->get();
        
        return view('dashboard.super_admin.admin_instansi.index', compact('admins', 'instansi'));
    }

    public function store(Request $request)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'instansi_id' => 'required|exists:instansi,id',
        ]);

        $user = User::findOrFail($request->user_id);
        
        // Validate that user is admin or super_admin
        if (!in_array($user->role, ['admin', 'super_admin'])) {
            return redirect()->back()->with('error', 'Hanya admin atau super admin yang dapat ditugaskan ke instansi.');
        }
        
        // Check if already assigned
        if ($user->instansi()->where('instansi_id', $request->instansi_id)->exists()) {
            return redirect()->back()->with('error', 'Admin sudah terdaftar di instansi tersebut.');
        }

        $user->instansi()->attach($request->instansi_id);

        return redirect()->back()->with('success', 'Admin berhasil ditambahkan ke instansi!');
    }

    public function destroy(Request $request, $userId, $instansiId)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);
        $user->instansi()->detach($instansiId);

        return redirect()->back()->with('success', 'Admin berhasil dihapus dari instansi!');
    }
}
