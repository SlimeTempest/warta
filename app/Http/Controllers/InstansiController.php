<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $query = Instansi::query();

        // Search by nama or alamat
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $instansi = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Get statistics
        $totalInstansi = Instansi::count();
        $activeInstansi = Instansi::where('status', 'active')->count();
        $suspendedInstansi = Instansi::where('status', 'suspended')->count();

        return view('dashboard.super_admin.instansi.index', compact('instansi', 'totalInstansi', 'activeInstansi', 'suspendedInstansi'));
    }

    public function create()
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        return view('dashboard.super_admin.instansi.create');
    }

    public function store(Request $request)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'status' => 'required|in:active,suspended',
        ]);

        Instansi::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ]);

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil dibuat!');
    }

    public function edit(Instansi $instansi)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        return view('dashboard.super_admin.instansi.edit', compact('instansi'));
    }

    public function update(Request $request, Instansi $instansi)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $instansi->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            // Status tidak diubah dari edit form, hanya bisa di-toggle dari index
        ]);

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil diperbarui!');
    }

    public function destroy(Instansi $instansi)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        // Check if instansi has any laporan
        if ($instansi->laporan()->count() > 0) {
            return redirect()->route('instansi.index')
                ->with('error', 'Instansi tidak dapat dihapus karena masih memiliki laporan. Silakan tangguhkan instansi terlebih dahulu.');
        }

        // Check if instansi has any admins assigned
        if ($instansi->admins()->count() > 0) {
            return redirect()->route('instansi.index')
                ->with('error', 'Instansi tidak dapat dihapus karena masih memiliki admin yang ditugaskan. Silakan hapus assignment admin terlebih dahulu.');
        }

        $instansi->delete();

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil dihapus!');
    }

    public function toggleStatus(Instansi $instansi)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $newStatus = $instansi->status === 'active' ? 'suspended' : 'active';
        $instansi->update([
            'status' => $newStatus
        ]);

        return response()->json([
            'success' => true,
            'status' => $instansi->status,
            'message' => $instansi->status === 'active' ? 'Instansi berhasil diaktifkan!' : 'Instansi berhasil ditangguhkan!'
        ]);
    }
}
