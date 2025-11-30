@extends('layouts.app')

@section('title', 'Detail Laporan - Warta.id')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Detail Laporan</h1>
        <p class="text-gray-600 mt-2">Informasi lengkap laporan</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-500">Judul</label>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $laporan->judul }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Status</label>
                <span class="mt-1 inline-flex px-3 py-1 text-sm font-semibold rounded-full
                    @if($laporan->status === 'terkirim') bg-blue-100 text-blue-800
                    @elseif($laporan->status === 'diverifikasi') bg-yellow-100 text-yellow-800
                    @elseif($laporan->status === 'diproses') bg-purple-100 text-purple-800
                    @elseif($laporan->status === 'selesai') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($laporan->status) }}
                </span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Pelapor</label>
                <p class="mt-1 text-gray-900">{{ $laporan->user->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Instansi Tujuan</label>
                <p class="mt-1 text-gray-900">{{ $laporan->instansi->nama }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Admin Penanggung Jawab</label>
                <p class="mt-1 text-gray-900">
                    @if($laporan->admin)
                        {{ $laporan->admin->name }}
                        @if($laporan->admin_id === auth()->id())
                            <span class="text-green-600 text-xs">(Anda)</span>
                        @endif
                    @else
                        <span class="text-gray-400">Belum diambil</span>
                    @endif
                </p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Lokasi</label>
                <p class="mt-1 text-gray-900">{{ $laporan->lokasi }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Deskripsi</label>
                <p class="mt-1 text-gray-900 whitespace-pre-wrap">{{ $laporan->deskripsi }}</p>
            </div>
        </div>

        @if($laporan->bukti_files && count($laporan->bukti_files) > 0)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-500 mb-2">Bukti Pendukung</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($laporan->bukti_files as $file)
                        <div class="border rounded-lg overflow-hidden">
                            @if(str_ends_with($file, '.pdf'))
                                <a href="{{ asset($file) }}" target="_blank" class="block p-4 text-center hover:bg-gray-50">
                                    <svg class="w-12 h-12 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-xs mt-2 text-gray-600">PDF</p>
                                </a>
                            @else
                                <a href="{{ asset($file) }}" target="_blank">
                                    <img src="{{ asset($file) }}" alt="Bukti" class="w-full h-32 object-cover hover:opacity-75">
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Form Update Status - Only show if admin has claimed this laporan and status is not final -->
        @if($laporan->admin_id === null)
            <div class="border-t pt-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-yellow-800">
                        <strong>Perhatian:</strong> Laporan ini belum diambil oleh admin. 
                        <a href="{{ route('admin.laporan.index') }}" class="underline">Kembali ke daftar</a> dan klik "Ambil Laporan" untuk menanganinya.
                    </p>
                </div>
            </div>
        @elseif($laporan->admin_id === auth()->id() && in_array($laporan->status, ['selesai', 'ditolak']))
            <div class="border-t pt-6">
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <p class="text-gray-700">
                        <strong>Status Final:</strong> Laporan ini sudah selesai atau ditolak dan tidak dapat diubah lagi.
                    </p>
                </div>
            </div>
        @elseif($laporan->admin_id === auth()->id())
            <div class="border-t pt-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Ubah Status Laporan</h2>
                <form method="POST" action="{{ route('admin.laporan.updateStatus', $laporan) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                        Status Baru <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="status" 
                        name="status" 
                        required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror"
                    >
                        <option value="terkirim" {{ old('status', $laporan->status) === 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                        <option value="diverifikasi" {{ old('status', $laporan->status) === 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                        <option value="diproses" {{ old('status', $laporan->status) === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="ditolak" {{ old('status', $laporan->status) === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="selesai" {{ old('status', $laporan->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="catatan" class="block text-gray-700 text-sm font-bold mb-2">
                        Catatan (Opsional)
                    </label>
                    <textarea 
                        id="catatan" 
                        name="catatan" 
                        rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('catatan') border-red-500 @enderror"
                        placeholder="Tambahkan catatan untuk perubahan status ini..."
                    >{{ old('catatan', $laporan->catatan_admin) }}</textarea>
                    @error('catatan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Update Status
                </button>
            </form>
        </div>
        @else
            <div class="border-t pt-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-blue-800">
                        <strong>Info:</strong> Laporan ini sudah diambil oleh <strong>{{ $laporan->admin->name }}</strong>. 
                        Anda hanya dapat melihat laporan ini, tidak dapat mengubah statusnya.
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Status History Timeline -->
    @if($laporan->statusHistory->count() > 0)
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Riwayat Status</h2>
            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                
                <div class="space-y-6">
                    @foreach($laporan->statusHistory->sortByDesc('created_at') as $index => $history)
                        <div class="relative flex items-start gap-4">
                            <!-- Timeline dot -->
                            <div class="relative z-10 flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-blue-500 border-4 border-white shadow-sm flex items-center justify-center">
                                    @if($history->status_lama !== $history->status_baru)
                                        <div class="h-2 w-2 rounded-full bg-white"></div>
                                    @else
                                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0 pb-6">
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    @if($history->status_lama !== $history->status_baru)
                                        <p class="font-semibold text-gray-900 mb-1">
                                            {{ $history->status_lama ? ucfirst($history->status_lama) : 'Baru' }} 
                                            <span class="text-gray-400 mx-2">→</span>
                                            <span class="text-blue-600">{{ ucfirst($history->status_baru) }}</span>
                                        </p>
                                    @else
                                        <p class="font-semibold text-gray-900 mb-1">
                                            <span class="text-gray-600">Catatan diperbarui</span>
                                            <span class="text-xs font-normal text-gray-400 ml-2">(Status: {{ ucfirst($history->status_baru) }})</span>
                                        </p>
                                    @endif
                                    
                                    @if($history->catatan)
                                        <p class="text-sm text-gray-700 mt-2 bg-white rounded p-2 border-l-2 border-blue-500">{{ $history->catatan }}</p>
                                    @endif
                                    
                                    <div class="flex items-center gap-2 mt-3 text-xs text-gray-500">
                                        <span>{{ $history->changedBy->name }}</span>
                                        <span>•</span>
                                        <span>{{ $history->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

