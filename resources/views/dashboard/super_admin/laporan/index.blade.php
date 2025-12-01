@extends('layouts.app')

@section('title', 'Semua Laporan - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Semua Laporan</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Kelola semua laporan di sistem</p>
    </div>

    <!-- Statistics Cards - Kaira Style -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Total Laporan</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; letter-spacing: 0.5px;">{{ $totalLaporan }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Terkirim</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #0d6efd; letter-spacing: 0.5px;">{{ $terkirim }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Diverifikasi</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #f59e0b; letter-spacing: 0.5px;">{{ $diverifikasi }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Diproses</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #7c3aed; letter-spacing: 0.5px;">{{ $diproses }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Selesai</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #10b981; letter-spacing: 0.5px;">{{ $selesai }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Ditolak</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #ef4444; letter-spacing: 0.5px;">{{ $ditolak }}</p>
        </div>
    </div>

    <!-- Search and Filters - Kaira Style -->
    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; margin-bottom: 30px;">
        <form method="GET" action="{{ route('super-admin.laporan.index') }}" style="display: flex; flex-direction: column; gap: 20px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <!-- Search -->
                <div>
                    <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Cari</label>
                    <div style="position: relative;">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Judul, deskripsi, atau lokasi..."
                            class="kaira-input"
                            style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 15px 12px 45px; transition: all 0.3s ease; font-size: 14px;"
                            onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                            onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                        >
                        <svg style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Filter Instansi -->
                <div style="position: relative;">
                    <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Instansi</label>
                    <div style="position: relative;">
                        <select 
                            name="instansi_id" 
                            class="kaira-input"
                            style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                            onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                            onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                        >
                            <option value="all">Semua Instansi</option>
                            @foreach($instansi as $ins)
                                <option value="{{ $ins->id }}" {{ request('instansi_id') == $ins->id ? 'selected' : '' }}>
                                    {{ $ins->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                            <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filter Status -->
                <div style="position: relative;">
                    <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Status</label>
                    <div style="position: relative;">
                        <select 
                            name="status" 
                            class="kaira-input"
                            style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                            onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                            onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                        >
                            <option value="all">Semua Status</option>
                            <option value="terkirim" {{ request('status') == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                            <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                            <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filter Admin -->
                <div style="position: relative;">
                    <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Admin</label>
                    <div style="position: relative;">
                        <select 
                            name="admin_id" 
                            class="kaira-input"
                            style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                            onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                            onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                        >
                            <option value="">Semua Admin</option>
                            <option value="unassigned" {{ request('admin_id') == 'unassigned' ? 'selected' : '' }}>Belum Ditugaskan</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}" {{ request('admin_id') == $admin->id ? 'selected' : '' }}>
                                    {{ $admin->name }}
                                </option>
                            @endforeach
                        </select>
                        <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                            <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <button 
                    type="submit" 
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 25px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                >
                    Filter
                </button>
                @if(request('search') || request('instansi_id') || request('status') || request('admin_id'))
                    <a 
                        href="{{ route('super-admin.laporan.index') }}" 
                        class="kaira-btn"
                        style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 25px; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease; font-size: 14px;"
                        onmouseover="this.style.backgroundColor='#e9ecef'; this.style.borderColor='#dee2e6'"
                        onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#e9ecef'"
                    >
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Laporan Table - Kaira Style -->
    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table class="kaira-table" style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                    <tr>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Judul</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Pelapor</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Instansi</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Admin</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Tanggal</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $item)
                        <tr style="border-bottom: 1px solid #e9ecef; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 20px; white-space: nowrap;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500; color: #212529;">{{ $item->judul }}</div>
                            </td>
                            <td style="padding: 20px; white-space: nowrap;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">{{ $item->user->name }}</div>
                            </td>
                            <td style="padding: 20px; white-space: nowrap;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">{{ $item->instansi->nama }}</div>
                            </td>
                            <td style="padding: 20px; white-space: nowrap;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">
                                    @if($item->admin)
                                        {{ $item->admin->name }}
                                    @else
                                        <span style="color: #d1d5db;">-</span>
                                    @endif
                                </div>
                            </td>
                            <td style="padding: 20px; white-space: nowrap;">
                                @if($item->status === 'terkirim')
                                    <span class="kaira-badge" style="font-family: 'Jost', sans-serif; font-size: 11px; font-weight: 600; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; background-color: #dbeafe; color: #0d6efd;">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @elseif($item->status === 'diverifikasi')
                                    <span class="kaira-badge" style="font-family: 'Jost', sans-serif; font-size: 11px; font-weight: 600; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; background-color: #fef3c7; color: #f59e0b;">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @elseif($item->status === 'diproses')
                                    <span class="kaira-badge" style="font-family: 'Jost', sans-serif; font-size: 11px; font-weight: 600; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; background-color: #f3e8ff; color: #7c3aed;">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @elseif($item->status === 'selesai')
                                    <span class="kaira-badge" style="font-family: 'Jost', sans-serif; font-size: 11px; font-weight: 600; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; background-color: #d1fae5; color: #10b981;">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @else
                                    <span class="kaira-badge" style="font-family: 'Jost', sans-serif; font-size: 11px; font-weight: 600; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; background-color: #fee2e2; color: #ef4444;">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 20px; white-space: nowrap; text-align: left;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">{{ $item->created_at->format('d/m/Y') }}</div>
                            </td>
                            <td style="padding: 20px; white-space: nowrap;">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <a href="{{ route('super-admin.laporan.show', $item) }}" style="font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 500; color: #0d6efd; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#0a58ca'" onmouseout="this.style.color='#0d6efd'">Lihat</a>
                                    <a href="{{ route('super-admin.laporan.edit', $item) }}" style="font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 500; color: #f59e0b; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#d97706'" onmouseout="this.style.color='#f59e0b'">Edit</a>
                                    <form action="{{ route('super-admin.laporan.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return kairaConfirmSubmit(event, 'Apakah Anda yakin ingin menghapus laporan ini?', 'Hapus Laporan');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 500; color: #ef4444; background: none; border: none; cursor: pointer; transition: color 0.3s ease; padding: 0;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#ef4444'">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 60px 20px; text-align: center;">
                                <div style="width: 64px; height: 64px; background-color: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                    <svg style="width: 32px; height: 32px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <p style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 500; color: #212529; margin-bottom: 5px;">Tidak ada laporan ditemukan</p>
                                <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">Laporan yang terdaftar akan muncul di sini</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($laporan->hasPages())
        <div style="margin-top: 30px; padding: 20px; border-top: 1px solid #e9ecef;">
            {{ $laporan->links() }}
        </div>
    @endif
</div>
@endsection

