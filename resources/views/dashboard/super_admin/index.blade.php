@extends('layouts.app')

@section('title', 'Dashboard Super Admin - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Page Header - Kaira Style -->
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Dashboard</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Kontrol penuh sistem, <span style="font-weight: 600; color: #212529;">{{ auth()->user()->name }}</span>!</p>
    </div>

    <!-- Statistics Cards - Kaira Style -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <div style="margin-bottom: 20px;">
                <div style="padding: 15px; background-color: #f3e8ff; display: inline-block;">
                    <svg style="width: 24px; height: 24px; color: #7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">{{ $totalInstansi }}</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">Total Instansi</p>
        </div>

        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <div style="margin-bottom: 20px;">
                <div style="padding: 15px; background-color: #e7f3ff; display: inline-block;">
                    <svg style="width: 24px; height: 24px; color: #0d6efd;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">{{ $totalAdmin }}</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">Total Admin</p>
        </div>

        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <div style="margin-bottom: 20px;">
                <div style="padding: 15px; background-color: #d1fae5; display: inline-block;">
                    <svg style="width: 24px; height: 24px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">{{ $totalLaporan }}</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">Total Laporan</p>
        </div>

        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <div style="margin-bottom: 20px;">
                <div style="padding: 15px; background-color: #fff4e6; display: inline-block;">
                    <svg style="width: 24px; height: 24px; color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">{{ $pending }}</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">Pending</p>
        </div>
    </div>

    <!-- Recent Data - Kaira Style -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Instansi Terbaru -->
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; overflow: hidden;">
            <div style="padding: 25px 30px; border-bottom: 1px solid #e9ecef;">
                <h2 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">Instansi Terbaru</h2>
                <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f; margin: 0;">Instansi yang baru terdaftar</p>
            </div>
            <div style="padding: 30px;">
                @forelse($instansiTerbaru as $instansi)
                    <div style="border-bottom: 1px solid #e9ecef; padding: 20px 0; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'">
                        <div style="display: flex; justify-content: space-between; align-items: start; gap: 25px; padding: 0 10px;">
                            <div style="flex: 1; min-width: 0;">
                                <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 8px;">{{ $instansi->nama }}</h3>
                                @if($instansi->alamat)
                                    <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; margin-bottom: 10px; line-height: 1.5; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">{{ Str::limit($instansi->alamat, 60) }}</p>
                                @endif
                                <span style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f;">{{ $instansi->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; flex-shrink: 0;">
                                @php
                                    $statusColors = [
                                        'active' => ['bg' => '#d1fae5', 'text' => '#10b981'],
                                        'suspended' => ['bg' => '#fee2e2', 'text' => '#ef4444'],
                                    ];
                                    $statusLabels = [
                                        'active' => 'Aktif',
                                        'suspended' => 'Ditangguhkan',
                                    ];
                                    $status = $statusColors[$instansi->status] ?? ['bg' => '#f8f9fa', 'text' => '#8f8f8f'];
                                @endphp
                                <span class="kaira-badge" style="
                                    font-family: 'Jost', sans-serif; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px 14px; font-weight: 500;
                                    background-color: {{ $status['bg'] }}; color: {{ $status['text'] }};">
                                    {{ $statusLabels[$instansi->status] ?? ucfirst($instansi->status) }}
                                </span>
                                <a href="{{ route('instansi.edit', $instansi) }}" style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500; color: #212529; text-decoration: none; transition: color 0.3s ease; white-space: nowrap;" onmouseover="this.style.color='#0d6efd'" onmouseout="this.style.color='#212529'">
                                    Kelola →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 60px 20px;">
                        <div style="width: 64px; height: 64px; background-color: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                            <svg style="width: 32px; height: 32px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <p style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 500; color: #212529; margin-bottom: 5px;">Belum ada instansi</p>
                        <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">Instansi yang terdaftar akan muncul di sini</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Laporan Terbaru -->
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; overflow: hidden;">
            <div style="padding: 25px 30px; border-bottom: 1px solid #e9ecef;">
                <h2 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; margin-bottom: 5px; letter-spacing: 0.5px;">Laporan Terbaru</h2>
                <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f; margin: 0;">Laporan yang baru masuk</p>
            </div>
            <div style="padding: 30px;">
                @forelse($laporanTerbaru as $laporan)
                    <div style="border-bottom: 1px solid #e9ecef; padding: 20px 0; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'">
                        <div style="display: flex; justify-content: space-between; align-items: start; gap: 25px; padding: 0 10px;">
                            <div style="flex: 1; min-width: 0;">
                                <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 10px; line-height: 1.4; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $laporan->judul }}</h3>
                                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f; margin-bottom: 12px;">
                                    <span>Oleh: {{ $laporan->user->name }}</span>
                                    <span>•</span>
                                    <span>{{ $laporan->instansi->nama }}</span>
                                    <span>•</span>
                                    <span>{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <a href="{{ route('super-admin.laporan.show', $laporan) }}" style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500; color: #212529; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#0d6efd'" onmouseout="this.style.color='#212529'">
                                    Lihat Detail →
                                </a>
                            </div>
                            <div style="flex-shrink: 0;">
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
                                    $status = $statusColors[$laporan->status] ?? ['bg' => '#f8f9fa', 'text' => '#8f8f8f'];
                                @endphp
                                <span class="kaira-badge" style="
                                    font-family: 'Jost', sans-serif; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px 14px; font-weight: 500;
                                    background-color: {{ $status['bg'] }}; color: {{ $status['text'] }};">
                                    {{ $statusLabels[$laporan->status] ?? ucfirst($laporan->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 60px 20px;">
                        <div style="width: 64px; height: 64px; background-color: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                            <svg style="width: 32px; height: 32px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 500; color: #212529; margin-bottom: 5px;">Belum ada laporan</p>
                        <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">Laporan yang masuk akan muncul di sini</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

