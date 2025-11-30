<aside class="w-64 bg-white shadow-sm border-r min-h-screen">
    <nav class="p-4">
        <ul class="space-y-2">
            @php
                $currentRole = auth()->user()->role;
            @endphp

            @if($currentRole === 'super_admin')
                <li>
                    <a href="{{ route('dashboard.super_admin') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard.super_admin') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('instansi.index') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('instansi.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Kelola Instansi
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin-instansi.index') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin-instansi.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Kelola Admin-Instansi
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Kelola User
                    </a>
                </li>
                <li>
                    <a href="{{ route('super-admin.laporan.index') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('super-admin.laporan.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Semua Laporan
                    </a>
                </li>
            @elseif($currentRole === 'admin')
                <li>
                    <a href="{{ route('dashboard.admin') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard.admin') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.laporan.index') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.laporan.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Laporan Masuk
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('dashboard.user') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard.user') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan.create') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('laporan.create') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Buat Laporan
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan.index') }}" 
                       class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('laporan.*') && !request()->routeIs('laporan.create') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Laporan Saya
                    </a>
                </li>
            @endif
            
            <!-- Profile Link for All Roles -->
            <li class="mt-4 pt-4 border-t">
                <a href="{{ route('profile.show') }}" 
                   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                    Profil Saya
                </a>
            </li>
        </ul>
    </nav>
</aside>

