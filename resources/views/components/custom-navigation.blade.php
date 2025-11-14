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
                    <a href="{{ route('pesan.index') }}"
                       class="px-3 py-2 font-medium transition-all duration-200 {{ request()->routeIs('pesan.*') ? 'text-red-600' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('pesan.*') ? 'border-bottom: 2px solid #dc2626;' : '' }}">
                        Surat
                    </a>
                    @if(!Auth::user()->isGuru())
                    <a href="{{ route('akun.index') }}"
                       class="px-3 py-2 font-medium transition-all duration-200 {{ request()->routeIs('akun.*') ? 'text-red-600' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('akun.*') ? 'border-bottom: 2px solid #dc2626;' : '' }}">
                        Akun Guru
                    </a>
                    @endif
                </nav>
            </div>

            <!-- Right side - User Menu -->
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-700">{{ Auth::user()->nama }}</span>
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
                        <a onclick="openProfileModal()" class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-50">Profil</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-50">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Profile Modal -->
<div id="profileModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" onclick="closeProfileModal()"></div>

        <!-- Modal panel -->
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-3xl shadow-xl sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="flex bg-white">
                <!-- Left Side - Profile Info -->
                <div class="w-1/2 p-12">
                    <h2 class="mb-8 text-4xl font-bold text-gray-900">Profile</h2>

                    <div class="flex items-center space-x-6">
                        <!-- Profile Photo -->
                        <div class="flex-shrink-0">
                            <div class="w-32 h-32 overflow-hidden bg-gray-200 rounded-3xl">
                                @if(Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/profile-pictures/' . Auth::user()->profile_picture) }}" alt="Profile Photo" class="object-cover w-full h-full">
                                @else
                                    <div class="flex items-center justify-center w-full h-full bg-gray-300">
                                        <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Name and Role -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->nama }}</h3>
                            <p class="mt-1 text-lg text-gray-600">{{ ucfirst(Auth::user()->role) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Details -->
                <div class="w-1/2 p-12 bg-gray-50">
                    <div class="space-y-6">
                        <!-- Nama Lengkap & NIP -->
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <label class="block mb-2 text-sm font-semibold text-gray-900">Nama Lengkap</label>
                                <div class="px-4 py-3 bg-white rounded-lg">
                                    <p class="text-sm text-gray-700">{{ Auth::user()->nama }}</p>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label class="block mb-2 text-sm font-semibold text-gray-900">NIP</label>
                                <div class="px-4 py-3 bg-white rounded-lg">
                                    <p class="text-sm text-gray-700">{{ Auth::user()->nip ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email & Role -->
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <label class="block mb-2 text-sm font-semibold text-gray-900">Email</label>
                                <div class="px-4 py-3 bg-white rounded-lg">
                                    <p class="text-sm text-gray-700">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label class="block mb-2 text-sm font-semibold text-gray-900">Role</label>
                                <div class="px-4 py-3 bg-white rounded-lg">
                                    <p class="text-sm text-gray-700">{{ ucfirst(Auth::user()->role) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Close Button -->
            <div class="absolute top-4 right-4">
                <button type="button" onclick="closeProfileModal()" class="p-2 text-gray-400 transition-colors rounded-full hover:text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

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

    // Profile modal functions
    function openProfileModal() {
        document.getElementById('profileModal').classList.remove('hidden');
        document.getElementById('userDropdown').classList.add('hidden');
    }

    function closeProfileModal() {
        document.getElementById('profileModal').classList.add('hidden');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeProfileModal();
        }
    });
</script>
