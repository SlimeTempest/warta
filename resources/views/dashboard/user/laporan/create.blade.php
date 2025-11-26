@extends('layouts.app')

@section('title', 'Buat Laporan - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Buat Laporan Baru</h1>
        <p class="text-gray-600 mt-2">Laporkan permasalahan yang terjadi di lingkungan Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('laporan.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">
                    Judul Laporan <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="judul" 
                    name="judul" 
                    value="{{ old('judul') }}"
                    required 
                    autofocus
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror"
                    placeholder="Contoh: Jalan Rusak di RT 05"
                >
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="instansi_id" class="block text-gray-700 text-sm font-bold mb-2">
                    Tujuan Instansi <span class="text-red-500">*</span>
                </label>
                <select 
                    id="instansi_id" 
                    name="instansi_id" 
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('instansi_id') border-red-500 @enderror"
                >
                    <option value="">Pilih Instansi</option>
                    @foreach($instansi as $item)
                        <option value="{{ $item->id }}" {{ old('instansi_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
                @error('instansi_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="lokasi" class="block text-gray-700 text-sm font-bold mb-2">
                    Lokasi Kejadian <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="lokasi" 
                    name="lokasi" 
                    value="{{ old('lokasi') }}"
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lokasi') border-red-500 @enderror"
                    placeholder="Contoh: Jl. Merdeka No. 123, RT 05/RW 02"
                >
                @error('lokasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">
                    Deskripsi Kejadian <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    rows="5"
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi') border-red-500 @enderror"
                    placeholder="Jelaskan secara detail permasalahan yang terjadi..."
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="bukti_files" class="block text-gray-700 text-sm font-bold mb-2">
                    Bukti Pendukung (Foto/Dokumen)
                </label>
                <input 
                    type="file" 
                    id="bukti_files" 
                    name="bukti_files[]" 
                    multiple
                    accept="image/*,.pdf"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bukti_files.*') border-red-500 @enderror"
                    onchange="previewFiles(this)"
                >
                <p class="text-xs text-gray-500 mt-1">
                    Format: JPG, PNG, PDF. Maksimal 5MB per file. Bisa upload lebih dari 1 file.
                </p>
                @error('bukti_files.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                
                <!-- Preview Container -->
                <div id="filePreview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden"></div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('laporan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewFiles(input) {
        const preview = document.getElementById('filePreview');
        preview.innerHTML = '';
        
        if (input.files && input.files.length > 0) {
            preview.classList.remove('hidden');
            
            Array.from(input.files).forEach((file, index) => {
                const div = document.createElement('div');
                div.className = 'border rounded-lg overflow-hidden relative';
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-32 object-cover';
                        div.appendChild(img);
                        
                        const nameDiv = document.createElement('div');
                        nameDiv.className = 'p-2 bg-gray-50 text-xs text-gray-600 truncate';
                        nameDiv.textContent = file.name;
                        div.appendChild(nameDiv);
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    div.innerHTML = `
                        <div class="p-4 text-center">
                            <svg class="w-12 h-12 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-xs mt-2 text-gray-600 truncate">${file.name}</p>
                        </div>
                    `;
                } else {
                    div.innerHTML = `
                        <div class="p-4 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-xs mt-2 text-gray-600 truncate">${file.name}</p>
                        </div>
                    `;
                }
                
                preview.appendChild(div);
            });
        } else {
            preview.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection

