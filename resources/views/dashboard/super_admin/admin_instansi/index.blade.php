@extends('layouts.app')

@section('title', 'Kelola Admin-Instansi - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Kelola Admin-Instansi</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Atur admin yang mengelola setiap instansi</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form Tambah Admin ke Instansi -->
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px;">
            <h2 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; margin-bottom: 30px; letter-spacing: 0.5px;">Tambah Admin ke Instansi</h2>
            
            <form method="POST" action="{{ route('admin-instansi.store') }}">
                @csrf

                <div style="margin-bottom: 25px;">
                    <label for="user_id" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Admin <span style="color: #dc3545;">*</span>
                    </label>
                    <div style="position: relative;">
                        <select 
                            id="user_id" 
                            name="user_id" 
                            required
                            class="kaira-input"
                            style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('user_id') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                            onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('user_id') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                        >
                            <option value="">Pilih Admin</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}" {{ old('user_id') == $admin->id ? 'selected' : '' }}>
                                    {{ $admin->name }} ({{ ucfirst(str_replace('_', ' ', $admin->role)) }})
                                </option>
                            @endforeach
                        </select>
                        <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                            <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    @error('user_id')
                        <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div style="margin-bottom: 30px;">
                    <label for="instansi_id" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Instansi <span style="color: #dc3545;">*</span>
                    </label>
                    <div style="position: relative;">
                        <select 
                            id="instansi_id" 
                            name="instansi_id" 
                            required
                            class="kaira-input"
                            style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('instansi_id') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                            onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('instansi_id') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                        >
                            <option value="">Pilih Instansi</option>
                            @foreach($instansi->where('status', 'active') as $item)
                                <option value="{{ $item->id }}" {{ old('instansi_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                            <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    @error('instansi_id')
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
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; width: 100%; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                >
                    Tambah
                </button>
            </form>
        </div>

        <!-- Daftar Admin per Instansi -->
        <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px;">
            <h2 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; margin-bottom: 30px; letter-spacing: 0.5px;">Daftar Admin per Instansi</h2>
            
            <!-- Search Box -->
            <div style="margin-bottom: 25px;">
                <div style="position: relative;">
                    <input 
                        type="text" 
                        id="searchInstansi" 
                        placeholder="Cari instansi..." 
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
            
            <div style="display: flex; flex-direction: column; gap: 12px; max-height: 600px; overflow-y: auto; padding-right: 5px;" id="instansiList">
                @forelse($instansi as $item)
                    <div class="instansi-item" data-nama="{{ strtolower($item->nama) }}" style="border: 1px solid #e9ecef; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#0d6efd'" onmouseout="this.style.borderColor='#e9ecef'">
                        <button 
                            type="button" 
                            style="width: 100%; text-align: left; padding: 20px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; cursor: pointer; transition: background-color 0.3s ease;"
                            onclick="toggleInstansi({{ $item->id }})"
                            onmouseover="this.style.backgroundColor='#f8f9fa'"
                            onmouseout="this.style.backgroundColor='transparent'"
                        >
                            <div>
                                <h3 style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; color: #212529; margin-bottom: 5px;">
                                    {{ $item->nama }}
                                </h3>
                                <p style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f; margin: 0;">
                                    {{ $item->admins->count() }} admin
                                    @if($item->status === 'suspended')
                                        <span style="color: #ef4444;">• Ditangguhkan</span>
                                    @endif
                                </p>
                            </div>
                            <svg id="icon-{{ $item->id }}" style="width: 20px; height: 20px; color: #8f8f8f; transition: transform 0.3s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="content-{{ $item->id }}" style="display: none; padding: 0 20px 20px 20px;">
                            @if($item->admins->count() > 0)
                                <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 15px;">
                                    @foreach($item->admins as $admin)
                                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background-color: #f8f9fa; border: 1px solid #e9ecef;">
                                            <span style="font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500; color: #212529;">{{ $admin->name }}</span>
                                            <form action="{{ route('admin-instansi.destroy', ['userId' => $admin->id, 'instansiId' => $item->id]) }}" method="POST" style="display: inline;"
                                                onsubmit="return kairaConfirmSubmit(event, 'Hapus admin dari instansi ini?', 'Hapus Admin');">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    style="font-family: 'Jost', sans-serif; font-size: 12px; font-weight: 500; color: #ef4444; background: none; border: none; cursor: pointer; transition: color 0.3s ease; padding: 0;"
                                                    onmouseover="this.style.color='#dc2626'" 
                                                    onmouseout="this.style.color='#ef4444'">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #8f8f8f; margin-top: 15px; padding: 15px; background-color: #f8f9fa; border: 1px solid #e9ecef; text-align: center;">Belum ada admin</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 60px 20px;">
                        <div style="width: 64px; height: 64px; background-color: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                            <svg style="width: 32px; height: 32px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <p style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 500; color: #212529; margin-bottom: 5px;">Belum ada instansi</p>
                        <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">Instansi yang terdaftar akan muncul di sini</p>
                    </div>
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
        
        if (content.style.display === 'none' || !content.style.display) {
            content.style.display = 'block';
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.style.display = 'none';
            icon.style.transform = 'rotate(0deg)';
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

