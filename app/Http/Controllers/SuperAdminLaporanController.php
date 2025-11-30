<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Instansi;
use Illuminate\Http\Request;

class SuperAdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $query = Laporan::with(['user', 'instansi', 'admin']);

        // Search by judul, deskripsi, or lokasi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by instansi
        if ($request->filled('instansi_id') && $request->instansi_id !== 'all') {
            $query->where('instansi_id', $request->instansi_id);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by admin
        if ($request->filled('admin_id')) {
            if ($request->admin_id === 'unassigned') {
                $query->whereNull('admin_id');
            } else {
                $query->where('admin_id', $request->admin_id);
            }
        }

        $laporan = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Get statistics
        $totalLaporan = Laporan::count();
        $terkirim = Laporan::where('status', 'terkirim')->count();
        $diverifikasi = Laporan::where('status', 'diverifikasi')->count();
        $diproses = Laporan::where('status', 'diproses')->count();
        $selesai = Laporan::where('status', 'selesai')->count();
        $ditolak = Laporan::where('status', 'ditolak')->count();

        // Get all instansi for filter
        $instansi = Instansi::orderBy('nama')->get();

        // Get all admins for filter
        $admins = \App\Models\User::where('role', 'admin')->orderBy('name')->get();

        return view('dashboard.super_admin.laporan.index', compact('laporan', 'totalLaporan', 'terkirim', 'diverifikasi', 'diproses', 'selesai', 'ditolak', 'instansi', 'admins'));
    }

    public function show(Laporan $laporan)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $laporan->load(['user', 'instansi', 'admin', 'statusHistory.changedBy']);
        $instansi = Instansi::where('status', 'active')->orderBy('nama')->get();

        return view('dashboard.super_admin.laporan.show', compact('laporan', 'instansi'));
    }

    public function edit(Laporan $laporan)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        $instansi = Instansi::where('status', 'active')->orderBy('nama')->get();

        return view('dashboard.super_admin.laporan.edit', compact('laporan', 'instansi'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        // Super admin can edit any laporan regardless of status (for maintenance/emergency purposes)
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'instansi_id' => 'required|exists:instansi,id',
            'status' => 'required|in:terkirim,diverifikasi,diproses,ditolak,selesai',
            'bukti_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Validate instansi exists (already validated by exists rule, but check for safety)
        $instansi = Instansi::findOrFail($request->instansi_id);

        $buktiFiles = $laporan->bukti_files ?? [];

        // Handle new file uploads with total size validation
        if ($request->hasFile('bukti_files')) {
            $totalSize = 0;
            $maxTotalSize = 50 * 1024 * 1024; // 50MB total
            
            foreach ($request->file('bukti_files') as $file) {
                $totalSize += $file->getSize();
            }
            
            if ($totalSize > $maxTotalSize) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['bukti_files' => 'Total ukuran file tidak boleh melebihi 50MB.']);
            }
            
            foreach ($request->file('bukti_files') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/bukti'), $filename);
                $buktiFiles[] = 'uploads/bukti/' . $filename;
            }
        }

        // Handle file deletion
        if ($request->has('delete_files')) {
            foreach ($request->delete_files as $fileToDelete) {
                if (file_exists(public_path($fileToDelete))) {
                    unlink(public_path($fileToDelete));
                }
                $buktiFiles = array_filter($buktiFiles, function($file) use ($fileToDelete) {
                    return $file !== $fileToDelete;
                });
            }
            $buktiFiles = array_values($buktiFiles); // Re-index array
        }

        // Save old status before update
        $statusLama = $laporan->status;
        $statusBaru = $request->status;
        $statusChanged = $statusLama !== $statusBaru;

        $laporan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'instansi_id' => $request->instansi_id,
            'status' => $statusBaru,
            'bukti_files' => !empty($buktiFiles) ? $buktiFiles : null,
        ]);

        // Create status history if status changed
        if ($statusChanged) {
            \App\Models\StatusHistory::create([
                'laporan_id' => $laporan->id,
                'status_lama' => $statusLama,
                'status_baru' => $statusBaru,
                'catatan' => 'Laporan diubah oleh Super Admin',
                'changed_by' => auth()->id(),
            ]);
        }

        return redirect()->route('super-admin.laporan.show', $laporan)
            ->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Laporan $laporan)
    {
        // Check if user is super admin
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        // Super admin can delete any laporan regardless of status (for maintenance/emergency purposes)
        // Delete files
        if ($laporan->bukti_files) {
            foreach ($laporan->bukti_files as $file) {
                if (file_exists(public_path($file))) {
                    unlink(public_path($file));
                }
            }
        }

        $laporan->delete();

        return redirect()->route('super-admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus!');
    }
}

