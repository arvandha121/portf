<header class="h-16 bg-white shadow flex items-center justify-between px-6">
    <h1 class="text-lg font-bold md:hidden">Dashboard</h1>
    <div class="hidden md:flex items-center space-x-4 ml-auto relative">
        <button id="dropdownButton"
            class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-blue-600">
            <span>{{ $user->name }}</span>
            <img src="https://ui-avatars.com/api/?name=Nauvan" alt="avatar"
                class="h-9 w-9 rounded-full border border-gray-300 shadow-sm" />
        </button>
        <div id="dropdownMenu"
            class="hidden absolute right-0 top-12 w-56 bg-white border border-gray-200 rounded-md shadow-lg z-50">
            <a href="{{ route('admin.profile') }}"
                class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-100">
                <i data-feather="user" class="w-4 h-4"></i><span>Profile</span>
            </a>
            <a href="{{ route('logout') }}"
                class="flex items-center gap-3 px-5 py-3 text-sm text-red-600 hover:bg-red-50">
                <i data-feather="log-out" class="w-4 h-4"></i><span>Logout</span>
            </a>
        </div>
    </div>
</header>
