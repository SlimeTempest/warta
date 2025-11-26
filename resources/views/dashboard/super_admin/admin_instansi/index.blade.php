@extends('layouts.app')

@section('title', 'Kelola Admin-Instansi - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Admin-Instansi</h1>
        <p class="text-gray-600 mt-2">Atur admin yang mengelola setiap instansi</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form Tambah Admin ke Instansi -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Tambah Admin ke Instansi</h2>
            
            <form method="POST" action="{{ route('admin-instansi.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">
                        Admin <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="user_id" 
                        name="user_id" 
                        required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('user_id') border-red-500 @enderror"
                    >
                        <option value="">Pilih Admin</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ old('user_id') == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }} ({{ ucfirst(str_replace('_', ' ', $admin->role)) }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="instansi_id" class="block text-gray-700 text-sm font-bold mb-2">
                        Instansi <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="instansi_id" 
                        name="instansi_id" 
                        required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('instansi_id') border-red-500 @enderror"
                    >
                        <option value="">Pilih Instansi</option>
                        @foreach($instansi->where('status', 'active') as $item)
                            <option value="{{ $item->id }}" {{ old('instansi_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('instansi_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full"
                >
                    Tambah
                </button>
            </form>
        </div>

        <!-- Daftar Admin per Instansi -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Daftar Admin per Instansi</h2>
            
            <!-- Search Box -->
            <div class="mb-4">
                <input 
                    type="text" 
                    id="searchInstansi" 
                    placeholder="Cari instansi..." 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
            </div>
            
            <div class="space-y-2 max-h-[600px] overflow-y-auto" id="instansiList">
                @forelse($instansi as $item)
                    <div class="border rounded-lg instansi-item" data-nama="{{ strtolower($item->nama) }}">
                        <button 
                            type="button" 
                            class="w-full text-left p-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none instansi-toggle"
                            onclick="toggleInstansi({{ $item->id }})"
                        >
                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    {{ $item->nama }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $item->admins->count() }} admin
                                    @if($item->status === 'suspended')
                                        <span class="text-red-600">• Ditangguhkan</span>
                                    @endif
                                </p>
                            </div>
                            <svg id="icon-{{ $item->id }}" class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="content-{{ $item->id }}" class="hidden px-4 pb-4">
                            @if($item->admins->count() > 0)
                                <ul class="space-y-2 mt-2">
                                    @foreach($item->admins as $admin)
                                        <li class="flex justify-between items-center text-sm bg-gray-50 p-2 rounded">
                                            <span>{{ $admin->name }}</span>
                                            <form action="{{ route('admin-instansi.destroy', ['userId' => $admin->id, 'instansiId' => $item->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus admin dari instansi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-xs">Hapus</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500 mt-2">Belum ada admin</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada instansi</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleInstansi(id) {
        const content = document.getElementById('content-' + id);
        const icon = document.getElementById('icon-' + id);
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    // Search functionality
    document.getElementById('searchInstansi').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.instansi-item');
        
        items.forEach(item => {
            const nama = item.getAttribute('data-nama');
            if (nama.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection

