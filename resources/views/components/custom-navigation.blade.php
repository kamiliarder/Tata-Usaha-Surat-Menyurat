<!-- Custom Navigation Bar -->
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left side - Logo and Navigation -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Telkom Schools Logo" class="w-auto h-10">
                </div>

                <!-- Navigation Links -->
                <nav class="flex space-x-6">
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-red-600' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('dashboard') ? 'border-bottom: 2px solid #dc2626;' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.pesan.index') }}"
                       class="px-3 py-2 font-medium transition-all duration-200 {{ request()->routeIs('admin.pesan.*') ? 'text-red-600' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('admin.pesan.*') ? 'border-bottom: 2px solid #dc2626;' : '' }}">
                        Surat
                    </a>
                    <a href="#"
                       class="px-3 py-2 text-gray-600 transition-all duration-200 hover:text-gray-900 hover:bg-gray-50">
                        Akun Guru
                    </a>
                </nav>
            </div>

            <!-- Right side - User Menu -->
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center p-2 space-x-2 text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="userDropdown" class="absolute right-0 z-50 hidden w-48 mt-2 bg-white border border-gray-200 rounded-md shadow-lg">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-50">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Navigation JavaScript -->
<script>
    // Dropdown functionality
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const button = event.target.closest('button[onclick="toggleDropdown()"]');

        if (!button && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
