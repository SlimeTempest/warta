@extends('layouts.app')

@section('title', 'Edit Profil - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Profil</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi akun Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $user->name) }}"
                    required 
                    autofocus
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}"
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('profile.show') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

