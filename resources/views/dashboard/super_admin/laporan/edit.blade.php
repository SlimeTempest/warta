@extends('layouts.app')

@section('title', 'Edit Laporan - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Laporan</h1>
        <p class="text-gray-600 mt-2">Edit informasi laporan (Super Admin dapat mengubah semua field termasuk status)</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('super-admin.laporan.update', $laporan) }}" enctype="multipart/form-data">
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
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select 
                    id="status" 
                    name="status" 
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror"
                >
                    <option value="terkirim" {{ old('status', $laporan->status) == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                    <option value="diverifikasi" {{ old('status', $laporan->status) == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                    <option value="diproses" {{ old('status', $laporan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ old('status', $laporan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ old('status', $laporan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">
                    Super Admin dapat mengubah status laporan ke status apapun.
                </p>
                @error('status')
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
                <a href="{{ route('super-admin.laporan.show', $laporan) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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

