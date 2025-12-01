@extends('layouts.app')

@section('title', 'Edit Laporan - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div style="margin-bottom: 50px;">
        <h1 class="kaira-section-heading" style="font-family: 'Marcellus', serif; font-size: 42px; color: #212529; margin-bottom: 10px; letter-spacing: 1px;">Edit Laporan</h1>
        <p style="font-family: 'Jost', sans-serif; color: #8f8f8f; font-size: 16px;">Edit informasi laporan Anda</p>
    </div>

    <div class="kaira-card" style="background: white; border: 1px solid #e9ecef; padding: 40px;">
        <form method="POST" action="{{ route('laporan.update', $laporan) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 30px;">
                <label for="judul" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Judul Laporan <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="text" 
                    id="judul" 
                    name="judul" 
                    value="{{ old('judul', $laporan->judul) }}"
                    required 
                    autofocus
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('judul') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('judul') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >
                @error('judul')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 30px;">
                <label for="instansi_id" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Tujuan Instansi <span style="color: #dc3545;">*</span>
                </label>
                <select 
                    id="instansi_id" 
                    name="instansi_id" 
                    required
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('instansi_id') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px; background-color: white;"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('instansi_id') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >
                    <option value="">Pilih Instansi</option>
                    @foreach($instansi as $item)
                        <option value="{{ $item->id }}" {{ old('instansi_id', $laporan->instansi_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
                @error('instansi_id')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 30px;">
                <label for="lokasi" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Lokasi Kejadian <span style="color: #dc3545;">*</span>
                </label>
                <input 
                    type="text" 
                    id="lokasi" 
                    name="lokasi" 
                    value="{{ old('lokasi', $laporan->lokasi) }}"
                    required
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('lokasi') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px;"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('lokasi') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >
                @error('lokasi')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 30px;">
                <label for="deskripsi" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Deskripsi Kejadian <span style="color: #dc3545;">*</span>
                </label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    rows="5"
                    required
                    class="kaira-input"
                    style="font-family: 'Jost', sans-serif; border: 1px solid {{ $errors->has('deskripsi') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 12px 15px; transition: all 0.3s ease; font-size: 14px; resize: none;"
                    onfocus="this.style.borderColor='#212529'; this.style.boxShadow='0 0 0 3px rgba(13, 110, 253, 0.1)'"
                    onblur="this.style.borderColor='{{ $errors->has('deskripsi') ? '#dc3545' : '#e9ecef' }}'; this.style.boxShadow='none'"
                >{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            @if($laporan->bukti_files && count($laporan->bukti_files) > 0)
                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px;">File Bukti Saat Ini</label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px;">
                        @foreach($laporan->bukti_files as $index => $file)
                            <div style="border: 1px solid #e9ecef; overflow: hidden; position: relative; background: white;">
                                @if(str_ends_with($file, '.pdf'))
                                    <div style="padding: 20px; text-align: center;">
                                        <svg style="width: 48px; height: 48px; margin: 0 auto; color: #dc3545;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <p style="font-family: 'Jost', sans-serif; font-size: 11px; margin-top: 8px; color: #8f8f8f;">PDF</p>
                                    </div>
                                @else
                                    <img src="{{ asset($file) }}" alt="Bukti" style="width: 100%; height: 120px; object-fit: cover;">
                                @endif
                                <label style="position: absolute; top: 8px; right: 8px; background: rgba(255, 255, 255, 0.9); padding: 5px 10px; display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                    <input type="checkbox" name="delete_files[]" value="{{ $file }}" style="cursor: pointer;">
                                    <span style="font-family: 'Jost', sans-serif; font-size: 11px; color: #dc3545; font-weight: 500;">Hapus</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div style="margin-bottom: 30px;">
                <label for="bukti_files" style="display: block; font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Tambah File Bukti Baru
                </label>
                <div style="position: relative;">
                    <input 
                        type="file" 
                        id="bukti_files" 
                        name="bukti_files[]" 
                        multiple
                        accept="image/*,.pdf"
                        style="font-family: 'Jost', sans-serif; border: 1px dashed {{ $errors->has('bukti_files.*') ? '#dc3545' : '#e9ecef' }}; width: 100%; padding: 40px 15px; transition: all 0.3s ease; font-size: 14px; cursor: pointer; background-color: #f8f9fa;"
                        onchange="previewFiles(this)"
                        onmouseover="this.style.borderColor='#0d6efd'; this.style.backgroundColor='#e7f3ff'"
                        onmouseout="this.style.borderColor='{{ $errors->has('bukti_files.*') ? '#dc3545' : '#e9ecef' }}'; this.style.backgroundColor='#f8f9fa'"
                    >
                </div>
                <p style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f; margin-top: 10px;">
                    Format: JPG, PNG, PDF. Maksimal 5MB per file.
                </p>
                @error('bukti_files.*')
                    <p style="font-family: 'Jost', sans-serif; color: #dc3545; font-size: 12px; margin-top: 8px;">{{ $message }}</p>
                @enderror
                
                <!-- Preview Container -->
                <div id="filePreview" style="margin-top: 20px; display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px;" class="hidden"></div>
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; gap: 20px; padding-top: 30px; border-top: 1px solid #e9ecef;">
                <a href="{{ route('laporan.show', $laporan) }}" class="kaira-btn" style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: white; color: #212529; border: 1px solid #e9ecef; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; font-size: 14px;" onmouseover="this.style.borderColor='#212529'; this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.borderColor='#e9ecef'; this.style.backgroundColor='white'">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="kaira-btn kaira-btn-primary"
                    style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 12px 30px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease; font-size: 14px; display: inline-flex; align-items: center; gap: 10px;"
                    onmouseover="this.style.backgroundColor='#0d6efd'; this.style.borderColor='#0d6efd'"
                    onmouseout="this.style.backgroundColor='#212529'; this.style.borderColor='#212529'"
                >
                    <span>Update Laporan</span>
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
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
                div.style.cssText = 'border: 1px solid #e9ecef; overflow: hidden; position: relative; background: white; transition: all 0.3s ease;';
                div.setAttribute('data-file-index', index);
                div.onmouseover = function() { this.style.borderColor = '#0d6efd'; this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.05)'; };
                div.onmouseout = function() { this.style.borderColor = '#e9ecef'; this.style.boxShadow = 'none'; };
                
                // Cancel button
                const cancelBtn = document.createElement('button');
                cancelBtn.type = 'button';
                cancelBtn.style.cssText = 'position: absolute; top: 8px; right: 8px; background-color: #dc3545; color: white; border: none; padding: 5px; cursor: pointer; z-index: 10; opacity: 0; transition: opacity 0.3s ease;';
                cancelBtn.onmouseover = function() { this.style.opacity = '1'; };
                cancelBtn.onmouseout = function() { this.style.opacity = '0'; };
                cancelBtn.innerHTML = `
                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        img.style.cssText = 'width: 100%; height: 120px; object-fit: cover;';
                        div.appendChild(img);
                        
                        const nameDiv = document.createElement('div');
                        nameDiv.style.cssText = 'padding: 10px; background-color: #f8f9fa; font-family: Jost, sans-serif; font-size: 11px; color: #8f8f8f; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;';
                        nameDiv.textContent = file.name;
                        div.appendChild(nameDiv);
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    const contentDiv = document.createElement('div');
                    contentDiv.style.cssText = 'padding: 20px; text-align: center;';
                    contentDiv.innerHTML = `
                        <svg style="width: 48px; height: 48px; margin: 0 auto; color: #dc3545;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <p style="font-family: Jost, sans-serif; font-size: 11px; margin-top: 8px; color: #8f8f8f; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</p>
                    `;
                    div.appendChild(contentDiv);
                } else {
                    const contentDiv = document.createElement('div');
                    contentDiv.style.cssText = 'padding: 20px; text-align: center;';
                    contentDiv.innerHTML = `
                        <svg style="width: 48px; height: 48px; margin: 0 auto; color: #8f8f8f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <p style="font-family: Jost, sans-serif; font-size: 11px; margin-top: 8px; color: #8f8f8f; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</p>
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

