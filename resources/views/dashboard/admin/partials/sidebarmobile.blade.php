<!-- Mobile Toggle Button -->
<button id="openMobileSidebar"
    class="fixed bottom-5 right-5 z-50 bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full shadow-lg md:hidden">
    <i data-feather="menu"></i>
</button>

<!-- Floating Mobile Sidebar -->
<div id="mobileSidebar"
    class="fixed bottom-0 left-0 w-full bg-white rounded-t-2xl shadow-2xl z-50 transform translate-y-full transition-transform duration-300 md:hidden">
    <div class="p-6">
        <div class="grid grid-cols-3 gap-6 text-center">
            <a href="{{ route('admin.dashboard') }}"
                class="flex flex-col items-center {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-semibold' : 'text-gray-700' }} hover:text-blue-600">
                <i data-feather="home" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">Dashboard</span>
            </a>
            <a href="{{ route('admin.about') }}"
                class="flex flex-col items-center {{ request()->routeIs('admin.about') ? 'text-blue-600 font-semibold' : 'text-gray-700' }} hover:text-blue-600">
                <i data-feather="user" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">About</span>
            </a>
            <a href="{{ route('admin.skill') }}"
                class="flex flex-col items-center {{ request()->routeIs('admin.skill') ? 'text-blue-600 font-semibold' : 'text-gray-700' }} hover:text-blue-600">
                <i data-feather="file-text" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">Skills</span>
            </a>
            <a href="{{ route('admin.sertif') }}"
                class="flex flex-col items-center {{ request()->routeIs('admin.sertif') ? 'text-blue-600 font-semibold' : 'text-gray-700' }} hover:text-blue-600">
                <i data-feather="briefcase" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">Certification</span>
            </a>
            <a href="{{ route('admin.portf') }}"
                class="flex flex-col items-center {{ request()->routeIs('admin.portf') ? 'text-blue-600 font-semibold' : 'text-gray-700' }} hover:text-blue-600">
                <i data-feather="image" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">Portfolio</span>
            </a>
            <a href="{{ route('admin.medsos') }}"
                class="flex flex-col items-center {{ request()->routeIs('admin.medsos') ? 'text-blue-600 font-semibold' : 'text-gray-700' }} hover:text-blue-600">
                <i data-feather="target" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">Medsos</span>
            </a>
            <a href="{{ route('admin.settings') }}"
                class="flex flex-col items-center {{ request()->routeIs('admin.settings') ? 'text-blue-600 font-semibold' : 'text-gray-700' }} hover:text-blue-600">
                <i data-feather="settings" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">Settings</span>
            </a>
            <a href="{{ route('admin.profile') }}"
                class="flex flex-col items-center {{ request()->routeIs('admin.profile') ? 'text-blue-600 font-semibold' : 'text-gray-700' }} hover:text-blue-600">
                <i data-feather="user" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">Profile</span>
            </a>
            <a href="{{ route('logout') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-600">
                <i data-feather="log-out" class="w-6 h-6 mb-1"></i>
                <span class="text-sm">Logout</span>
            </a>
        </div>

        <!-- Close button -->
        <div class="text-right mt-6">
            <button id="closeMobileSidebar" class="text-blue-400 hover:text-red-500">
                <i data-feather="x" class="w-6 h-6"></i>
            </button>
        </div>
    </div>
</div>
