@extends('layouts.app')

@section('title', 'Laporan Saya - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Laporan Saya</h1>
            <p class="text-gray-600 mt-2">Daftar laporan yang telah Anda buat</p>
        </div>
        <a href="{{ route('laporan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Buat Laporan Baru
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instansi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($laporan as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $item->instansi->nama }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($item->lokasi, 30) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($item->status === 'terkirim') bg-blue-100 text-blue-800
                                @elseif($item->status === 'diverifikasi') bg-yellow-100 text-yellow-800
                                @elseif($item->status === 'diproses') bg-purple-100 text-purple-800
                                @elseif($item->status === 'selesai') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('laporan.show', $item) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                            @if($item->status === 'terkirim')
                                <a href="{{ route('laporan.edit', $item) }}" class="text-green-600 hover:text-green-900 mr-3">Edit</a>
                                <form action="{{ route('laporan.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada laporan. <a href="{{ route('laporan.create') }}" class="text-blue-500 hover:text-blue-700">Buat laporan pertama Anda</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($laporan->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $laporan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

