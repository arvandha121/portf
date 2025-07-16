@extends('dashboard.admin.index')

@section('page-title', 'Medsos')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">🎯 Sosial Media</h2>

            {{-- Form Tambah --}}
            <form action="{{ route('admin.medsos.create') }}" method="POST" class="space-y-4 mb-10">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="text" name="platform" placeholder="Platform (e.g., Instagram)"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                        required>
                    <input type="text" name="username" placeholder="Username"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-cyan-500 focus:outline-none">
                    <input type="url" name="url" placeholder="https://link.to/your-profile"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                        required>
                </div>
                <div class="text-right">
                    <button type="submit"
                        class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition">
                        + Tambah Sosmed
                    </button>
                </div>
            </form>

            {{-- Daftar Sosmed --}}
            <div class="space-y-6">
                @forelse ($sosmeds as $sosmed)
                    <div
                        class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-5 bg-gray-50 rounded-xl shadow border border-gray-200">
                        {{-- Form Edit --}}
                        <form action="{{ route('admin.medsos.update', $sosmed->id) }}" method="POST"
                            class="flex flex-col md:flex-row flex-1 gap-4 items-start md:items-center">
                            @csrf
                            @method('PUT')
                            <input type="text" name="platform" value="{{ $sosmed->platform }}"
                                class="w-full md:w-1/4 px-4 py-2.5 rounded-md border border-gray-300 focus:ring-2 focus:ring-yellow-400">
                            <input type="text" name="username" value="{{ $sosmed->username }}"
                                class="w-full md:w-1/4 px-4 py-2.5 rounded-md border border-gray-300 focus:ring-2 focus:ring-yellow-400">
                            <input type="url" name="url" value="{{ $sosmed->url }}"
                                class="w-full md:w-1/3 px-4 py-2.5 rounded-md border border-gray-300 focus:ring-2 focus:ring-yellow-400">
                            <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded-md transition">
                                Simpan
                            </button>
                        </form>

                        {{-- Tombol Delete --}}
                        <form action="{{ route('admin.medsos.delete', $sosmed->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus sosmed ini?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-md transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada sosial media yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
