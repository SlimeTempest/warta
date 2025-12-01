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
                <p style="font-family: 'Jost', sans-serif; font-size: 16px; color: #212529; margin: 8px 0 0 0;">
                    @if($laporan->admin)
                        {{ $laporan->admin->name }}
                        @if($laporan->admin_id === auth()->id())
                            <span style="color: #10b981; font-size: 12px;">(Anda)</span>
                        @endif
                    @else
                        <span style="color: #8f8f8f;">Belum diambil</span>
                    @endif
                </p>
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

        <!-- Form Update Status - Only show if admin has claimed this laporan and status is not final -->
        @if($laporan->admin_id === null)
            <div style="padding-top: 30px; border-top: 1px solid #e9ecef;">
                <div style="background-color: #fff4e6; border: 1px solid #fbbf24; padding: 20px;">
                    <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #92400e; line-height: 1.6;">
                        <strong>Perhatian:</strong> Laporan ini belum diambil oleh admin. 
                        <a href="{{ route('admin.laporan.index') }}" style="color: #212529; text-decoration: underline; font-weight: 500;">Kembali ke daftar</a> dan klik "Ambil Laporan" untuk menanganinya.
                    </p>
                </div>
            </div>
        @elseif($laporan->admin_id === auth()->id() && in_array($laporan->status, ['selesai', 'ditolak']))
            <div style="padding-top: 30px; border-top: 1px solid #e9ecef;">
                <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; padding: 20px;">
                    <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #212529; line-height: 1.6;">
                        <strong>Status Final:</strong> Laporan ini sudah selesai atau ditolak dan tidak dapat diubah lagi.
                    </p>
                </div>
            </div>
        @elseif($laporan->admin_id === auth()->id())
            <div style="padding-top: 30px; border-top: 1px solid #e9ecef;">
                <h2 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; margin-bottom: 25px; letter-spacing: 0.5px;">Ubah Status Laporan</h2>
                <form method="POST" action="{{ route('admin.laporan.updateStatus', $laporan) }}">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 25px;">
                    <label for="status" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Status Baru <span style="color: #dc3545;">*</span>
                    </label>
                    <select 
                        id="status" 
                        name="status" 
                        required
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('status') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white;"
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='{{ $errors->has('status') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                    >
                        <option value="terkirim" {{ old('status', $laporan->status) === 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                        <option value="diverifikasi" {{ old('status', $laporan->status) === 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                        <option value="diproses" {{ old('status', $laporan->status) === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="ditolak" {{ old('status', $laporan->status) === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="selesai" {{ old('status', $laporan->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div style="margin-bottom: 30px;">
                    <label for="catatan" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Catatan <span style="color: #8f8f8f; font-weight: normal; text-transform: none;">(Opsional)</span>
                    </label>
                    <textarea 
                        id="catatan" 
                        name="catatan" 
                        rows="4"
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('catatan') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px; resize: vertical;"
                        placeholder="Tambahkan catatan untuk perubahan status ini..."
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='{{ $errors->has('catatan') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                    >{{ old('catatan', $laporan->catatan_admin) }}</textarea>
                    @error('catatan')
                        <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                >
                    Update Status
                </button>
            </form>
        </div>
        @else
            <div style="padding-top: 30px; border-top: 1px solid #e9ecef;">
                <div style="background-color: #dbeafe; border: 1px solid #60a5fa; padding: 20px;">
                    <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #1e40af; line-height: 1.6;">
                        <strong>Info:</strong> Laporan ini sudah diambil oleh <strong>{{ $laporan->admin->name }}</strong>. 
                        Anda hanya dapat melihat laporan ini, tidak dapat mengubah statusnya.
                    </p>
                </div>
            </div>
        @endif
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

