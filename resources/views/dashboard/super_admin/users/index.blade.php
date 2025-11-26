@extends('layouts.app')

@section('title', 'Kelola User - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Kelola User</h1>
            <p class="text-gray-600 mt-2">Kelola semua akun pengguna, admin, dan super admin</p>
        </div>
        <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Admin
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600 mb-1">Total User</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600 mb-1">Total Admin</p>
            <p class="text-2xl font-bold text-blue-600">{{ $totalAdmins }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600 mb-1">Super Admin</p>
            <p class="text-2xl font-bold text-purple-600">{{ $totalSuperAdmins }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600 mb-1">Aktif</p>
            <p class="text-2xl font-bold text-green-600">{{ $totalActive }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600 mb-1">Nonaktif</p>
            <p class="text-2xl font-bold text-red-600">{{ $totalInactive }}</p>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" action="{{ route('users.index') }}" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="search" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="shadow appearance-none border rounded w-full py-2 px-3 pl-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                    <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filter Role -->
            <div class="md:w-48">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Filter Role</label>
                <select 
                    id="role" 
                    name="role" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    onchange="this.form.submit()"
                >
                    <option value="all" {{ request('role') === 'all' || !request('role') ? 'selected' : '' }}>Semua Role</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="super_admin" {{ request('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div>

            <!-- Filter Status -->
            <div class="md:w-48">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                <select 
                    id="status" 
                    name="status" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    onchange="this.form.submit()"
                >
                    <option value="" {{ !request('status') ? 'selected' : '' }}>Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex items-end">
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto"
                >
                    Cari
                </button>
                @if(request('search') || request('role') || request('status'))
                    <a 
                        href="{{ route('users.index') }}" 
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2"
                    >
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($user->role === 'super_admin') bg-purple-100 text-purple-800
                                    @elseif($user->role === 'admin') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->id === auth()->id())
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Aktif (Anda)
                                    </span>
                                @else
                                    <label class="relative inline-flex items-center cursor-pointer group">
                                        <input 
                                            type="checkbox" 
                                            class="sr-only peer toggle-status" 
                                            data-user-id="{{ $user->id }}"
                                            {{ $user->is_active ? 'checked' : '' }}
                                        >
                                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500 peer-disabled:opacity-50 peer-disabled:cursor-not-allowed"></div>
                                        <span class="ml-3 text-sm font-medium text-gray-700 status-label-{{ $user->id }}">
                                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </label>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                @if(request('search') || request('role') || request('status'))
                                    Tidak ada user yang sesuai dengan filter
                                @else
                                    Belum ada user
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t">
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
                const label = document.querySelector('.status-label-' + userId);
                const row = this.closest('tr');
                
                // Disable toggle during request
                this.disabled = true;
                
                // Show loading state
                if (label) {
                    label.textContent = 'Memproses...';
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
                        // Update label
                        if (label) {
                            label.textContent = data.is_active ? 'Aktif' : 'Nonaktif';
                        }
                        
                        // Show success message
                        showNotification(data.message, 'success');
                        
                        // Update row styling if needed
                        if (row) {
                            row.classList.toggle('bg-green-50', data.is_active);
                            row.classList.toggle('bg-red-50', !data.is_active);
                        }
                    } else {
                        // Revert toggle
                        this.checked = !isChecked;
                        showNotification(data.error || 'Terjadi kesalahan', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Revert toggle
                    this.checked = !isChecked;
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
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
            type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
        }`;
        notification.textContent = message;
        
        // Add to page
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.transition = 'opacity 0.5s';
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 3000);
    }
</script>
@endpush
@endsection
