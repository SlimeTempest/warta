@extends('layouts.app')

@section('title', 'Edit Profil - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Edit Profil</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Perbarui informasi akun Anda</p>
    </div>

    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px;">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 30px;">
                <label for="name" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Nama <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $user->name) }}"
                    required 
                    autofocus
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('name') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
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

            <div style="margin-bottom: 30px;">
                <label for="email" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Email <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}"
                    required
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('email') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
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

            <div style="display: flex; align-items: center; justify-content: space-between; gap: 20px; padding-top: 30px; border-top: 1px solid #e9ecef;">
                <a href="{{ route('profile.show') }}" class="kaira-btn" style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: white; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; font-size: 14px;" onmouseover="this.style.borderColor='#212529'; this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.borderColor='#e9ecef'; this.style.backgroundColor='white'">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                >
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

