@extends('dashboard.admin.index')

@section('page-title', 'Manajemen Sertifikat')

@section('content')
    <div class="p-4 max-w-6xl mx-auto space-y-6">
        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Tambah Sertifikat --}}
        <form action="{{ route('admin.sertif.create') }}" method="POST" class="bg-white p-4 rounded-xl shadow-md space-y-4">
            @csrf
            <div class="flex flex-col md:flex-row gap-3">
                <input type="text" name="title" placeholder="Tambahkan Platform Sertifikat"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-all">Tambah</button>
            </div>
        </form>

        {{-- Daftar Sertifikat --}}
        @foreach ($certificates as $cert)
            <div class="bg-white p-6 rounded-xl shadow space-y-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2">
                    {{-- Form Update Judul Sertifikat --}}
                    <form action="{{ route('admin.sertif.update', $cert->id) }}" method="POST"
                        class="flex flex-wrap gap-2 items-center">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $cert->title }}"
                            class="text-lg font-semibold border border-gray-300 px-3 py-1 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <button type="submit"
                            class="text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md">
                            Simpan
                        </button>
                    </form>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('admin.sertif.delete', $cert->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-sm">Hapus Sertifikat</button>
                    </form>
                </div>

                {{-- Form Tambah Detail --}}
                <form action="{{ route('admin.sertif.detail.create', $cert->id) }}" method="POST"
                    enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 mt-3">
                    @csrf
                    <input type="text" name="subtitle" placeholder="Judul Sertifikat"
                        class="border border-gray-300 p-2 rounded-lg" required>
                    <input type="text" name="description" placeholder="Deskripsi"
                        class="border border-gray-300 p-2 rounded-lg">
                    <input type="url" name="link" placeholder="Link Sertifikat"
                        class="border border-gray-300 p-2 rounded-lg">
                    <input type="file" name="image" accept="image/*" class="border border-gray-300 p-2 rounded-lg">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg w-full md:w-auto transition-all">
                        Tambah Detail
                    </button>
                </form>

                {{-- List Detail Sertifikat --}}
                <div class="grid gap-4 mt-4">
                    @foreach ($cert->details as $detail)
                        <div class="border border-gray-200 p-4 rounded-lg bg-gray-50 space-y-4">
                            {{-- Informasi Detail --}}
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <p class="font-semibold text-lg">{{ $detail->subtitle }}</p>

                                    {{-- Hapus Detail --}}
                                    <form action="{{ route('admin.sertif.detail.delete', $detail->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus detail ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="mt-0 inline-flex items-center gap-1 text-red-600 hover:text-red-800 border border-red-600 hover:border-red-800 px-3 py-1 rounded-md text-sm font-semibold transition-colors duration-200">
                                            Hapus Detail
                                        </button>
                                    </form>
                                </div>
                                @if ($detail->description)
                                    <p class="text-sm text-gray-600">{{ $detail->description }}</p>
                                @endif
                                @if ($detail->link)
                                    <a href="{{ $detail->link }}" target="_blank"
                                        class="inline-block text-sm text-blue-600 hover:underline">
                                        🔗 Lihat Sertifikat
                                    </a>
                                @endif

                                @if ($detail->image)
                                    <div class="relative group w-full md:w-64">
                                        <img src="{{ asset('storage/' . $detail->image) }}" alt="Certificate Image"
                                            class="w-full h-auto rounded-lg shadow-md">

                                        <form action="{{ route('admin.sertif.detail.image.delete', $detail->id) }}"
                                            method="POST" class="absolute top-2 right-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus gambar ini?')"
                                                class="bg-red-500 text-white rounded-full p-1 opacity-80 hover:opacity-100 transition">
                                                <i data-feather="x" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            {{-- Form Update --}}
                            <form action="{{ route('admin.sertif.detail.update', $detail->id) }}" method="POST"
                                enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                @csrf @method('PUT')
                                <input type="text" name="subtitle" value="{{ $detail->subtitle }}"
                                    class="border border-gray-300 p-2 rounded-lg" placeholder="Judul" required>
                                <textarea name="description" rows="3" class="border border-gray-300 p-2 rounded-lg resize-y"
                                    placeholder="Deskripsi">{{ $detail->description }}
                                </textarea>
                                <input type="url" name="link" value="{{ $detail->link }}"
                                    class="border border-gray-300 p-2 rounded-lg" placeholder="Tautan">
                                <input type="file" name="image" accept="image/*"
                                    class="border border-gray-300 p-2 rounded-lg">
                                <div class="col-span-full flex justify-end">
                                    <button type="submit"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
