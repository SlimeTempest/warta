@extends('layouts.app')

@section('title', 'Laporan Saya - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Laporan Saya</h1>
            <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Daftar laporan yang telah Anda buat</p>
        </div>
        <a href="{{ route('laporan.create') }}" class="kaira-btn kaira-btn-primary" style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; font-size: 14px;" onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'" onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'">
            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Laporan Baru
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($laporan as $item)
            <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease; position: relative; display: flex; flex-direction: column; min-height: 400px;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                <!-- Header dengan Judul -->
                <div style="margin-bottom: 25px; flex-shrink: 0;">
                    <h3 style="font-family: 'Marcellus', serif; font-size: 22px; color: #212529; margin: 0 0 20px 0; line-height: 1.4; min-height: 60px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $item->judul }}</h3>
                </div>
                
                <!-- Informasi Detail - Grid Layout -->
                <div style="flex: 1; display: flex; flex-direction: column; gap: 15px; margin-bottom: 25px;">
                    <!-- Instansi -->
                    <div style="display: flex; align-items: center; gap: 12px; min-height: 24px;">
                        <div style="width: 32px; height: 32px; padding: 8px; background-color: #e7f3ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 16px; height: 16px; color: #0d6efd;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; font-weight: 500; flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $item->instansi->nama }}</span>
                    </div>
                    
                    <!-- Lokasi -->
                    <div style="display: flex; align-items: center; gap: 12px; min-height: 24px;">
                        <div style="width: 32px; height: 32px; padding: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ \Illuminate\Support\Str::limit($item->lokasi, 40) }}</span>
                    </div>
                    
                    <!-- Tanggal -->
                    <div style="display: flex; align-items: center; gap: 12px; min-height: 24px;">
                        <div style="width: 32px; height: 32px; padding: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; flex: 1;">{{ $item->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                
                <!-- Status dan Action Section -->
                <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid #e9ecef;">
                    <!-- Status Badge -->
                    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
                        @php
                            $statusColors = [
                                'terkirim' => ['bg' => '#e7f3ff', 'text' => '#0d6efd'],
                                'diverifikasi' => ['bg' => '#fff4e6', 'text' => '#f59e0b'],
                                'diproses' => ['bg' => '#ffe4cc', 'text' => '#f97316'],
                                'selesai' => ['bg' => '#d1fae5', 'text' => '#10b981'],
                                'ditolak' => ['bg' => '#fee2e2', 'text' => '#ef4444'],
                            ];
                            $status = $statusColors[$item->status] ?? ['bg' => '#f8f9fa', 'text' => '#8f8f8f'];
                        @endphp
                        <span style="font-family: 'Jost', sans-serif; font-weight: 500; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px 14px; background-color: {{ $status['bg'] }}; color: {{ $status['text'] }}; display: inline-block;">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <a href="{{ route('laporan.show', $item) }}" style="flex: 1; font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 20px; background-color: #212529; color: white; border: 1px solid #212529; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s ease; font-size: 13px; min-height: 44px;" onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'" onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'">
                            Detail
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        @if($item->status === 'terkirim' && !in_array($item->status, ['selesai', 'ditolak']))
                            <a href="{{ route('laporan.edit', $item) }}" style="width: 44px; height: 44px; padding: 0; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: all 0.3s ease; cursor: pointer; flex-shrink: 0;" onmouseover="this.style.backgroundColor='#e9ecef'; this.style.borderColor='#212529'" onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#e9ecef'" title="Edit">
                                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('laporan.destroy', $item) }}" method="POST" style="display: inline; margin: 0;" onsubmit="return kairaConfirmSubmit(event, 'Apakah Anda yakin ingin menghapus laporan ini?', 'Hapus Laporan');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="width: 44px; height: 44px; padding: 0; background-color: #fee2e2; color: #dc3545; border: 1px solid #fee2e2; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;" onmouseover="this.style.backgroundColor='#fecaca'; this.style.borderColor='#dc3545'" onmouseout="this.style.backgroundColor='#fee2e2'; this.style.borderColor='#fee2e2'" title="Hapus">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1;">
                <div class="kaira-card" style="background: white; border: 1px dashed #e9ecef; text-align: center; padding: 60px 20px;">
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; background-color: #f8f9fa; margin-bottom: 20px;">
                        <svg style="width: 40px; height: 40px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-weight: 500; font-size: 18px; margin-bottom: 8px;">Belum ada laporan</p>
                    <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 14px; margin-bottom: 30px;">Mulai laporkan masalah di lingkungan Anda</p>
                    <a href="{{ route('laporan.create') }}" class="kaira-btn kaira-btn-primary" style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; font-size: 14px;" onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'" onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Laporan Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    @if($laporan->hasPages())
        <div class="mt-8">
            {{ $laporan->links() }}
        </div>
    @endif
</div>
@endsection

