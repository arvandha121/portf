@extends('dashboard.admin.index')

@section('page-title', 'Settings')

@section('content')
    <div class="mx-auto px-4 sm:px-6 mb-7">
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Pengaturan Environment</h2>

            @if (session('success'))
                <div class="bg-green-100 text-green-800 border border-green-300 rounded-md px-4 py-3 mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('settings.updateAppSettings') }}" method="POST" class="space-y-6 mb-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">APP_NAME</label>
                    <input type="text" name="app_name" value="{{ config('app.name') }}"
                        class="mt-1 block w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">APP_DEBUG</label>
                    <select name="app_debug" class="mt-1 block w-full border rounded px-3 py-2">
                        <option value="true" {{ config('app.debug') ? 'selected' : '' }}>true</option>
                        <option value="false" {{ !config('app.debug') ? 'selected' : '' }}>false</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan Pengaturan
                </button>
            </form>

            <form action="{{ route('admin.update.env') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf

                {{-- Loop semua key email config --}}
                @foreach ($mail as $key => $value)
                    <div>
                        <label for="{{ $key }}" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ $key }}
                        </label>
                        <input type="text" name="{{ $key }}" id="{{ $key }}"
                            value="{{ $value }}"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 text-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500">
                    </div>
                @endforeach

                <div class="md:col-span-2">
                    <button type="submit"
                        class="w-full md:w-auto bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-6 py-3 rounded-md shadow-md transition">
                        💾 Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
