<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - Warta.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: #f8f9fa; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Jost', sans-serif;">
    <div class="max-w-md w-full bg-white" style="padding: 50px; border: 1px solid #e9ecef;">
        <div class="text-center mb-8">
            <h1 style="font-family: 'Marcellus', serif; font-size: 36px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Warta.id</h1>
            <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Reset Password</p>
        </div>

        @if($errors->any())
            <div class="mb-4" style="background-color: #fee; border-left: 4px solid #dc3545; color: #721c24; padding: 15px;">
                <ul style="list-style: disc; padding-left: 20px; margin: 0;">
                    @foreach($errors->all() as $error)
                        <li style="font-family: 'Jost', sans-serif; font-size: 14px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f; margin-bottom: 30px; line-height: 1.6;">
            Masukkan email dan token reset password Anda untuk membuat password baru.
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

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
                    autofocus
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('email') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                    placeholder="Masukkan email Anda"
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
                <label for="reset_token" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Token Reset Password <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="text" 
                    id="reset_token" 
                    name="reset_token" 
                    value="{{ old('reset_token') }}"
                    required
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('reset_token') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                    placeholder="Masukkan token reset password"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('reset_token') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >
                <p style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f; margin-top: 8px;">
                    Token reset password Anda bisa dilihat di halaman profil setelah login.
                </p>
                @error('reset_token')
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

            <div>
                <button 
                    type="submit" 
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; width: 100%; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                >
                    Reset Password
                </button>
            </div>
        </form>

        <div style="margin-top: 30px; text-align: center; font-family: 'Jost', sans-serif; font-size: 14px; color: #8f8f8f;">
            <a href="{{ route('login') }}" style="color: #212529; text-decoration: none; font-weight: 500; transition: color 0.3s ease;" onmouseover="this.style.color='#0d6efd'" onmouseout="this.style.color='#212529'">Kembali ke Login</a>
        </div>
    </div>

</body>
</html>

