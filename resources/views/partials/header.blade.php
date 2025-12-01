<header class="kaira-nav" style="background: white; border-bottom: 1px solid #e9ecef;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center" style="min-height: 70px;">
            <div class="flex items-center">
                <a href="{{ route('dashboard.' . auth()->user()->role) }}" 
                   style="font-family: 'Marcellus', serif; font-size: 28px; color: #212529; text-decoration: none; letter-spacing: 1px;">
                    Warta.id
                </a>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="{{ route('profile.show') }}" 
                   class="kaira-nav-link"
                   style="font-family: 'Jost', sans-serif; font-weight: 500; color: #212529; text-transform: uppercase; letter-spacing: 0.5px; font-size: 14px; text-decoration: none; transition: color 0.3s ease;">
                    {{ auth()->user()->name }}
                </a>
                <span style="font-family: 'Jost', sans-serif; font-weight: 500; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 12px; 
                    @if(auth()->user()->role === 'super_admin') background-color: #f3e8ff; color: #7c3aed;
                    @elseif(auth()->user()->role === 'admin') background-color: #dbeafe; color: #2563eb;
                    @else background-color: #dcfce7; color: #16a34a;
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="kaira-btn kaira-btn-primary"
                            style="font-family: 'Jost', sans-serif; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; padding: 10px 25px; background-color: #212529; color: white; border: 1px solid #212529; cursor: pointer; transition: all 0.3s ease;">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

