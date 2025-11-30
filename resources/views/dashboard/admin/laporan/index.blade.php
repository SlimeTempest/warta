@extends('layouts.app')

@section('title', 'Laporan Masuk - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Laporan Masuk</h1>
        <p class="text-gray-600 mt-2">Laporan yang masuk ke instansi yang Anda kelola</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instansi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($laporan as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $item->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $item->instansi->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                @if($item->admin)
                                    @if($item->admin_id === auth()->id())
                                        <span class="text-green-600 font-medium">Anda</span>
                                    @else
                                        {{ $item->admin->name }}
                                    @endif
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($item->status === 'terkirim') bg-blue-100 text-blue-800
                                @elseif($item->status === 'diverifikasi') bg-yellow-100 text-yellow-800
                                @elseif($item->status === 'diproses') bg-purple-100 text-purple-800
                                @elseif($item->status === 'selesai') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-3">
                                @if(!in_array($item->status, ['selesai', 'ditolak']))
                                    @if($item->admin_id === null)
                                        {{-- Laporan belum diambil --}}
                                        <button 
                                            type="button"
                                            onclick="openClaimModal({{ $item->id }}, '{{ addslashes($item->judul) }}')"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs flex items-center gap-1 transition-all duration-200 hover:shadow-md"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Ambil Laporan
                                        </button>
                                        <form id="claim-form-{{ $item->id }}" action="{{ route('admin.laporan.claim', $item) }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    @elseif($item->admin_id === auth()->id())
                                        {{-- Laporan diambil oleh admin ini --}}
                                        <button 
                                            onclick="openStatusModal({{ $item->id }}, '{{ $item->judul }}', '{{ $item->status }}', '{{ addslashes($item->catatan_admin ?? '') }}')"
                                            class="text-green-600 hover:text-green-900 font-medium"
                                        >
                                            Ubah Status
                                        </button>
                                        <span class="text-gray-300">|</span>
                                    @else
                                        {{-- Laporan diambil oleh admin lain --}}
                                        <span class="text-gray-400 text-xs">Diambil oleh: {{ $item->admin->name }}</span>
                                    @endif
                                    <span class="text-gray-300">|</span>
                                @else
                                    {{-- Status final - tidak bisa diubah --}}
                                    <span class="text-gray-400 text-xs">Status final</span>
                                    <span class="text-gray-300">|</span>
                                @endif
                                <a href="{{ route('admin.laporan.show', $item) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            Belum ada laporan masuk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($laporan->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $laporan->links() }}
            </div>
        @endif
    </div>
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
<div id="statusModal" class="hidden fixed inset-0 overflow-y-auto h-full w-full z-50" style="background-color: rgba(0, 0, 0, 0.1); backdrop-filter: blur(4px);">
    <div class="relative top-20 mx-auto p-6 border w-full max-w-md shadow-xl rounded-lg bg-white">
        <div class="mt-3">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Ubah Status Laporan</h3>
                <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Laporan Info -->
            <div class="mb-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 mb-1">Laporan</p>
                <p class="text-sm font-semibold text-gray-900" id="modalJudul"></p>
                <p class="text-xs text-gray-500 mt-1">Status saat ini: <span id="modalStatusCurrentValue"></span></p>
            </div>

            <form id="statusForm" method="POST" onsubmit="handleStatusSubmit(event)">
                @csrf
                @method('PUT')

                <!-- Status Selection with Visual Indicator -->
                <div class="mb-4">
                    <label for="modal_status" class="block text-gray-700 text-sm font-semibold mb-2">
                        Status Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select 
                            id="modal_status" 
                            name="status" 
                            required
                            onchange="updateStatusPreview(this.value)"
                            class="shadow appearance-none border rounded-lg w-full py-2.5 px-4 pr-8 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white"
                        >
                            <option value="terkirim">Terkirim</option>
                            <option value="diverifikasi">Diverifikasi</option>
                            <option value="diproses">Diproses</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        <!-- Dropdown Arrow (right side) -->
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                    <!-- Status Preview Badge with Visual Feedback -->
                    <div id="statusPreview" class="mt-3">
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-500">Status yang dipilih:</span>
                            <span id="statusPreviewBadge" class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium transition-all"></span>
                        </div>
                    </div>
                </div>

                <!-- Catatan/Deskripsi with Character Counter -->
                <div class="mb-4">
                    <label for="modal_catatan" class="block text-gray-700 text-sm font-semibold mb-2">
                        <span>Catatan / Deskripsi</span>
                        <span class="text-gray-400 font-normal text-xs ml-1">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <textarea 
                            id="modal_catatan" 
                            name="catatan" 
                            rows="4"
                            maxlength="500"
                            oninput="updateCharCount(this)"
                            class="shadow appearance-none border rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                            placeholder="Tambahkan catatan atau deskripsi untuk perubahan status ini. Misalnya: 'Laporan sedang dalam proses verifikasi dokumen', 'Menunggu persetujuan dari pihak terkait', dll."
                        ></textarea>
                        <div class="absolute bottom-2 right-2 text-xs text-gray-400">
                            <span id="charCount">0</span>/500
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="font-medium">Tip:</span> Jelaskan alasan perubahan status atau langkah selanjutnya yang akan dilakukan.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t">
                    <button 
                        type="button"
                        onclick="closeStatusModal()" 
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        id="submitStatusBtn"
                        class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-colors shadow-md hover:shadow-lg"
                    >
                        Update Status
                    </button>
                </div>
            </form>
        </div>
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
        modal.classList.remove('hidden');
    }
    
    // Update status preview badge
    function updateStatusPreview(status) {
        const preview = document.getElementById('statusPreview');
        const badge = document.getElementById('statusPreviewBadge');
        
        if (!preview || !badge) return;
        
        const statusConfig = {
            'terkirim': { 
                label: 'Terkirim', 
                class: 'bg-blue-50 text-blue-700 border border-blue-200'
            },
            'diverifikasi': { 
                label: 'Diverifikasi', 
                class: 'bg-yellow-50 text-yellow-700 border border-yellow-200'
            },
            'diproses': { 
                label: 'Diproses', 
                class: 'bg-purple-50 text-purple-700 border border-purple-200'
            },
            'ditolak': { 
                label: 'Ditolak', 
                class: 'bg-red-50 text-red-700 border border-red-200'
            },
            'selesai': { 
                label: 'Selesai', 
                class: 'bg-green-50 text-green-700 border border-green-200'
            }
        };
        
        const config = statusConfig[status] || { 
            label: status, 
            class: 'bg-gray-50 text-gray-700 border border-gray-200'
        };
        
        badge.textContent = config.label;
        badge.className = `inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium transition-all ${config.class}`;
        preview.classList.remove('hidden');
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
            document.getElementById('charCount').textContent = '0';
            document.getElementById('statusPreview').classList.add('hidden');
        }
        
        modal.classList.add('hidden');
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

