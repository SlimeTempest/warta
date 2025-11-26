<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\StatusHistory;

class AdminLaporanController extends Controller
{
    public function index()
    {
        // Check if user is admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login');
        }

        // Get instansi IDs that this admin manages
        $instansiIds = auth()->user()->instansi->pluck('id')->toArray();
        
        // Get laporan that belong to admin's instansi
        $laporan = Laporan::whereIn('instansi_id', $instansiIds)
            ->with(['user', 'instansi', 'admin'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.admin.laporan.index', compact('laporan'));
    }

    public function show(Laporan $laporan)
    {
        // Check if user is admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login');
        }

        // Check if laporan belongs to admin's instansi
        $instansiIds = auth()->user()->instansi->pluck('id')->toArray();
        if (!in_array($laporan->instansi_id, $instansiIds)) {
            return redirect()->route('admin.laporan.index')
                ->with('error', 'Anda tidak memiliki akses ke laporan ini.');
        }

        $laporan->load(['user', 'instansi', 'admin', 'statusHistory.changedBy']);
        
        return view('dashboard.admin.laporan.show', compact('laporan'));
    }

    public function claim(Request $request, Laporan $laporan)
    {
        // Check if user is admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login');
        }

        // Check if laporan belongs to admin's instansi
        $instansiIds = auth()->user()->instansi->pluck('id')->toArray();
        if (!in_array($laporan->instansi_id, $instansiIds)) {
            return redirect()->route('admin.laporan.index')
                ->with('error', 'Anda tidak memiliki akses ke laporan ini.');
        }

        // Check if laporan is already claimed by another admin (with race condition prevention)
        if ($laporan->admin_id !== null && $laporan->admin_id !== auth()->id()) {
            if ($request->wantsJson() || $request->expectsJson() || $request->header('Accept') === 'application/json') {
                return response()->json(['success' => false, 'message' => 'Laporan ini sudah diambil oleh admin lain.'], 403);
            }
            return redirect()->route('admin.laporan.index')
                ->with('error', 'Laporan ini sudah diambil oleh admin lain.');
        }

        // Claim the laporan using update with where clause to prevent race condition
        // This ensures only one admin can claim at a time (atomic operation)
        if ($laporan->admin_id === null) {
            $updated = Laporan::where('id', $laporan->id)
                ->whereNull('admin_id')
                ->update(['admin_id' => auth()->id()]);

            // If update failed, it means another admin claimed it first (race condition)
            if (!$updated) {
                $laporan->refresh();
                if ($laporan->admin_id !== auth()->id()) {
                    if ($request->wantsJson() || $request->expectsJson() || $request->header('Accept') === 'application/json') {
                        return response()->json(['success' => false, 'message' => 'Laporan ini sudah diambil oleh admin lain.'], 403);
                    }
                    return redirect()->route('admin.laporan.index')
                        ->with('error', 'Laporan ini sudah diambil oleh admin lain.');
                }
            }
        } else {
            // Already claimed by this admin, just refresh
            $laporan->refresh();
        }

        // Return JSON response for AJAX
        if ($request->wantsJson() || $request->expectsJson() || $request->header('Accept') === 'application/json') {
            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil diambil! Anda sekarang dapat mengubah status laporan ini.'
            ]);
        }

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diambil!');
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        // Check if user is admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login');
        }

        // Check if laporan belongs to admin's instansi
        $instansiIds = auth()->user()->instansi->pluck('id')->toArray();
        if (!in_array($laporan->instansi_id, $instansiIds)) {
            if ($request->wantsJson() || $request->expectsJson() || $request->header('Accept') === 'application/json') {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki akses ke laporan ini.'], 403);
            }
            return redirect()->route('admin.laporan.index')
                ->with('error', 'Anda tidak memiliki akses ke laporan ini.');
        }

        // Check if laporan is claimed by this admin (or unclaimed)
        if ($laporan->admin_id !== null && $laporan->admin_id !== auth()->id()) {
            if ($request->wantsJson() || $request->expectsJson() || $request->header('Accept') === 'application/json') {
                return response()->json(['success' => false, 'message' => 'Laporan ini sudah diambil oleh admin lain.'], 403);
            }
            return redirect()->route('admin.laporan.index')
                ->with('error', 'Laporan ini sudah diambil oleh admin lain.');
        }

        $request->validate([
            'status' => 'required|in:terkirim,diverifikasi,diproses,ditolak,selesai',
            'catatan' => 'nullable|string',
        ]);

        $statusLama = $laporan->status;
        $statusBaru = $request->status;

        // Prevent status from going backwards
        // Status final tidak bisa diubah
        if (in_array($statusLama, ['selesai', 'ditolak'])) {
            return redirect()->back()
                ->with('error', 'Status laporan yang sudah selesai atau ditolak tidak dapat diubah.');
        }

        // Validasi urutan status (tidak boleh mundur)
        $statusOrder = [
            'terkirim' => 1,
            'diverifikasi' => 2,
            'diproses' => 3,
            'selesai' => 4,
            'ditolak' => 4, // Final status
        ];

        // Ditolak bisa dipilih kapan saja (selama belum final)
        if ($statusBaru === 'ditolak') {
            // Allow
        } 
        // Selesai hanya bisa dari diproses
        elseif ($statusBaru === 'selesai' && $statusLama !== 'diproses') {
            return redirect()->back()
                ->with('error', 'Status selesai hanya bisa dipilih dari status diproses.');
        }
        // Status lain tidak boleh mundur
        elseif (isset($statusOrder[$statusLama]) && isset($statusOrder[$statusBaru])) {
            if ($statusOrder[$statusBaru] < $statusOrder[$statusLama]) {
                return redirect()->back()
                    ->with('error', 'Status tidak dapat dikembalikan ke status sebelumnya.');
            }
        }

        // Only create status history if status actually changed
        // This prevents duplicate entries and keeps audit trail clean
        $statusChanged = $statusLama !== $statusBaru;
        
        // Update laporan
        $laporan->update([
            'status' => $statusBaru,
            'admin_id' => auth()->id(), // Ensure admin_id is set
            'catatan_admin' => $request->catatan,
        ]);

        // Create status history only if status actually changed OR if catatan is provided
        // Best practice: Log all meaningful updates, but avoid duplicates
        if ($statusChanged) {
            // Status changed - always log this
            StatusHistory::create([
                'laporan_id' => $laporan->id,
                'status_lama' => $statusLama,
                'status_baru' => $statusBaru,
                'catatan' => $request->catatan,
                'changed_by' => auth()->id(),
            ]);
        } elseif ($request->filled('catatan') && !empty(trim($request->catatan))) {
            // Status unchanged but catatan provided - log as note update
            // This allows admin to add notes without changing status
            StatusHistory::create([
                'laporan_id' => $laporan->id,
                'status_lama' => $statusLama,
                'status_baru' => $statusLama, // Status unchanged
                'catatan' => $request->catatan,
                'changed_by' => auth()->id(),
            ]);
        }

        // Return JSON response for AJAX requests
        if ($request->wantsJson() || $request->expectsJson() || $request->header('Accept') === 'application/json') {
            return response()->json([
                'success' => true,
                'message' => 'Status laporan berhasil diperbarui!'
            ]);
        }

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Status laporan berhasil diperbarui!');
    }
}
