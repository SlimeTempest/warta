@extends('layouts.app')

@section('title', 'Dashboard Admin - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Laporan Masuk</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $laporanMasuk }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Dalam Proses</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $dalamProses }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Selesai</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $selesai }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Ditolak</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $ditolak }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-900">Laporan Terbaru</h2>
            <a href="{{ route('admin.laporan.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                Lihat Semua →
            </a>
        </div>
        <div class="p-6">
            @forelse($laporanTerbaru as $item)
                <div class="border-b last:border-b-0 py-4 hover:bg-gray-50">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <a href="{{ route('admin.laporan.show', $item) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                {{ $item->judul }}
                            </a>
                            <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                <span>Pelapor: {{ $item->user->name }}</span>
                                <span>•</span>
                                <span>Instansi: {{ $item->instansi->nama }}</span>
                                <span>•</span>
                                <span>{{ $item->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($item->status === 'terkirim') bg-blue-100 text-blue-800
                                @elseif($item->status === 'diverifikasi') bg-yellow-100 text-yellow-800
                                @elseif($item->status === 'diproses') bg-purple-100 text-purple-800
                                @elseif($item->status === 'selesai') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-center py-8">Belum ada laporan</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

