<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Warta.id')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white" style="font-family: 'Jost', sans-serif;">
    <div class="min-h-screen flex flex-col">
        @auth
            @include('partials.header')
        @endauth
        
        <div class="flex flex-1">
            @auth
                @hasSection('sidebar')
                    @yield('sidebar')
                @else
                    @include('partials.sidebar')
                @endif
            @endauth
            
            <main class="flex-1 p-6 lg:p-8 @auth @else mx-auto max-w-md w-full @endauth" style="background-color: #f8f9fa;">
                @if(session('success'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-400 text-green-700 px-4 py-3" style="border-left-width: 4px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3" style="border-left-width: 4px;">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3" style="border-left-width: 4px;">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
        
        @auth
            @include('partials.footer')
        @endauth
    </div>
    @stack('scripts')
</body>
</html>

