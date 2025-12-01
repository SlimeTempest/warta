<aside class="kaira-sidebar w-64 bg-white" style="border-right: 1px solid #e9ecef; min-height: 100vh; position: sticky; top: 0; height: 100vh; overflow-y: auto;">
    <div class="p-6" style="border-bottom: 1px solid #e9ecef;">
        <h2 style="font-family: 'Marcellus', serif; font-size: 24px; color: #212529; margin: 0; letter-spacing: 1px;">Warta.id</h2>
        <p style="font-family: 'Jost', sans-serif; font-size: 12px; color: #8f8f8f; margin-top: 5px; text-transform: uppercase; letter-spacing: 0.5px;">Sistem Pelaporan</p>
    </div>
    <nav class="p-4">
        <ul style="list-style: none; padding: 0; margin: 0;">
            @php
                $currentRole = auth()->user()->role;
            @endphp

            @if($currentRole === 'super_admin')
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('dashboard.super_admin') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('dashboard.super_admin') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('dashboard.super_admin') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('instansi.index') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('instansi.*') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('instansi.*') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span>Kelola Instansi</span>
                    </a>
                </li>
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('admin-instansi.index') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('admin-instansi.*') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('admin-instansi.*') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Admin-Instansi</span>
                    </a>
                </li>
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('users.index') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('users.*') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Kelola User</span>
                    </a>
                </li>
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('super-admin.laporan.index') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('super-admin.laporan.*') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('super-admin.laporan.*') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Semua Laporan</span>
                    </a>
                </li>
            @elseif($currentRole === 'admin')
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('dashboard.admin') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('dashboard.admin') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('admin.laporan.index') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('admin.laporan.*') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Laporan Masuk</span>
                    </a>
                </li>
            @else
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('dashboard.user') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('dashboard.user') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('dashboard.user') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('laporan.create') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('laporan.create') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('laporan.create') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Buat Laporan</span>
                    </a>
                </li>
                <li style="margin-bottom: 5px;">
                    <a href="{{ route('laporan.index') }}" 
                       class="kaira-sidebar-link {{ request()->routeIs('laporan.*') && !request()->routeIs('laporan.create') ? 'active' : '' }}"
                       style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('laporan.*') && !request()->routeIs('laporan.create') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Laporan Saya</span>
                    </a>
                </li>
            @endif
            
            <!-- Profile Link for All Roles -->
            <li style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e9ecef;">
                <a href="{{ route('profile.show') }}" 
                   class="kaira-sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                   style="font-family: 'Jost', sans-serif; font-weight: 400; color: #8f8f8f; padding: 12px 20px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; {{ request()->routeIs('profile.*') ? 'background-color: #f8f9fa; color: #212529; border-left-color: #0d6efd; font-weight: 500;' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Profil Saya</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

