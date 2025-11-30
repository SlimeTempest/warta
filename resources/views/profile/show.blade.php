@extends('layouts.app')

@section('title', 'Profil Saya - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
        <p class="text-gray-600 mt-2">Informasi akun Anda</p>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500">Nama</label>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Email</label>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Role</label>
                <span class="mt-1 inline-flex px-3 py-1 text-sm font-semibold rounded-full
                    @if($user->role === 'super_admin') bg-purple-100 text-purple-800
                    @elseif($user->role === 'admin') bg-blue-100 text-blue-800
                    @else bg-green-100 text-green-800
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                </span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Status</label>
                <span class="mt-1 inline-flex px-3 py-1 text-sm font-semibold rounded-full
                    @if($user->is_active) bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Terdaftar Sejak</label>
                <p class="mt-1 text-gray-900">{{ $user->created_at->format('d M Y, H:i') }}</p>
            </div>
            
            @if($user->role === 'admin' && $user->instansi->count() > 0)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500">Instansi yang Dikelola</label>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($user->instansi as $instansi)
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $instansi->nama }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-6 pt-6 border-t">
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Profil
            </a>
        </div>

        <!-- Reset Token Section -->
        <div class="mt-6 pt-6 border-t">
            <label class="block text-sm font-bold text-gray-900 mb-2">
                Token Reset Password 
                <span class="text-red-500">*WAJIB DICATAT DAN DIINGAT*</span>
            </label>
            <div class="bg-red-50 border-2 border-red-300 rounded-lg p-4">
                <div class="mb-3">
                    <p class="text-sm font-semibold text-red-800 mb-2">
                        ⚠️ PENTING: Token ini WAJIB Anda catat dan simpan dengan aman!
                    </p>
                    <p class="text-xs text-red-700 mb-3">
                        Token ini digunakan untuk reset password jika Anda lupa password. 
                        Tanpa token ini, Anda tidak bisa reset password sendiri. 
                        Simpan di tempat yang aman dan mudah diingat!
                    </p>
                </div>
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <code class="text-sm font-mono text-gray-900 bg-white px-4 py-3 rounded border-2 border-red-400 block break-all font-bold">
                            {{ $user->reset_token ?? 'Token belum dibuat' }}
                        </code>
                        <button 
                            type="button" 
                            onclick="copyToken()" 
                            class="mt-2 text-xs bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded"
                        >
                            Salin Token
                        </button>
                    </div>
                    <form action="{{ route('profile.generateToken') }}" method="POST" class="flex-shrink-0">
                        @csrf
                        <button 
                            type="submit" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded text-sm"
                            onclick="return confirm('⚠️ PERINGATAN: Apakah Anda yakin ingin membuat token baru?\n\nToken lama tidak akan bisa digunakan lagi untuk reset password. Pastikan Anda sudah mencatat token baru dengan baik!')"
                        >
                            Buat Token Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Ubah Password</h2>
        
        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf

            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">
                    Password Saat Ini <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        required
                        class="shadow appearance-none border rounded w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_password') border-red-500 @enderror"
                        placeholder="Masukkan password saat ini"
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('current_password')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-800"
                    >
                        <svg id="eye-current_password" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-off-current_password" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>
                </div>
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                    Password Baru <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="shadow appearance-none border rounded w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                        placeholder="Minimal 8 karakter"
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('password')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-800"
                    >
                        <svg id="eye-password" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-off-password" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">
                    Konfirmasi Password Baru <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required
                        class="shadow appearance-none border rounded w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Ulangi password baru"
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('password_confirmation')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-800"
                    >
                        <svg id="eye-password_confirmation" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-off-password_confirmation" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <button 
                type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Ubah Password
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById('eye-' + inputId);
        const eyeOff = document.getElementById('eye-off-' + inputId);
        
        if (input.type === 'password') {
            input.type = 'text';
            eye.classList.add('hidden');
            eyeOff.classList.remove('hidden');
        } else {
            input.type = 'password';
            eye.classList.remove('hidden');
            eyeOff.classList.add('hidden');
        }
    }

    function copyToken() {
        const token = '{{ $user->reset_token ?? "" }}';
        if (!token) {
            alert('Token belum tersedia');
            return;
        }
        
        navigator.clipboard.writeText(token).then(function() {
            alert('Token berhasil disalin! Pastikan Anda menyimpannya di tempat yang aman.');
        }, function() {
            // Fallback untuk browser yang tidak support clipboard API
            const textarea = document.createElement('textarea');
            textarea.value = token;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Token berhasil disalin! Pastikan Anda menyimpannya di tempat yang aman.');
        });
    }
</script>
@endpush
@endsection

