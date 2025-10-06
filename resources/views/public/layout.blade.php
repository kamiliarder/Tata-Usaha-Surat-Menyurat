<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Sistem Tata Usaha Surat')</title>

    <!-- Fonts -->
    <!-- Fonts - Multiple sources for better compatibility -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Primary fonts from Bunny (privacy-friendly) -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Fallback fonts from Google Fonts for better Linux support -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Head Content -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/schoolLogo.png') }}" alt="Logo" class="w-8 h-8">
                        <span class="ml-3 text-xl font-semibold text-gray-900">SMK Telkom Banjarbaru</span>
                    </a>

                    <!-- Navigation Links -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('public.pesan.create') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">
                            Kirim Surat
                        </a>
                        <a href="{{ route('login') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Login Staff
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-gray-500 text-sm">
                    <p>&copy; {{ date('Y') }} Sistem Tata Usaha Surat Menyurat Sekolah. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
