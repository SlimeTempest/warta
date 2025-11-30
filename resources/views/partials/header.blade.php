<header class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{ route('dashboard.' . auth()->user()->role) }}" class="text-xl font-bold text-gray-900">
                    Warta.id
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('profile.show') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">
                    {{ auth()->user()->name }}
                </a>
                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                    @if(auth()->user()->role === 'super_admin') bg-purple-100 text-purple-800
                    @elseif(auth()->user()->role === 'admin') bg-blue-100 text-blue-800
                    @else bg-green-100 text-green-800
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:shadow-outline">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

