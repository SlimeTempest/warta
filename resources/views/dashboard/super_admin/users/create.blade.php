@extends('layouts.app')

@section('title', 'Tambah Admin - Warta.id')

@section('content')
<div class="max-w-2xl mx-auto">
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Tambah Admin</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Buat akun admin atau super admin baru</p>
    </div>

    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px;">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div style="margin-bottom: 25px;">
                <label for="name" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Nama Lengkap <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    required 
                    autofocus
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('name') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                    placeholder="Masukkan nama lengkap"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('name') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >
                @error('name')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label for="email" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Email <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required 
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('email') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                    placeholder="Masukkan email"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('email') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >
                @error('email')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Password <span style="color: #dc3545;">*</span>
                </label>
                <div style="position: relative;">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('password') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 45px 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                        placeholder="Minimal 8 karakter"
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='{{ $errors->has('password') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('password')"
                        style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #8f8f8f; transition: color 0.3s ease;"
                        onmouseover="this.style.color='#212529'"
                        onmouseout="this.style.color='#8f8f8f'"
                    >
                        <svg id="eye-password" style="width: 20px; height: 20px; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-off-password" style="width: 20px; height: 20px; display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password_confirmation" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Konfirmasi Password <span style="color: #dc3545;">*</span>
                </label>
                <div style="position: relative;">
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 45px 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                        placeholder="Ulangi password"
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('password_confirmation')"
                        style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #8f8f8f; transition: color 0.3s ease;"
                        onmouseover="this.style.color='#212529'"
                        onmouseout="this.style.color='#8f8f8f'"
                    >
                        <svg id="eye-password_confirmation" style="width: 20px; height: 20px; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-off-password_confirmation" style="width: 20px; height: 20px; display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div style="margin-bottom: 25px;">
                <label for="role" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Role <span style="color: #dc3545;">*</span>
                </label>
                <div style="position: relative;">
                    <select 
                        id="role" 
                        name="role" 
                        required
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('role') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 40px 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white; appearance: none; -webkit-appearance: none; -moz-appearance: none;"
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='{{ $errors->has('role') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                    >
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    <div style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); pointer-events: none;">
                        <svg style="width: 16px; height: 16px; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
                @error('role')
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
                        name="is_active" 
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        style="width: 18px; height: 18px; margin-right: 12px; cursor: pointer; accent-color: #212529;"
                    >
                    <span style="font-family: 'Jost', sans-serif; font-size: 14px; color: #212529;">Aktifkan akun</span>
                </label>
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; gap: 15px; flex-wrap: wrap;">
                <a href="{{ route('users.index') }}" 
                    class="kaira-btn"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #f8f9fa; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#e9ecef'; this.style.borderColor='#dee2e6'"
                    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#e9ecef'">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

