@extends('layouts.app')

@section('title', 'Tambah Instansi - Warta.id')

@section('content')
<div class="max-w-2xl mx-auto">
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Tambah Instansi</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Buat instansi baru</p>
    </div>

    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px;">
        <form method="POST" action="{{ route('instansi.store') }}">
            @csrf

            <div style="margin-bottom: 25px;">
                <label for="nama" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Nama Instansi <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    value="{{ old('nama') }}"
                    required 
                    autofocus
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('nama') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                    placeholder="Contoh: Kelurahan A, PLN, Iconnet"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('nama') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >
                @error('nama')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label for="alamat" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Alamat
                </label>
                <textarea 
                    id="alamat" 
                    name="alamat" 
                    rows="4"
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('alamat') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px; resize: vertical;"
                    placeholder="Masukkan alamat instansi"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('alamat') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input 
                        type="checkbox" 
                        name="status_checkbox" 
                        value="1"
                        {{ old('status_checkbox', true) ? 'checked' : '' }}
                        style="width: 18px; height: 18px; margin-right: 12px; cursor: pointer; accent-color: #212529;"
                    >
                    <span style="font-family: 'Jost', sans-serif; font-size: 14px; color: #212529;">Aktifkan instansi</span>
                </label>
                <input type="hidden" name="status" value="suspended" id="status-input">
                @error('status')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 25px; border-top: 1px solid #e9ecef;">
                <a href="{{ route('instansi.index') }}" 
                    class="kaira-btn"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 25px; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#e9ecef'; this.style.borderColor='#dee2e6'"
                    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#e9ecef'">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.querySelector('input[name="status_checkbox"]');
        const statusInput = document.getElementById('status-input');
        
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                statusInput.value = 'active';
            } else {
                statusInput.value = 'suspended';
            }
        });
        
        // Initialize value
        if (checkbox.checked) {
            statusInput.value = 'active';
        } else {
            statusInput.value = 'suspended';
        }
    });
</script>
@endpush
@endsection

