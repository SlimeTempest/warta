<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\Instansi;
use App\Models\User;

class DashboardController extends Controller
{
    public function user()
    {
        if (Auth::user()->role !== 'user') {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        
        // Get statistics
        $totalLaporan = Laporan::where('user_id', $userId)->count();
        
        $dalamProses = Laporan::where('user_id', $userId)
            ->whereIn('status', ['diverifikasi', 'diproses'])
            ->count();
        
        $selesai = Laporan::where('user_id', $userId)
            ->where('status', 'selesai')
            ->count();
        
        $ditolak = Laporan::where('user_id', $userId)
            ->where('status', 'ditolak')
            ->count();
        
        // Get latest reports
        $laporanTerbaru = Laporan::where('user_id', $userId)
            ->with(['instansi'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard.user.index', compact('totalLaporan', 'dalamProses', 'selesai', 'ditolak', 'laporanTerbaru'));
    }

    public function admin()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('login');
        }

        // Get instansi IDs that this admin manages
        $instansiIds = Auth::user()->instansi->pluck('id')->toArray();
        
        // Get statistics
        $laporanMasuk = Laporan::whereIn('instansi_id', $instansiIds)
            ->where('status', 'terkirim')
            ->count();
        
        $dalamProses = Laporan::whereIn('instansi_id', $instansiIds)
            ->whereIn('status', ['diverifikasi', 'diproses'])
            ->count();
        
        $selesai = Laporan::whereIn('instansi_id', $instansiIds)
            ->where('status', 'selesai')
            ->count();
        
        $ditolak = Laporan::whereIn('instansi_id', $instansiIds)
            ->where('status', 'ditolak')
            ->count();
        
        // Get latest reports
        $laporanTerbaru = Laporan::whereIn('instansi_id', $instansiIds)
            ->with(['user', 'instansi'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard.admin.index', compact('laporanMasuk', 'dalamProses', 'selesai', 'ditolak', 'laporanTerbaru'));
    }

    public function superAdmin()
    {
        if (Auth::user()->role !== 'super_admin') {
            return redirect()->route('login');
        }

        // Get statistics
        $totalInstansi = Instansi::count();
        
        $totalAdmin = User::where('role', 'admin')->count();
        
        $totalLaporan = Laporan::count();
        
        $pending = Laporan::where('status', 'terkirim')->count();
        
        // Get latest instansi
        $instansiTerbaru = Instansi::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get latest reports
        $laporanTerbaru = Laporan::with(['user', 'instansi'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard.super_admin.index', compact('totalInstansi', 'totalAdmin', 'totalLaporan', 'pending', 'instansiTerbaru', 'laporanTerbaru'));
    }
}
