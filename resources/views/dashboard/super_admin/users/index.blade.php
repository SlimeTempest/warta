@extends('layouts.app')

@section('title', 'Kelola User - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div style="margin-bottom: 50px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Kelola User</h1>
            <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Kelola semua akun pengguna, admin, dan super admin</p>
        </div>
        <a href="{{ route('users.create') }}" 
            class="kaira-btn kaira-btn-primary"
            style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; font-size: 14px;"
            onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
            onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'">
            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Admin
        </a>
    </div>

    <!-- Statistics Cards - Kaira Style -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Total User</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; letter-spacing: 0.5px;">{{ $totalUsers }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Total Admin</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #0d6efd; letter-spacing: 0.5px;">{{ $totalAdmins }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Super Admin</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #7c3aed; letter-spacing: 0.5px;">{{ $totalSuperAdmins }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Aktif</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #10b981; letter-spacing: 0.5px;">{{ $totalActive }}</p>
        </div>
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
            <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; margin-bottom: 10px;">Nonaktif</p>
            <p style="font-family: 'Marcellus', serif; font-size: 36px; color: #ef4444; letter-spacing: 0.5px;">{{ $totalInactive }}</p>
        </div>
    </div>

    <!-- Search and Filter - Kaira Style -->
    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 30px; margin-bottom: 30px;">
        <form method="GET" action="{{ route('users.index') }}" style="display: flex; flex-direction: column; gap: 20px;">
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
                            placeholder="Cari nama atau email..."
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
                    <!-- Filter Role -->
                    <div style="flex: 1; min-width: 180px; position: relative;">
                        <label for="role" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Filter Role</label>
                        <div style="position: relative;">
                            <select 
                                id="role" 
                                name="role" 
                                class="kaira-input"
                                style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                                onchange="this.form.submit()"
                                onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                                onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                            >
                                <option value="all" {{ request('role') === 'all' || !request('role') ? 'selected' : '' }}>Semua Role</option>
                                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super_admin" {{ request('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            </select>
                            <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                                <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Status -->
                    <div style="flex: 1; min-width: 180px; position: relative;">
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
                                <option value="" {{ !request('status') ? 'selected' : '' }}>Semua Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
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
                        @if(request('search') || request('role') || request('status'))
                            <a 
                                href="{{ route('users.index') }}" 
                                class="kaira-btn"
                                style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 25px; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease; font-size: 14px;"
                                onmouseover="this.style.backgroundColor='#e9ecef'; this.style.borderColor='#dee2e6'"
                                onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#e9ecef'"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Users Table - Kaira Style -->
    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table class="kaira-table" style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                    <tr>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Nama</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Email</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Role</th>
                        <th style="padding: 20px; text-align: center; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                        <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Tanggal Daftar</th>
                        <th style="padding: 20px; text-align: center; font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 600; color: #212529; text-transform: uppercase; letter-spacing: 0.5px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="border-bottom: 1px solid #e9ecef; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 20px; white-space: nowrap;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500; color: #212529;">{{ $user->name }}</div>
                            </td>
                            <td style="padding: 20px; white-space: nowrap;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">{{ $user->email }}</div>
                            </td>
                            <td style="padding: 20px; white-space: nowrap;">
                                <span class="kaira-badge" style="
                                    font-family: 'Jost', sans-serif;
                                    font-size: 11px;
                                    font-weight: 600;
                                    padding: 6px 14px;
                                    border-radius: 20px;
                                    text-transform: uppercase;
                                    letter-spacing: 0.5px;
                                    display: inline-block;
                                    @if($user->role === 'super_admin') 
                                        background-color: #f3e8ff; 
                                        color: #7c3aed;
                                    @elseif($user->role === 'admin') 
                                        background-color: #dbeafe; 
                                        color: #0d6efd;
                                    @else 
                                        background-color: #f3f4f6; 
                                        color: #6b7280;
                                    @endif
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>
                            <td style="padding: 20px; white-space: nowrap; text-align: center;">
                                @if($user->id === auth()->id())
                                    <span class="kaira-badge" style="font-family: 'Jost', sans-serif; font-size: 11px; font-weight: 600; padding: 6px 14px; border-radius: 20px; background-color: #f3f4f6; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">
                                        Aktif (Anda)
                                    </span>
                                @else
                                    <div style="display: flex; align-items: center; justify-content: center;">
                                        <label style="position: relative; display: inline-flex; align-items: center; cursor: pointer;">
                                            <input 
                                                type="checkbox" 
                                                class="toggle-status" 
                                                data-user-id="{{ $user->id }}"
                                                {{ $user->is_active ? 'checked' : '' }}
                                                style="position: absolute; opacity: 0; width: 0; height: 0;"
                                            >
                                            <div id="toggle-container-{{ $user->id }}" style="
                                                position: relative;
                                                width: 48px;
                                                height: 26px;
                                                background-color: {{ $user->is_active ? '#10b981' : '#e5e7eb' }};
                                                border-radius: 13px;
                                                transition: background-color 0.3s ease;
                                            ">
                                                <div id="toggle-circle-{{ $user->id }}" style="
                                                    position: absolute;
                                                    top: 2px;
                                                    left: {{ $user->is_active ? '24px' : '2px' }};
                                                    width: 22px;
                                                    height: 22px;
                                                    background-color: white;
                                                    border-radius: 50%;
                                                    transition: left 0.3s ease;
                                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                                "></div>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 20px; white-space: nowrap; text-align: left;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">{{ $user->created_at->format('d/m/Y') }}</div>
                            </td>
                            <td style="padding: 20px; white-space: nowrap; text-align: center;">
                                <div style="display: inline-flex; align-items: center; gap: 15px;">
                                    <a href="{{ route('users.edit', $user) }}" style="font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 500; color: #0d6efd; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#0a58ca'" onmouseout="this.style.color='#0d6efd'">Edit</a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return kairaConfirmSubmit(event, 'Apakah Anda yakin ingin menghapus akun ini?', 'Hapus Akun');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 500; color: #ef4444; background: none; border: none; cursor: pointer; transition: color 0.3s ease; padding: 0;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#ef4444'">Hapus</button>
                                        </form>
                                    @else
                                        <span style="font-family: 'Jost', sans-serif; font-size: 13px; color: #d1d5db;">-</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 60px 20px; text-align: center;">
                                <div style="width: 64px; height: 64px; background-color: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                    <svg style="width: 32px; height: 32px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <p style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 500; color: #212529; margin-bottom: 5px;">
                                    @if(request('search') || request('role') || request('status'))
                                        Tidak ada user yang sesuai dengan filter
                                    @else
                                        Belum ada user
                                    @endif
                                </p>
                                <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">User yang terdaftar akan muncul di sini</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div style="padding: 20px; border-top: 1px solid #e9ecef;">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleSwitches = document.querySelectorAll('.toggle-status');
        
        toggleSwitches.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const userId = this.getAttribute('data-user-id');
                const isChecked = this.checked;
                const toggleContainer = document.getElementById('toggle-container-' + userId);
                const toggleCircle = document.getElementById('toggle-circle-' + userId);
                
                // Disable toggle during request
                this.disabled = true;
                
                // Update toggle visual state
                if (toggleContainer) {
                    toggleContainer.style.backgroundColor = isChecked ? '#10b981' : '#e5e7eb';
                }
                if (toggleCircle) {
                    toggleCircle.style.left = isChecked ? '24px' : '2px';
                }
                
                // Make AJAX request
                fetch(`/users/${userId}/toggle-status`, {
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
                        // Update toggle visual state
                        if (toggleContainer) {
                            toggleContainer.style.backgroundColor = data.is_active ? '#10b981' : '#e5e7eb';
                        }
                        if (toggleCircle) {
                            toggleCircle.style.left = data.is_active ? '24px' : '2px';
                        }
                        
                        // Show success message
                        showNotification(data.message, 'success');
                    } else {
                        // Revert toggle
                        this.checked = !isChecked;
                        if (toggleContainer) {
                            toggleContainer.style.backgroundColor = !isChecked ? '#10b981' : '#e5e7eb';
                        }
                        if (toggleCircle) {
                            toggleCircle.style.left = !isChecked ? '24px' : '2px';
                        }
                        showNotification(data.error || 'Terjadi kesalahan', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Revert toggle
                    this.checked = !isChecked;
                    if (toggleContainer) {
                        toggleContainer.style.backgroundColor = !isChecked ? '#10b981' : '#e5e7eb';
                    }
                    if (toggleCircle) {
                        toggleCircle.style.left = !isChecked ? '24px' : '2px';
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
