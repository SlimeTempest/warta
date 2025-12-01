@extends('layouts.app')

@section('title', 'Dashboard Admin - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Page Header - Kaira Style -->
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Dashboard</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Selamat datang kembali, <span style="font-weight: 600; color: #212529;">{{ auth()->user()->name }}</span>!</p>
    </div>

    <!-- Statistics Cards - Kaira Style -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <div style="margin-bottom: 20px;">
                <div style="padding: 15px; background-color: #e7f3ff; display: inline-block;">
                    <svg style="width: 24px; height: 24px; color: #0d6efd;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">{{ $laporanMasuk }}</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">Laporan Masuk</p>
        </div>

        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <div style="margin-bottom: 20px;">
                <div style="padding: 15px; background-color: #fff4e6; display: inline-block;">
                    <svg style="width: 24px; height: 24px; color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">{{ $dalamProses }}</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">Dalam Proses</p>
        </div>

        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <div style="margin-bottom: 20px;">
                <div style="padding: 15px; background-color: #d1fae5; display: inline-block;">
                    <svg style="width: 24px; height: 24px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">{{ $selesai }}</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">Selesai</p>
        </div>

        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <div style="margin-bottom: 20px;">
                <div style="padding: 15px; background-color: #fee2e2; display: inline-block;">
                    <svg style="width: 24px; height: 24px; color: #ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">{{ $ditolak }}</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">Ditolak</p>
        </div>
    </div>

    <!-- Recent Reports - Kaira Style -->
    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; overflow: hidden;">
        <div style="padding: 25px 30px; border-bottom: 1px solid #e9ecef;">
            <h2 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">Laporan Terbaru</h2>
            <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f; margin: 0;">Laporan yang baru masuk dan perlu ditinjau</p>
        </div>
        <div style="padding: 30px;">
            @if($laporanTerbaru->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($laporanTerbaru as $item)
                        <div class="kaira-card" style="background: #f8f9fa; border: 1px solid #e9ecef; padding: 25px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#0d6efd'; this.style.boxShadow='0 5px 15px rgba(0, 0, 0, 0.05)'" onmouseout="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                            <h3 style="font-family: 'Marcellus', serif; font-size: 20px; color: #212529; margin-bottom: 12px; line-height: 1.4; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $item->judul }}</h3>
                            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; margin-bottom: 20px; line-height: 1.6; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ Str::limit($item->deskripsi, 80) }}</p>
                            
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                                <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f;">{{ $item->user->name }}</span>
                            </div>
                            
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                                <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f;">{{ $item->instansi->nama }}</span>
                            </div>
                            
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                                <span style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f;">{{ $item->created_at->format('d M Y') }}</span>
                                @php
                                    $statusColors = [
                                        'terkirim' => ['bg' => '#e7f3ff', 'text' => '#0d6efd'],
                                        'diverifikasi' => ['bg' => '#fff4e6', 'text' => '#f59e0b'],
                                        'diproses' => ['bg' => '#ffe4cc', 'text' => '#f97316'],
                                        'selesai' => ['bg' => '#d1fae5', 'text' => '#10b981'],
                                        'ditolak' => ['bg' => '#fee2e2', 'text' => '#ef4444'],
                                    ];
                                    $statusLabels = [
                                        'terkirim' => 'Terkirim',
                                        'diverifikasi' => 'Diverifikasi',
                                        'diproses' => 'Diproses',
                                        'selesai' => 'Selesai',
                                        'ditolak' => 'Ditolak',
                                    ];
                                    $status = $statusColors[$item->status] ?? ['bg' => '#f8f9fa', 'text' => '#8f8f8f'];
                                @endphp
                                <span style="font-family: 'Jost', sans-serif; font-weight: 500; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 12px; background-color: {{ $status['bg'] }}; color: {{ $status['text'] }};">
                                    {{ $statusLabels[$item->status] ?? ucfirst($item->status) }}
                                </span>
                            </div>
                            
                            <a href="{{ route('admin.laporan.show', $item) }}" style="display: inline-flex; align-items: center; gap: 8px; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 500; color: #212529; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#0d6efd'" onmouseout="this.style.color='#212529'">
                                Lihat Detail
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px;">
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; background-color: #f8f9fa; margin-bottom: 20px;">
                        <svg style="width: 40px; height: 40px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-weight: 500; margin-bottom: 8px; font-size: 16px;">Belum ada laporan</p>
                    <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 14px;">Laporan yang masuk akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

