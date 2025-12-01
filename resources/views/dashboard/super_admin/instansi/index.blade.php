@extends('layouts.app')

@section('title', 'Kelola Instansi - Warta.id')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div style="margin-bottom: 50px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Kelola Instansi</h1>
                <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Kelola data instansi yang terdaftar</p>
            </div>
            <a href="{{ route('instansi.create') }}"
                class="kaira-btn kaira-btn-primary"
                style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; font-size: 14px;"
                onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Instansi
            </a>
        </div>

        <!-- Statistics Cards - Kaira Style -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Total Instansi</p>
                <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; letter-spacing: 0.5px;">{{ $totalInstansi }}</p>
            </div>
            <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Aktif</p>
                <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #10b981; letter-spacing: 0.5px;">{{ $activeInstansi }}</p>
            </div>
            <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Ditangguhkan</p>
                <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #ef4444; letter-spacing: 0.5px;">{{ $suspendedInstansi }}</p>
            </div>
        </div>

        <!-- Search and Filter - Kaira Style -->
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; margin-bottom: 30px;">
            <form method="GET" action="{{ route('instansi.index') }}" style="display: flex; flex-direction: column; gap: 20px;">
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <!-- Search -->
                    <div style="flex: 1;">
                        <label for="search" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Cari</label>
                        <div style="position: relative;">
                            <input 
                                type="text" 
                                id="search" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Cari nama atau alamat..."
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

                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <!-- Filter Status -->
                        <div style="flex: 1; min-width: 200px; position: relative;">
                            <label for="status" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Filter Status</label>
                            <div style="position: relative;">
                                <select 
                                    id="status" 
                                    name="status"
                                    class="kaira-input"
                                    style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                                    onchange="this.form.submit()"
                                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                                >
                                    <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
                                </select>
                                <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                                    <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div style="display: flex; align-items: flex-end; gap: 12px; flex-wrap: wrap;">
                            <button 
                                type="submit"
                                class="kaira-btn kaira-btn-primary"
                                style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 25px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                                onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                                onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                            >
                                Cari
                            </button>
                            @if (request('search') || (request('status') && request('status') !== 'all'))
                                <a href="{{ route('instansi.index') }}"
                                    class="kaira-btn"
                                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 25px; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease; font-size: 14px;"
                                    onmouseover="this.style.backgroundColor='#e9ecef'; this.style.borderColor='#dee2e6'"
                                    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#e9ecef'">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; overflow: hidden;">
            <div style="overflow-x: auto;">
                <table class="kaira-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                            <th style="font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; padding: 20px; text-align: left;">Nama</th>
                            <th style="font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; padding: 20px; text-align: left;">Alamat</th>
                            <th style="font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; padding: 20px; text-align: center;">Status</th>
                            <th style="font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; padding: 20px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($instansi as $item)
                            <tr style="border-bottom: 1px solid #e9ecef; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 20px; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 600; color: #212529;">
                                    {{ $item->nama }}
                                </td>
                                <td style="padding: 20px; font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">
                                    {{ $item->alamat ?? '-' }}
                                </td>
                                <td style="padding: 20px; text-align: center;">
                                    <label style="display: inline-flex; align-items: center; cursor: pointer; justify-content: center;">
                                        <input 
                                            type="checkbox" 
                                            class="toggle-status-instansi"
                                            data-instansi-id="{{ $item->id }}"
                                            {{ $item->status === 'active' ? 'checked' : '' }}
                                            style="display: none;"
                                        >
                                        <div style="position: relative; width: 44px; height: 24px; background-color: {{ $item->status === 'active' ? '#10b981' : '#e9ecef' }}; border-radius: 12px; transition: background-color 0.3s ease;">
                                            <div style="position: absolute; top: 2px; left: {{ $item->status === 'active' ? '22px' : '2px' }}; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: left 0.3s ease; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);"></div>
                                        </div>
                                    </label>
                                </td>
                                <td style="padding: 20px; text-align: center;">
                                    <div style="display: inline-flex; align-items: center; gap: 15px;">
                                        <a href="{{ route('instansi.edit', $item) }}"
                                            style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500; color: #212529; text-decoration: none; transition: color 0.3s ease;" 
                                            onmouseover="this.style.color='#0d6efd'" 
                                            onmouseout="this.style.color='#212529'">
                                            Edit
                                        </a>
                                        <span style="color: #e9ecef;">|</span>
                                        <form action="{{ route('instansi.destroy', $item) }}" method="POST" style="display: inline;"
                                            onsubmit="return kairaConfirmSubmit(event, 'Apakah Anda yakin ingin menghapus instansi ini?', 'Hapus Instansi');">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500; color: #ef4444; background: none; border: none; cursor: pointer; transition: color 0.3s ease; padding: 0;"
                                                onmouseover="this.style.color='#dc2626'" 
                                                onmouseout="this.style.color='#ef4444'">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 60px 20px; text-align: center;">
                                    <div style="width: 64px; height: 64px; background-color: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                        <svg style="width: 32px; height: 32px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <p style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 500; color: #212529; margin-bottom: 5px;">Belum ada instansi</p>
                                    <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">Instansi yang terdaftar akan muncul di sini</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($instansi->hasPages())
                <div style="padding: 25px 30px; border-top: 1px solid #e9ecef;">
                    {{ $instansi->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleSwitches = document.querySelectorAll('.toggle-status-instansi');

                toggleSwitches.forEach(toggle => {
                    toggle.addEventListener('change', function() {
                        const instansiId = this.getAttribute('data-instansi-id');
                        const isChecked = this.checked;
                        const row = this.closest('tr');
                        const toggleDiv = this.nextElementSibling;
                        const toggleCircle = toggleDiv ? toggleDiv.querySelector('div:last-child') : null;

                        // Disable toggle during request
                        this.disabled = true;

                        // Make AJAX request
                        fetch(`/instansi/${instansiId}/toggle-status`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update toggle visual
                                    if (toggleDiv) {
                                        toggleDiv.style.backgroundColor = data.status === 'active' ? '#10b981' : '#e9ecef';
                                    }
                                    if (toggleCircle) {
                                        toggleCircle.style.left = data.status === 'active' ? '22px' : '2px';
                                    }

                                    // Show success message
                                    showNotification(data.message, 'success');
                                } else {
                                    // Revert toggle
                                    this.checked = !isChecked;
                                    if (toggleDiv) {
                                        toggleDiv.style.backgroundColor = !isChecked ? '#10b981' : '#e9ecef';
                                    }
                                    if (toggleCircle) {
                                        toggleCircle.style.left = !isChecked ? '22px' : '2px';
                                    }
                                    showNotification(data.error || 'Terjadi kesalahan', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                // Revert toggle
                                this.checked = !isChecked;
                                if (toggleDiv) {
                                    toggleDiv.style.backgroundColor = !isChecked ? '#10b981' : '#e9ecef';
                                }
                                if (toggleCircle) {
                                    toggleCircle.style.left = !isChecked ? '22px' : '2px';
                                }
                                showNotification('Terjadi kesalahan saat memperbarui status', 'error');
                            })
                            .finally(() => {
                                // Re-enable toggle
                                this.disabled = false;
                            });
                    });
                });
            });

            function showNotification(message, type) {
                // Create notification element
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    padding: 16px 24px;
                    border-radius: 8px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                    font-family: 'Jost', sans-serif;
                    font-size: 14px;
                    font-weight: 500;
                    color: white;
                    background-color: ${type === 'success' ? '#10b981' : '#ef4444'};
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    animation: slideInRight 0.3s ease;
                `;
                
                // Add icon
                const icon = document.createElement('div');
                icon.innerHTML = type === 'success' 
                    ? '<svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                    : '<svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                notification.appendChild(icon);
                
                // Add message
                const messageText = document.createTextNode(message);
                notification.appendChild(messageText);
                
                // Add to page
                document.body.appendChild(notification);
                
                // Remove after 3 seconds
                setTimeout(() => {
                    notification.style.transition = 'opacity 0.5s, transform 0.5s';
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        notification.remove();
                    }, 500);
                }, 3000);
            }
        </script>
        <style>
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        </style>
    @endpush
@endsection
