@extends('layouts.app')

@section('title', 'Edit Laporan - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Laporan</h1>
        <p class="text-gray-600 mt-2">Edit informasi laporan Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('laporan.update', $laporan) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">
                    Judul Laporan <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="judul" 
                    name="judul" 
                    value="{{ old('judul', $laporan->judul) }}"
                    required 
                    autofocus
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror"
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
                        <option value="{{ $item->id }}" {{ old('instansi_id', $laporan->instansi_id) == $item->id ? 'selected' : '' }}>
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
                    value="{{ old('lokasi', $laporan->lokasi) }}"
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lokasi') border-red-500 @enderror"
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
                >{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if($laporan->bukti_files && count($laporan->bukti_files) > 0)
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">File Bukti Saat Ini</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($laporan->bukti_files as $index => $file)
                            <div class="border rounded-lg overflow-hidden relative">
                                @if(str_ends_with($file, '.pdf'))
                                    <div class="p-4 text-center">
                                        <svg class="w-12 h-12 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-xs mt-2 text-gray-600">PDF</p>
                                    </div>
                                @else
                                    <img src="{{ asset($file) }}" alt="Bukti" class="w-full h-32 object-cover">
                                @endif
                                <label class="absolute top-2 right-2">
                                    <input type="checkbox" name="delete_files[]" value="{{ $file }}" class="rounded">
                                    <span class="text-xs text-red-600 ml-1">Hapus</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mb-6">
                <label for="bukti_files" class="block text-gray-700 text-sm font-bold mb-2">
                    Tambah File Bukti Baru
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
                    Format: JPG, PNG, PDF. Maksimal 5MB per file.
                </p>
                @error('bukti_files.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                
                <!-- Preview Container -->
                <div id="filePreview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden"></div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('laporan.show', $laporan) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Update Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    let selectedFiles = []; // Store selected files
    
    function previewFiles(input) {
        // Update selectedFiles array
        selectedFiles = Array.from(input.files);
        
        updatePreview();
    }
    
    function updatePreview() {
        const preview = document.getElementById('filePreview');
        const input = document.getElementById('bukti_files');
        preview.innerHTML = '';
        
        if (selectedFiles.length > 0) {
            preview.classList.remove('hidden');
            
            selectedFiles.forEach((file, index) => {
                const div = document.createElement('div');
                div.className = 'border rounded-lg overflow-hidden relative group';
                div.setAttribute('data-file-index', index);
                
                // Cancel button
                const cancelBtn = document.createElement('button');
                cancelBtn.type = 'button';
                cancelBtn.className = 'absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity z-10';
                cancelBtn.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                `;
                cancelBtn.onclick = () => removeFile(index);
                div.appendChild(cancelBtn);
                
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
                    const contentDiv = document.createElement('div');
                    contentDiv.className = 'p-4 text-center';
                    contentDiv.innerHTML = `
                        <svg class="w-12 h-12 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs mt-2 text-gray-600 truncate">${file.name}</p>
                    `;
                    div.appendChild(contentDiv);
                } else {
                    const contentDiv = document.createElement('div');
                    contentDiv.className = 'p-4 text-center';
                    contentDiv.innerHTML = `
                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs mt-2 text-gray-600 truncate">${file.name}</p>
                    `;
                    div.appendChild(contentDiv);
                }
                
                preview.appendChild(div);
            });
        } else {
            preview.classList.add('hidden');
        }
    }
    
    function removeFile(index) {
        // Remove file from selectedFiles array
        selectedFiles.splice(index, 1);
        
        // Update file input using DataTransfer
        const input = document.getElementById('bukti_files');
        const dataTransfer = new DataTransfer();
        
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        
        input.files = dataTransfer.files;
        
        // Update preview
        updatePreview();
    }
</script>
@endpush
@endsection

