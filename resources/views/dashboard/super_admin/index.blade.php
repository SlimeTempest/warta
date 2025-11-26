@extends('layouts.app')

@section('title', 'Dashboard Super Admin - Warta.id')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Super Admin</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Instansi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalInstansi }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Admin</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalAdmin }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Laporan</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalLaporan }}</p>
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
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pending }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-900">Instansi Terbaru</h2>
            </div>
            <div class="p-6">
                @if($instansiTerbaru->count() > 0)
                    <div class="space-y-4">
                        @foreach($instansiTerbaru as $instansi)
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 mb-1">{{ $instansi->nama }}</h3>
                                        @if($instansi->alamat)
                                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit($instansi->alamat, 80) }}</p>
                                        @endif
                                        <div class="flex items-center gap-4 text-sm text-gray-500">
                                            <span>{{ $instansi->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        @php
                                            $statusColors = [
                                                'active' => 'bg-green-100 text-green-800',
                                                'suspended' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusLabels = [
                                                'active' => 'Aktif',
                                                'suspended' => 'Ditangguhkan',
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$instansi->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusLabels[$instansi->status] ?? ucfirst($instansi->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('instansi.edit', $instansi) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Kelola →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 text-center py-8">Belum ada instansi</p>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-900">Laporan Terbaru</h2>
            </div>
            <div class="p-6">
                @if($laporanTerbaru->count() > 0)
                    <div class="space-y-4">
                        @foreach($laporanTerbaru as $laporan)
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 mb-1">{{ $laporan->judul }}</h3>
                                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($laporan->deskripsi, 100) }}</p>
                                        <div class="flex items-center gap-4 text-sm text-gray-500">
                                            <span>Oleh: {{ $laporan->user->name }}</span>
                                            <span>•</span>
                                            <span>Instansi: {{ $laporan->instansi->nama }}</span>
                                            <span>•</span>
                                            <span>{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        @php
                                            $statusColors = [
                                                'terkirim' => 'bg-blue-100 text-blue-800',
                                                'diverifikasi' => 'bg-yellow-100 text-yellow-800',
                                                'diproses' => 'bg-orange-100 text-orange-800',
                                                'selesai' => 'bg-green-100 text-green-800',
                                                'ditolak' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusLabels = [
                                                'terkirim' => 'Terkirim',
                                                'diverifikasi' => 'Diverifikasi',
                                                'diproses' => 'Diproses',
                                                'selesai' => 'Selesai',
                                                'ditolak' => 'Ditolak',
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$laporan->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusLabels[$laporan->status] ?? ucfirst($laporan->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 text-center py-8">Belum ada laporan</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

