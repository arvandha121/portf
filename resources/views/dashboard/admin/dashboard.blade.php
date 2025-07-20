@extends('dashboard.admin.index')

@section('page-title', 'Dashboard')

@section('content')
    {{-- Welcome Banner --}}
    <div class="mb-8">
        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl px-6 py-5 shadow-md text-white">
            <h2 class="text-2xl md:text-3xl font-semibold">Welcome back, {{ $user->name }} 👋</h2>
            <p class="text-sm md:text-base mt-1 text-white/90">Here's what's happening with your portfolio today.</p>
        </div>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-xl shadow border-l-4 border-blue-500 p-5">
            <div class="text-xs text-gray-500 mb-1">ADMIN</div>
            <div class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</div>
        </div>
        <div class="bg-white rounded-xl shadow border-l-4 border-green-400 p-5">
            <div class="text-xs text-gray-500 mb-1">SKILLS</div>
            <div class="text-3xl font-bold text-gray-800">{{ $totalSkills }}</div>
        </div>
        <div class="bg-white rounded-xl shadow border-l-4 border-blue-400 p-5">
            <div class="text-xs text-gray-500 mb-1">CERTIFICATIONS</div>
            <div class="text-3xl font-bold text-gray-800">{{ $totalCertificates }}</div>
        </div>
        <div class="bg-white rounded-xl shadow border-l-4 border-yellow-400 p-5">
            <div class="text-xs text-gray-500 mb-1">PORTFOLIO</div>
            <div class="text-3xl font-bold text-gray-800">{{ $totalPortofolios }}</div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <a href="{{ route('admin.skill') }}"
            class="bg-white border rounded-xl p-5 shadow hover:shadow-md transition flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Manage Skills</p>
                <p class="text-lg font-semibold text-gray-800">Edit</p>
            </div>
            <i data-feather="edit" class="text-cyan-500 w-6 h-6"></i>
        </a>
        <a href="{{ route('admin.sertif') }}"
            class="bg-white border rounded-xl p-5 shadow hover:shadow-md transition flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Certificates</p>
                <p class="text-lg font-semibold text-gray-800">Upload</p>
            </div>
            <i data-feather="award" class="text-green-500 w-6 h-6"></i>
        </a>
        <a href="{{ route('admin.portf') }}"
            class="bg-white border rounded-xl p-5 shadow hover:shadow-md transition flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Portfolio</p>
                <p class="text-lg font-semibold text-gray-800">View</p>
            </div>
            <i data-feather="folder" class="text-yellow-500 w-6 h-6"></i>
        </a>
        <a href="{{ route('admin.settings') }}"
            class="bg-white border rounded-xl p-5 shadow hover:shadow-md transition flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Settings</p>
                <p class="text-lg font-semibold text-gray-800">Config</p>
            </div>
            <i data-feather="settings" class="text-gray-600 w-6 h-6"></i>
        </a>
    </div>

    {{-- Recent Activity --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activities</h3>
        @if ($activities->count())
            <ul class="space-y-4 text-sm text-gray-700">
                @foreach ($activities as $activity)
                    <li class="flex items-start">
                        <i data-feather="{{ $activity->icon ?? 'activity' }}"
                            class="text-{{ $activity->color ?? 'gray-400' }} w-5 h-5 mr-2 mt-0.5"></i>
                        <div>
                            <p class="leading-snug">
                                {{ $activity->description }}
                                <span class="ml-2 text-xs text-gray-400">—
                                    {{ $activity->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 text-sm">No recent activity.</p>
        @endif
    </div>
@endsection
{{-- 
@push('scripts')
    <script>
        feather.replace();
    </script>
@endpush --}}
