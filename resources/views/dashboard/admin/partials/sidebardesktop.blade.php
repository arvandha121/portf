<aside class="sidebar hidden md:flex flex-col shadow bg-white text-gray-800">
    <div class="py-6 px-6 border-b border-gray-200 flex items-center space-x-3">
        <img src="{{ asset('images/logo-icon.png') }}" class="w-8 h-8 logo-icon" alt="Logo">
        <span class="text-xl font-bold logo-text tracking-wide">MY-PFOLIO</span>
    </div>
    <nav class="flex-1 px-3 py-5 space-y-1">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-item {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 text-blue-600' : '' }}">
            <i data-feather="home"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>

        <a href="{{ route('admin.about') }}"
            class="nav-item {{ request()->routeIs('admin.about') ? 'bg-gray-200 text-blue-600' : '' }}">
            <i data-feather="user"></i>
            <span class="sidebar-text">About</span>
        </a>

        <a href="{{ route('admin.skill') }}"
            class="nav-item {{ request()->routeIs('admin.skill') ? 'bg-gray-200 text-blue-600' : '' }}">
            <i data-feather="file-text"></i>
            <span class="sidebar-text">Skills</span>
        </a>

        <a href="{{ route('admin.sertif') }}"
            class="nav-item {{ request()->routeIs('admin.sertif') ? 'bg-gray-200 text-blue-600' : '' }}">
            <i data-feather="briefcase"></i>
            <span class="sidebar-text">Certification</span>
        </a>

        <a href="{{ route('admin.portf') }}"
            class="nav-item {{ request()->routeIs('admin.portf') ? 'bg-gray-200 text-blue-600' : '' }}">
            <i data-feather="image"></i>
            <span class="sidebar-text">Portfolio</span>
        </a>

        <a href="{{ route('admin.medsos') }}"
            class="nav-item {{ request()->routeIs('admin.medsos') ? 'bg-gray-200 text-blue-600' : '' }}">
            <i data-feather="target"></i>
            <span class="sidebar-text">Medsos</span>
        </a>

        <a href="{{ route('admin.settings') }}"
            class="nav-item {{ request()->routeIs('admin.settings') ? 'bg-gray-200 text-blue-600' : '' }}">
            <i data-feather="settings"></i>
            <span class="sidebar-text">Settings</span>
        </a>
    </nav>
</aside>
