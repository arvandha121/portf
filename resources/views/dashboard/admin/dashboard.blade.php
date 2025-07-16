@extends('dashboard.admin.index')

@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
            <div class="text-sm text-gray-500">ADMIN</div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-400">
            <div class="text-sm text-gray-500">SKILL</div>
            <div class="text-2xl font-bold text-gray-800">#</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-400">
            <div class="text-sm text-gray-500">CERTIFICATION</div>
            <div class="text-2xl font-bold text-gray-800">#</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-400">
            <div class="text-sm text-gray-500">PORTOFOLIO</div>
            <div class="text-2xl font-bold text-gray-800">#</div>
        </div>
    </div>
@endsection
