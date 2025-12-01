@extends('layouts.app')

@section('title', 'Laporan Masuk - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Page Header - Kaira Style -->
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Laporan Masuk</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Laporan yang masuk ke instansi yang Anda kelola</p>
    </div>

    <!-- Card-based Layout - Kaira Style -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($laporan as $item)
            <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease; display: flex; flex-direction: column;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                <div style="display: flex; justify-content: space-between; align-items: start; gap: 15px; margin-bottom: 20px; flex: 1;">
                    <div style="flex: 1; min-width: 0;">
                        <a href="{{ route('admin.laporan.show', $item) }}" style="text-decoration: none; display: block;">
                            <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 12px; line-height: 1.4; transition: color 0.3s ease;" onmouseover="this.style.color='#0d6efd'" onmouseout="this.style.color='#212529'">
                                {{ $item->judul }}
                            </h3>
                        </a>
                        <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f; line-height: 1.6;">
                            <span>Pelapor: {{ $item->user->name }}</span>
                            <span>•</span>
                            <span>{{ $item->instansi->nama }}</span>
                            @if($item->admin)
                                <span>•</span>
                                <span>
                                    @if($item->admin_id === auth()->id())
                                        <span style="color: #10b981; font-weight: 500;">Anda</span>
                                    @else
                                        Admin: {{ $item->admin->name }}
                                    @endif
                                </span>
                            @endif
                            <span>•</span>
                            <span style="font-size: 11px;">{{ $item->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                    <div style="flex-shrink: 0;">
                        <span class="kaira-badge" style="
                            font-family: 'Jost', sans-serif; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 12px; font-weight: 500;
                            @if($item->status === 'terkirim') background-color: #dbeafe; color: #2563eb;
                            @elseif($item->status === 'diverifikasi') background-color: #fef3c7; color: #d97706;
                            @elseif($item->status === 'diproses') background-color: #e9d5ff; color: #7c3aed;
                            @elseif($item->status === 'selesai') background-color: #d1fae5; color: #10b981;
                            @else background-color: #fee2e2; color: #ef4444;
                            @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 12px; padding-top: 20px; border-top: 1px solid #e9ecef;">
                    @if(!in_array($item->status, ['selesai', 'ditolak']))
                        @if($item->admin_id === null)
                            <button 
                                type="button"
                                onclick="openClaimModal({{ $item->id }}, '{{ addslashes($item->judul) }}')"
                                class="kaira-btn"
                                style="flex: 1; font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 10px 20px; background-color: #10b981; color: white; border: 1px solid #10b981; cursor: pointer; transition: all 0.3s ease; font-size: 12px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;"
                                onmouseover="this.style.backgroundColor='#059669'; this.style.borderColor='#059669'"
                                onmouseout="this.style.backgroundColor='#10b981'; this.style.borderColor='#10b981'"
                            >
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Ambil Laporan</span>
                            </button>
                            <form id="claim-form-{{ $item->id }}" action="{{ route('admin.laporan.claim', $item) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @elseif($item->admin_id === auth()->id())
                            <button 
                                onclick="openStatusModal({{ $item->id }}, '{{ $item->judul }}', '{{ $item->status }}', '{{ addslashes($item->catatan_admin ?? '') }}')"
                                class="kaira-btn kaira-btn-primary"
                                style="flex: 1; font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 10px 20px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 12px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;"
                                onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                                onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                            >
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span>Ubah Status</span>
                            </button>
                        @else
                            <div style="flex: 1; text-align: center;">
                                <span style="font-family: 'Jost', sans-serif; font-size: 11px; color: #8f8f8f;">Diambil oleh:</span>
                                <span style="font-family: 'Jost', sans-serif; font-size: 11px; font-weight: 500; color: #212529; display: block;">{{ $item->admin->name }}</span>
                            </div>
                        @endif
                    @else
                        <div style="flex: 1; text-align: center;">
                            <span style="font-family: 'Jost', sans-serif; font-size: 11px; color: #8f8f8f; font-style: italic;">Status final</span>
                        </div>
                    @endif
                    <a href="{{ route('admin.laporan.show', $item) }}" style="padding: 10px; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; justify-content: center;" title="Detail" onmouseover="this.style.backgroundColor='#e9ecef'" onmouseout="this.style.backgroundColor='#f8f9fa'">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1;">
                <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; text-align: center; padding: 80px 20px;">
                    <div style="width: 64px; height: 64px; background-color: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg style="width: 32px; height: 32px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 500; color: #212529; margin-bottom: 5px;">Belum ada laporan masuk</p>
                    <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">Laporan yang masuk akan muncul di sini</p>
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

<!-- Modal Claim Laporan -->
<div id="claimModal" class="hidden fixed inset-0 overflow-y-auto h-full w-full z-50" style="background-color: rgba(0, 0, 0, 0.1); backdrop-filter: blur(4px);">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Ambil Laporan</h3>
                </div>
                <button onclick="closeClaimModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Laporan: <span id="claimModalJudul" class="font-semibold text-gray-900"></span></p>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mt-3">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium mb-1">Setelah mengambil laporan:</p>
                            <ul class="list-disc list-inside space-y-1 text-blue-700">
                                <li>Anda menjadi penanggung jawab laporan ini</li>
                                <li>Hanya Anda yang dapat mengubah status laporan</li>
                                <li>Admin lain hanya dapat melihat laporan ini</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6">
                <button 
                    onclick="closeClaimModal()" 
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors"
                >
                    Batal
                </button>
                <button 
                    id="confirmClaimBtn"
                    onclick="confirmClaim()" 
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-colors flex items-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Ya, Ambil Laporan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Status -->
<div id="statusModal" style="display: none; position: fixed; inset: 0; overflow-y: auto; z-index: 9999; background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border: 1px solid #e9ecef; width: 100%; max-width: 500px; padding: 40px; position: relative;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h3 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; letter-spacing: 0.5px;">Ubah Status Laporan</h3>
            <button onclick="closeStatusModal()" style="background: none; border: none; cursor: pointer; color: #8f8f8f; padding: 5px; transition: color 0.3s ease;" onmouseover="this.style.color='#212529'" onmouseout="this.style.color='#8f8f8f'">
                <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Laporan Info -->
        <div style="margin-bottom: 25px; padding: 20px; background-color: #f8f9fa; border: 1px solid #e9ecef;">
            <p style="font-family: 'Jost', sans-serif; font-size: 11px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Laporan</p>
            <p style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; color: #212529; margin-bottom: 8px;" id="modalJudul"></p>
            <p style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f;">Status saat ini: <span id="modalStatusCurrentValue" style="font-weight: 500; color: #212529;"></span></p>
        </div>

        <form id="statusForm" method="POST" onsubmit="handleStatusSubmit(event)">
            @csrf
            @method('PUT')

            <!-- Status Selection with Visual Indicator -->
            <div style="margin-bottom: 25px;">
                <label for="modal_status" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Status Baru <span style="color: #dc3545;">*</span>
                </label>
                <div style="position: relative;">
                    <select 
                        id="modal_status" 
                        name="status" 
                        required
                        onchange="updateStatusPreview(this.value)"
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                    >
                        <option value="terkirim">Terkirim</option>
                        <option value="diverifikasi">Diverifikasi</option>
                        <option value="diproses">Diproses</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <!-- Dropdown Arrow (right side) -->
                    <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                        <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
                <!-- Status Preview Badge with Visual Feedback -->
                <div id="statusPreview" style="margin-top: 15px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f;">Status yang dipilih:</span>
                        <span id="statusPreviewBadge" class="kaira-badge" style="font-family: 'Jost', sans-serif; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px 14px; font-weight: 500;"></span>
                    </div>
                </div>
            </div>

            <!-- Catatan/Deskripsi with Character Counter -->
            <div style="margin-bottom: 30px;">
                <label for="modal_catatan" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Catatan / Deskripsi <span style="color: #8f8f8f; font-weight: normal; text-transform: none;">(Opsional)</span>
                </label>
                <div style="position: relative;">
                    <textarea 
                        id="modal_catatan" 
                        name="catatan" 
                        rows="4"
                        maxlength="500"
                        oninput="updateCharCount(this)"
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 60px 12px 15px; transition: all 0.3s ease; font-size: 14px; resize: vertical; min-height: 100px;"
                        placeholder="Tambahkan catatan atau deskripsi untuk perubahan status ini. Misalnya: 'Laporan sedang dalam proses verifikasi dokumen', 'Menunggu persetujuan dari pihak terkait', dll."
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                    ></textarea>
                    <div style="position: absolute; bottom: 12px; right: 15px; font-family: 'Jost', sans-serif; font-size: 11px; color: #8f8f8f;">
                        <span id="charCount">0</span>/500
                    </div>
                </div>
                <p style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f; margin-top: 8px; line-height: 1.5;">
                    <span style="font-weight: 500;">Tip:</span> Jelaskan alasan perubahan status atau langkah selanjutnya yang akan dilakukan.
                </p>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 15px; padding-top: 25px; border-top: 1px solid #e9ecef;">
                <button 
                    type="button"
                    onclick="closeStatusModal()" 
                    class="kaira-btn"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 25px; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; cursor: pointer; transition: all 0.3s ease; font-size: 13px;"
                    onmouseover="this.style.backgroundColor='#e9ecef'; this.style.borderColor='#dee2e6'"
                    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#e9ecef'"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    id="submitStatusBtn"
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                >
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Claim Modal
    function openClaimModal(laporanId, judul) {
        const modal = document.getElementById('claimModal');
        const form = document.getElementById('claim-form-' + laporanId);
        const modalJudul = document.getElementById('claimModalJudul');
        
        if (modalJudul) {
            modalJudul.textContent = judul;
        }
        
        // Store form reference
        modal.setAttribute('data-form-id', 'claim-form-' + laporanId);
        
        // Show modal
        modal.classList.remove('hidden');
    }
    
    function closeClaimModal() {
        const modal = document.getElementById('claimModal');
        modal.classList.add('hidden');
    }
    
    function confirmClaim() {
        const modal = document.getElementById('claimModal');
        const formId = modal.getAttribute('data-form-id');
        const form = document.getElementById(formId);
        
        if (form) {
            // Show loading state
            const confirmBtn = document.getElementById('confirmClaimBtn');
            const originalText = confirmBtn.innerHTML;
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = '<svg class="animate-spin h-4 w-4 inline-block mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
            
            // Submit form via AJAX
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                // Check if response is JSON
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.includes("application/json")) {
                    return response.json().then(data => ({ data, ok: response.ok }));
                }
                // If redirect or HTML, treat as success
                return { data: { success: true }, ok: true };
            })
            .then(({ data, ok }) => {
                if (ok && data && data.success) {
                    // Show success notification
                    showNotification(data.message || 'Laporan berhasil diambil! Anda sekarang dapat mengubah status laporan ini.', 'success');
                    
                    // Close modal
                    closeClaimModal();
                    
                    // Reload page after short delay to show updated state
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    // Show error notification
                    showNotification(data?.message || 'Terjadi kesalahan saat mengambil laporan', 'error');
                    confirmBtn.disabled = false;
                    confirmBtn.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat mengambil laporan. Silakan coba lagi.', 'error');
                confirmBtn.disabled = false;
                confirmBtn.innerHTML = originalText;
            });
        }
    }
    
    function openStatusModal(laporanId, judul, currentStatus, currentCatatan) {
        const modal = document.getElementById('statusModal');
        const form = document.getElementById('statusForm');
        const modalJudul = document.getElementById('modalJudul');
        const modalStatus = document.getElementById('modal_status');
        const modalCatatan = document.getElementById('modal_catatan');
        const modalStatusCurrent = document.getElementById('modalStatusCurrentValue');
        
        // Set form action
        form.action = `/admin/laporan/${laporanId}/status`;
        
        // Set values
        modalJudul.textContent = judul;
        modalStatus.value = currentStatus;
        modalCatatan.value = currentCatatan || '';
        modalStatusCurrent.textContent = getStatusLabel(currentStatus);
        
        // Update character count
        updateCharCount(modalCatatan);
        
        // Update status preview and icon
        updateStatusPreview(currentStatus);
        
        // Reset all options
        const options = modalStatus.querySelectorAll('option');
        options.forEach(opt => {
            opt.disabled = false;
            opt.style.display = '';
        });
        
        // Disable options based on current status (prevent going backwards)
        const statusOrder = {
            'terkirim': 1,
            'diverifikasi': 2,
            'diproses': 3,
            'selesai': 4,
            'ditolak': 4
        };
        
        const currentOrder = statusOrder[currentStatus] || 0;
        
        // Disable status yang lebih rendah (mundur)
        options.forEach(opt => {
            const optValue = opt.value;
            const optOrder = statusOrder[optValue] || 0;
            
            // Jika status final (selesai/ditolak), disable semua kecuali current
            if (currentStatus === 'selesai' || currentStatus === 'ditolak') {
                if (optValue !== currentStatus) {
                    opt.disabled = true;
                    opt.style.color = '#9ca3af';
                }
            }
            // Jika bukan final, disable yang lebih rendah
            else if (optOrder < currentOrder && optValue !== 'ditolak') {
                opt.disabled = true;
                opt.style.color = '#9ca3af';
            }
            // Selesai hanya bisa dari diproses
            else if (optValue === 'selesai' && currentStatus !== 'diproses') {
                opt.disabled = true;
                opt.style.color = '#9ca3af';
            }
        });
        
        // Show modal
        modal.style.display = 'flex';
    }
    
    // Update status preview badge
    function updateStatusPreview(status) {
        const preview = document.getElementById('statusPreview');
        const badge = document.getElementById('statusPreviewBadge');
        
        if (!preview || !badge) return;
        
        const statusConfig = {
            'terkirim': { 
                label: 'Terkirim', 
                bg: '#e7f3ff',
                text: '#0d6efd'
            },
            'diverifikasi': { 
                label: 'Diverifikasi', 
                bg: '#fff4e6',
                text: '#f59e0b'
            },
            'diproses': { 
                label: 'Diproses', 
                bg: '#ffe4cc',
                text: '#f97316'
            },
            'ditolak': { 
                label: 'Ditolak', 
                bg: '#fee2e2',
                text: '#ef4444'
            },
            'selesai': { 
                label: 'Selesai', 
                bg: '#d1fae5',
                text: '#10b981'
            }
        };
        
        const config = statusConfig[status] || { 
            label: status, 
            bg: '#f8f9fa',
            text: '#8f8f8f'
        };
        
        badge.textContent = config.label;
        badge.style.backgroundColor = config.bg;
        badge.style.color = config.text;
        preview.style.display = 'block';
    }
    
    // Get status label
    function getStatusLabel(status) {
        const labels = {
            'terkirim': 'Terkirim',
            'diverifikasi': 'Diverifikasi',
            'diproses': 'Diproses',
            'selesai': 'Selesai',
            'ditolak': 'Ditolak'
        };
        return labels[status] || status;
    }
    
    // Update character count
    function updateCharCount(textarea) {
        const charCount = document.getElementById('charCount');
        if (charCount) {
            const count = textarea.value.length;
            charCount.textContent = count;
            
            // Change color based on count
            if (count > 450) {
                charCount.classList.add('text-red-500');
                charCount.classList.remove('text-gray-400');
            } else if (count > 400) {
                charCount.classList.add('text-yellow-500');
                charCount.classList.remove('text-gray-400', 'text-red-500');
            } else {
                charCount.classList.remove('text-red-500', 'text-yellow-500');
                charCount.classList.add('text-gray-400');
            }
        }
    }

    // Handle form submission with loading state
    function handleStatusSubmit(event) {
        event.preventDefault();
        
        const form = event.target;
        const submitBtn = document.getElementById('submitStatusBtn');
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="animate-spin h-4 w-4 inline-block mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
        
        // Submit form
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(new FormData(form))
        })
        .then(response => {
            if (response.ok || response.redirected) {
                showNotification('Status laporan berhasil diperbarui!', 'success');
                closeStatusModal();
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                return response.json().then(data => {
                    throw new Error(data.message || 'Terjadi kesalahan');
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification(error.message || 'Terjadi kesalahan saat memperbarui status', 'error');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    }

    function closeStatusModal() {
        const modal = document.getElementById('statusModal');
        const form = document.getElementById('statusForm');
        
        // Reset form
        if (form) {
            form.reset();
            const charCount = document.getElementById('charCount');
            if (charCount) charCount.textContent = '0';
            const statusPreview = document.getElementById('statusPreview');
            if (statusPreview) statusPreview.style.display = 'none';
        }
        
        modal.style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const statusModal = document.getElementById('statusModal');
        const claimModal = document.getElementById('claimModal');
        if (event.target === statusModal) {
            closeStatusModal();
        }
        if (event.target === claimModal) {
            closeClaimModal();
        }
    }
    
    // Enhanced Notification Function
    function showNotification(message, type = 'success') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.toast-notification');
        existingNotifications.forEach(notif => notif.remove());
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `toast-notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-md transform transition-all duration-300 ${
            type === 'success' 
                ? 'bg-green-500 text-white' 
                : type === 'error' 
                ? 'bg-red-500 text-white' 
                : 'bg-blue-500 text-white'
        }`;
        
        // Icon based on type
        let icon = '';
        if (type === 'success') {
            icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        } else if (type === 'error') {
            icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        } else {
            icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        }
        
        notification.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 mt-0.5">
                    ${icon}
                </div>
                <div class="flex-1">
                    <p class="font-medium">${message}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 ml-2 hover:opacity-75">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
        
        // Add to page
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateX(0)';
        }, 10);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 5000);
    }
    
    // Show success/error messages from session
    @if(session('success'))
        showNotification('{{ session('success') }}', 'success');
    @endif
    
    @if(session('error'))
        showNotification('{{ session('error') }}', 'error');
    @endif
</script>
@endpush
@endsection

