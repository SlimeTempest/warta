@extends('layouts.app')

@section('title', 'Profil Saya - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Profil Saya</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Informasi akun Anda</p>
    </div>

    @if(session('success'))
        <div class="mb-4" style="background-color: #d1fae5; border-left: 4px solid #10b981; color: #065f46; padding: 15px; margin-bottom: 30px;">
            <p style="font-family: 'Jost', sans-serif; font-size: 14px; margin: 0;">{{ session('success') }}</p>
        </div>
    @endif

    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px; margin-bottom: 30px;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Nama</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 500; color: #212529; margin: 0;">{{ $user->name }}</p>
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Email</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 500; color: #212529; margin: 0;">{{ $user->email }}</p>
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Role</label>
                <span style="font-family: 'Jost', sans-serif; font-weight: 500; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px 14px; display: inline-block; margin-top: 8px;
                    @if($user->role === 'super_admin') background-color: #f3e8ff; color: #7c3aed;
                    @elseif($user->role === 'admin') background-color: #dbeafe; color: #2563eb;
                    @else background-color: #dcfce7; color: #16a34a;
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                </span>
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Status</label>
                <span style="font-family: 'Jost', sans-serif; font-weight: 500; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px 14px; display: inline-block; margin-top: 8px;
                    @if($user->is_active) background-color: #d1fae5; color: #10b981;
                    @else background-color: #fee2e2; color: #ef4444;
                    @endif">
                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Terdaftar Sejak</label>
                <p style="font-family: 'Jost', sans-serif; font-size: 15px; color: #212529; margin: 8px 0 0 0;">{{ $user->created_at->format('d M Y, H:i') }}</p>
            </div>
            
            @if($user->role === 'admin' && $user->instansi->count() > 0)
                <div style="grid-column: 1 / -1; margin-bottom: 25px;">
                    <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #8f8f8f; font-size: 13px; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Instansi yang Dikelola</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 8px;">
                        @foreach($user->instansi as $instansi)
                            <span style="font-family: 'Jost', sans-serif; font-weight: 500; font-size: 12px; padding: 6px 14px; background-color: #dbeafe; color: #2563eb; display: inline-block;">
                                {{ $instansi->nama }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #e9ecef;">
            <a href="{{ route('profile.edit') }}" class="kaira-btn kaira-btn-primary" style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; font-size: 14px;" onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'" onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'">
                Edit Profil
            </a>
        </div>

        <!-- Reset Token Section -->
        <div style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #e9ecef;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
                <div>
                    <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Token Reset Password
                    </label>
                    <p style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f; margin: 0;">
                        Simpan token ini dengan aman untuk reset password
                    </p>
                </div>
                <form action="{{ route('profile.generateToken') }}" method="POST" style="flex-shrink: 0;" onsubmit="return kairaConfirmSubmit(event, '⚠️ PERINGATAN: Apakah Anda yakin ingin membuat token baru?\n\nToken lama tidak akan bisa digunakan lagi untuk reset password. Pastikan Anda sudah mencatat token baru dengan baik!', 'Buat Token Baru');">
                    @csrf
                    <button 
                        type="submit" 
                        class="kaira-btn"
                        style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 10px 25px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 13px;"
                        onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                        onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                    >
                        Buat Token Baru
                    </button>
                </form>
            </div>
            
            <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; padding: 20px;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                    <div style="width: 40px; height: 40px; background-color: #fff4e6; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg style="width: 20px; height: 20px; color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div style="flex: 1;">
                        <p style="font-family: 'Jost', sans-serif; font-size: 13px; color: #212529; margin: 0; line-height: 1.6;">
                            Token ini digunakan untuk reset password jika Anda lupa password. Tanpa token ini, Anda tidak bisa reset password sendiri.
                        </p>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <code style="font-family: 'Courier New', monospace; font-size: 13px; color: #212529; background-color: white; padding: 12px 15px; border: 1px solid #e9ecef; display: block; word-break: break-all; font-weight: 500; line-height: 1.6;">
                            {{ $user->reset_token ?? 'Token belum dibuat' }}
                        </code>
                    </div>
                    <button 
                        type="button" 
                        onclick="copyToken()" 
                        class="kaira-btn"
                        style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 25px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 13px; white-space: nowrap;"
                        onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                        onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                    >
                        Salin Token
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Section -->
    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px;">
        <h2 style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; margin-bottom: 30px; letter-spacing: 0.5px;">Ubah Password</h2>
        
        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf

            <div style="margin-bottom: 25px;">
                <label for="current_password" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Password Saat Ini <span style="color: #dc3545;">*</span>
                </label>
                <div style="position: relative;">
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        required
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('current_password') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 45px 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                        placeholder="Masukkan password saat ini"
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='{{ $errors->has('current_password') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('current_password')"
                        style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #8f8f8f; padding: 0;"
                    >
                        <svg id="eye-current_password" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-off-current_password" style="width: 20px; height: 20px; display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>
                </div>
                @error('current_password')
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
                    Password Baru <span style="color: #dc3545;">*</span>
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
                        style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #8f8f8f; padding: 0;"
                    >
                        <svg id="eye-password" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

            <div style="margin-bottom: 30px;">
                <label for="password_confirmation" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Konfirmasi Password Baru <span style="color: #dc3545;">*</span>
                </label>
                <div style="position: relative;">
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required
                        class="kaira-input"
                        style="font-family: 'Jost', sans-serif; border: 1px solid #e9ecef; width: 100%; padding: 12px 45px 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                        placeholder="Ulangi password baru"
                        onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                        onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('password_confirmation')"
                        style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #8f8f8f; padding: 0;"
                    >
                        <svg id="eye-password_confirmation" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-off-password_confirmation" style="width: 20px; height: 20px; display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <button 
                type="submit" 
                class="kaira-btn kaira-btn-primary"
                style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
            >
                Ubah Password
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>

    function copyToken() {
        const token = '{{ $user->reset_token ?? "" }}';
        if (!token) {
            kairaAlert('Token belum tersedia', 'Informasi');
            return;
        }
        
        navigator.clipboard.writeText(token).then(function() {
            kairaAlert('Token berhasil disalin! Pastikan Anda menyimpannya di tempat yang aman.', 'Berhasil');
        }, function() {
            // Fallback untuk browser yang tidak support clipboard API
            const textarea = document.createElement('textarea');
            textarea.value = token;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            kairaAlert('Token berhasil disalin! Pastikan Anda menyimpannya di tempat yang aman.', 'Berhasil');
        });
    }
</script>
@endpush
@endsection

