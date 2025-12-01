@extends('layouts.app')

@section('title', 'Detail Laporan - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Detail Laporan</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Informasi lengkap laporan</p>
    </div>

    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px; margin-bottom: 30px;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" style="margin-bottom: 30px;">
            <div>
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Judul</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 8px 0 0 0;">{{ $laporan->judul }}</p>
            </div>
            <div>
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Status</label>
                <span class="kaira-badge" style="
                    font-family: 'Jost', sans-serif; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px 14px; font-weight: 500; display: inline-block; margin-top: 8px;
                    @if($laporan->status === 'terkirim') background-color: #dbeafe; color: #2563eb;
                    @elseif($laporan->status === 'diverifikasi') background-color: #fef3c7; color: #d97706;
                    @elseif($laporan->status === 'diproses') background-color: #e9d5ff; color: #7c3aed;
                    @elseif($laporan->status === 'selesai') background-color: #d1fae5; color: #10b981;
                    @else background-color: #fee2e2; color: #ef4444;
                    @endif">
                    {{ ucfirst($laporan->status) }}
                </span>
            </div>
            <div>
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Pelapor</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 16px; color: #212529; margin: 8px 0 0 0;">{{ $laporan->user->name }}</p>
            </div>
            <div>
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Instansi Tujuan</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 16px; color: #212529; margin: 8px 0 0 0;">{{ $laporan->instansi->nama }}</p>
            </div>
            <div>
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Admin Penanggung Jawab</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 16px; color: #212529; margin: 8px 0 0 0;">{{ $laporan->admin ? $laporan->admin->name : '-' }}</p>
            </div>
            <div>
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Tanggal Dibuat</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 16px; color: #212529; margin: 8px 0 0 0;">{{ $laporan->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div style="grid-column: 1 / -1;">
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Lokasi</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 16px; color: #212529; margin: 8px 0 0 0;">{{ $laporan->lokasi }}</p>
            </div>
            <div style="grid-column: 1 / -1;">
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Deskripsi</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 15px; color: #212529; margin: 8px 0 0 0; line-height: 1.7; white-space: pre-wrap;">{{ $laporan->deskripsi }}</p>
            </div>
        </div>

        @if($laporan->bukti_files && count($laporan->bukti_files) > 0)
            <div style="margin-bottom: 30px; padding-top: 30px; border-top: 1px solid #e9ecef;">
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px;">Bukti Pendukung</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($laporan->bukti_files as $file)
                        <div style="border: 1px solid #e9ecef; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#212529'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.08)'" onmouseout="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                            @if(str_ends_with($file, '.pdf'))
                                <a href="{{ asset($file) }}" target="_blank" style="display: block; padding: 20px; text-align: center; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'">
                                    <svg style="width: 48px; height: 48px; margin: 0 auto; color: #ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <p style="font-family: 'Jost', sans-serif; font-size: 11px; margin-top: 8px; color: #8f8f8f;">PDF</p>
                                </a>
                            @else
                                <a href="{{ asset($file) }}" target="_blank" style="display: block;">
                                    <img src="{{ asset($file) }}" alt="Bukti" style="width: 100%; height: 128px; object-fit: cover; transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($laporan->catatan_admin)
            <div style="margin-bottom: 30px; padding-top: 30px; border-top: 1px solid #e9ecef;">
                <div style="background-color: #fff4e6; border: 1px solid #fbbf24; padding: 20px;">
                    <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 600; color: #92400e; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;">Catatan Admin</label>
                    <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #92400e; line-height: 1.6; margin: 0;">{{ $laporan->catatan_admin }}</p>
                </div>
            </div>
        @endif

        <div style="display: flex; align-items: center; justify-content: space-between; gap: 15px; flex-wrap: wrap; padding-top: 30px; border-top: 1px solid #e9ecef;">
            <a href="{{ route('super-admin.laporan.index') }}" 
                class="kaira-btn"
                style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease; font-size: 14px;"
                onmouseover="this.style.backgroundColor='#e9ecef'; this.style.borderColor='#dee2e6'"
                onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#e9ecef'">
                Kembali
            </a>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('super-admin.laporan.edit', $laporan) }}" 
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'">
                    Edit
                </a>
                <form action="{{ route('super-admin.laporan.destroy', $laporan) }}" method="POST" style="display: inline;" onsubmit="return kairaConfirmSubmit(event, 'Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.', 'Hapus Laporan');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="kaira-btn"
                        style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #ef4444; color: white; border: 1px solid #ef4444; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                        onmouseover="this.style.backgroundColor='#dc2626'; this.style.borderColor='#dc2626'"
                        onmouseout="this.style.backgroundColor='#ef4444'; this.style.borderColor='#ef4444'">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Status History Timeline -->
    @if($laporan->statusHistory->count() > 0)
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px; margin-top: 30px;">
            <h2 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; margin-bottom: 30px; letter-spacing: 0.5px;">Riwayat Status</h2>
            <div style="position: relative;">
                <!-- Timeline line -->
                <div style="position: absolute; left: 24px; top: 0; bottom: 0; width: 2px; background-color: #e9ecef;"></div>
                
                <div style="display: flex; flex-direction: column; gap: 25px;">
                    @foreach($laporan->statusHistory->sortByDesc('created_at') as $index => $history)
                        @php
                            $statusColors = [
                                'terkirim' => '#0d6efd',
                                'diverifikasi' => '#f59e0b',
                                'diproses' => '#f97316',
                                'selesai' => '#10b981',
                                'ditolak' => '#ef4444',
                            ];
                            $statusColor = $statusColors[$history->status_baru] ?? '#0d6efd';
                        @endphp
                        <div style="position: relative; display: flex; align-items: start; gap: 20px;">
                            <!-- Timeline dot -->
                            <div style="position: relative; z-index: 10; flex-shrink: 0;">
                                <div style="width: 48px; height: 48px; border-radius: 50%; background-color: {{ $statusColor }}; border: 4px solid white; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1); display: flex; align-items: center; justify-content: center;">
                                    @if($history->status_lama !== $history->status_baru)
                                        <div style="width: 10px; height: 10px; border-radius: 50%; background-color: white;"></div>
                                    @else
                                        <svg style="width: 20px; height: 20px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div style="flex: 1; min-width: 0; padding-bottom: 25px;">
                                <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; padding: 20px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#0d6efd'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.05)'" onmouseout="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                                    @if($history->status_lama !== $history->status_baru)
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                                            <span style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #212529;">
                                                {{ $history->status_lama ? ucfirst($history->status_lama) : 'Baru' }}
                                            </span>
                                            <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            <span style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: {{ $statusColor }};">
                                                {{ ucfirst($history->status_baru) }}
                                            </span>
                                        </div>
                                    @else
                                        <div style="margin-bottom: 12px;">
                                            <span style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #8f8f8f;">Catatan diperbarui</span>
                                            <span style="font-family: 'Jost', sans-serif; font-size: 12px; font-weight: normal; color: #8f8f8f; margin-left: 8px;">(Status: {{ ucfirst($history->status_baru) }})</span>
                                        </div>
                                    @endif
                                    
                                    @if($history->catatan)
                                        <div style="background-color: white; border-left: 3px solid {{ $statusColor }}; padding: 15px; margin-top: 12px;">
                                            <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #212529; line-height: 1.7; margin: 0;">{{ $history->catatan }}</p>
                                        </div>
                                    @endif
                                    
                                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 15px; padding-top: 15px; border-top: 1px solid #e9ecef;">
                                        <svg style="width: 14px; height: 14px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span style="font-family: 'Jost', sans-serif; font-size: 12px; color: #212529; font-weight: 500;">{{ $history->changedBy->name }}</span>
                                        <span style="color: #8f8f8f;">•</span>
                                        <svg style="width: 14px; height: 14px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f;">{{ $history->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

