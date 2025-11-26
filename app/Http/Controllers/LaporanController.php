<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Laporan;
use App\Models\Instansi;
use App\Models\StatusHistory;

class LaporanController extends Controller
{
    public function create()
    {
        // Check if user is regular user
        if (auth()->user()->role !== 'user') {
            return redirect()->route('login');
        }

        $instansi = Instansi::where('status', 'active')->orderBy('nama')->get();
        
        return view('dashboard.user.laporan.create', compact('instansi'));
    }

    public function store(Request $request)
    {
        // Check if user is regular user
        if (auth()->user()->role !== 'user') {
            return redirect()->route('login');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'instansi_id' => 'required|exists:instansi,id',
            'bukti_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // Max 5MB per file
        ]);

        // Validate that instansi is active
        $instansi = Instansi::findOrFail($request->instansi_id);
        if ($instansi->status !== 'active') {
            return redirect()->back()
                ->withInput()
                ->withErrors(['instansi_id' => 'Instansi yang dipilih sedang ditangguhkan.']);
        }

        // Handle file uploads with total size validation
        $buktiFiles = [];
        $totalSize = 0;
        $maxTotalSize = 50 * 1024 * 1024; // 50MB total
        
        if ($request->hasFile('bukti_files')) {
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

        $laporan = Laporan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'user_id' => auth()->id(),
            'instansi_id' => $request->instansi_id,
            'status' => 'terkirim',
            'bukti_files' => !empty($buktiFiles) ? $buktiFiles : null,
        ]);

        // Create initial status history
        StatusHistory::create([
            'laporan_id' => $laporan->id,
            'status_lama' => null,
            'status_baru' => 'terkirim',
            'catatan' => 'Laporan dibuat oleh user',
            'changed_by' => auth()->id(),
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat!');
    }

    public function index()
    {
        // Check if user is regular user
        if (auth()->user()->role !== 'user') {
            return redirect()->route('login');
        }

        $laporan = Laporan::where('user_id', auth()->id())
            ->with(['instansi', 'admin'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.user.laporan.index', compact('laporan'));
    }

    public function show(Laporan $laporan)
    {
        // Check if user is regular user and owns the laporan
        if (auth()->user()->role !== 'user' || $laporan->user_id !== auth()->id()) {
            return redirect()->route('laporan.index');
        }

        $laporan->load(['instansi', 'admin', 'statusHistory.changedBy']);
        
        return view('dashboard.user.laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        // Check if user is regular user and owns the laporan
        if (auth()->user()->role !== 'user' || $laporan->user_id !== auth()->id()) {
            return redirect()->route('laporan.index');
        }

        // Only allow editing if status is 'terkirim'
        if ($laporan->status !== 'terkirim') {
            return redirect()->route('laporan.show', $laporan)
                ->with('error', 'Laporan tidak dapat diedit karena sudah diproses.');
        }

        $instansi = Instansi::where('status', 'active')->orderBy('nama')->get();
        
        return view('dashboard.user.laporan.edit', compact('laporan', 'instansi'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        // Check if user is regular user and owns the laporan
        if (auth()->user()->role !== 'user' || $laporan->user_id !== auth()->id()) {
            return redirect()->route('laporan.index');
        }

        // Only allow editing if status is 'terkirim'
        if ($laporan->status !== 'terkirim') {
            return redirect()->route('laporan.show', $laporan)
                ->with('error', 'Laporan tidak dapat diedit karena sudah diproses.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'instansi_id' => 'required|exists:instansi,id',
            'bukti_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Validate that instansi is active
        $instansi = Instansi::findOrFail($request->instansi_id);
        if ($instansi->status !== 'active') {
            return redirect()->back()
                ->withInput()
                ->withErrors(['instansi_id' => 'Instansi yang dipilih sedang ditangguhkan.']);
        }

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

        $laporan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'instansi_id' => $request->instansi_id,
            'bukti_files' => !empty($buktiFiles) ? $buktiFiles : null,
        ]);

        return redirect()->route('laporan.show', $laporan)->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Laporan $laporan)
    {
        // Check if user is regular user and owns the laporan
        if (auth()->user()->role !== 'user' || $laporan->user_id !== auth()->id()) {
            return redirect()->route('laporan.index');
        }

        // Only allow deleting if status is 'terkirim'
        if ($laporan->status !== 'terkirim') {
            return redirect()->route('laporan.show', $laporan)
                ->with('error', 'Laporan tidak dapat dihapus karena sudah diproses.');
        }

        // Delete files
        if ($laporan->bukti_files) {
            foreach ($laporan->bukti_files as $file) {
                if (file_exists(public_path($file))) {
                    unlink(public_path($file));
                }
            }
        }

        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
