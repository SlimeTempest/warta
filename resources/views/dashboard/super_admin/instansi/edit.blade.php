@extends('layouts.app')

@section('title', 'Edit Instansi - Warta.id')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Instansi</h1>
        <p class="text-gray-600 mt-2">Edit informasi instansi</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('instansi.update', $instansi) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">
                    Nama Instansi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    value="{{ old('nama', $instansi->nama) }}"
                    required 
                    autofocus
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror"
                >
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">
                    Alamat
                </label>
                <textarea 
                    id="alamat" 
                    name="alamat" 
                    rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat') border-red-500 @enderror"
                >{{ old('alamat', $instansi->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <input type="hidden" name="status" value="{{ $instansi->status }}">

            <div class="flex items-center justify-between">
                <a href="{{ route('instansi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

