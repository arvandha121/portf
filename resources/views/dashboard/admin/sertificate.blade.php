@extends('dashboard.admin.index')

@section('page-title', 'Manajemen Sertifikat')

@section('content')
    <div class="bg-white rounded-xl shadow p-6 border border-gray-200 mb-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tambah Sertifikat</h2>

        {{-- Tambah Platform --}}
        <form action="{{ route('admin.sertif.create') }}" method="POST" class="flex flex-col sm:flex-row gap-3 sm:gap-4 mb-5">
            @csrf
            <input type="text" name="title" placeholder="Tambah Platform Sertifikat"
                class="w-full sm:flex-1 border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-300" required>
            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white rounded-md px-4 py-2">
                Tambah
            </button>
        </form>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded-md mt-5 mb-5">
            {{ session('success') }}
        </div>
    @endif

    {{-- Daftar Sertifikat --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($certificates as $cert)
            <div class="bg-white rounded-lg shadow p-5 space-y-4">
                {{-- Header: Edit judul & delete --}}
                <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                    <form action="{{ route('admin.sertif.update', $cert->id) }}" method="POST"
                        class="flex flex-col sm:flex-row gap-2 w-full">
                        @csrf @method('PUT')
                        <input type="text" name="title" value="{{ $cert->title }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                        <button type="submit"
                            class="w-full sm:w-auto bg-yellow-400 hover:bg-yellow-500 text-white rounded-md px-4 py-2">
                            Simpan
                        </button>
                    </form>
                    <form action="{{ route('admin.sertif.delete', $cert->id) }}" method="POST" class="w-full sm:w-auto">
                        @csrf @method('DELETE')
                        <button
                            class="w-full sm:w-auto text-red-600 hover:underline text-center py-2 sm:py-0">Hapus</button>
                    </form>
                </div>

                {{-- Form tambah detail --}}
                <form action="{{ route('admin.sertif.detail.create', $cert->id) }}" method="POST"
                    enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @csrf
                    <input type="text" name="subtitle" placeholder="Nama Sertifikat"
                        class="w-full border border-gray-300 rounded-md px-2 py-2" required>
                    <input type="text" name="description" placeholder="Deskripsi"
                        class="w-full border border-gray-300 rounded-md px-2 py-2">
                    <input type="url" name="link" placeholder="Link Sertifikat"
                        class="w-full border border-gray-300 rounded-md px-2 py-2">
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 rounded-md px-2 py-2">
                    <button type="submit"
                        class="sm:col-span-2 w-full bg-green-600 hover:bg-green-700 text-white rounded-md px-4 py-2 mt-2">
                        Tambah Detail
                    </button>
                </form>

                {{-- List detail --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($cert->details as $detail)
                        <div class="border border-gray-200 rounded-md p-4 space-y-3">
                            {{-- Judul + delete --}}
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                                <h4 class="font-semibold">{{ $detail->subtitle }}</h4>
                                <form action="{{ route('admin.sertif.detail.delete', $detail->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline text-sm">Hapus</button>
                                </form>
                            </div>

                            {{-- Deskripsi & link --}}
                            @if ($detail->description)
                                <p class="text-gray-600 text-sm">{{ $detail->description }}</p>
                            @endif
                            @if ($detail->link)
                                <a href="{{ $detail->link }}" target="_blank" class="text-blue-600 text-sm hover:underline">
                                    🔗 Lihat
                                </a>
                            @endif

                            {{-- Gambar --}}
                            @if ($detail->image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $detail->image) }}"
                                        class="w-full h-32 object-cover rounded-md" alt="">
                                    <form action="{{ route('admin.sertif.detail.image.delete', $detail->id) }}"
                                        method="POST" class="absolute top-2 right-2">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-500 text-white rounded-full p-1">
                                            <i data-feather="x" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif

                            {{-- Edit detail --}}
                            <form action="{{ route('admin.sertif.detail.update', $detail->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-2">
                                @csrf @method('PUT')
                                <input type="text" name="subtitle" value="{{ $detail->subtitle }}"
                                    class="w-full border border-gray-300 rounded-md px-2 py-2" required>
                                <textarea name="description" rows="2" class="w-full border border-gray-300 rounded-md px-2 py-2 resize-none">{{ $detail->description }}</textarea>
                                <input type="url" name="link" value="{{ $detail->link }}"
                                    class="w-full border border-gray-300 rounded-md px-2 py-2">
                                <input type="file" name="image" accept="image/*"
                                    class="w-full border border-gray-300 rounded-md px-2 py-2">
                                @error('image')
                                    <div class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <button type="submit"
                                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white rounded-md px-4 py-2">
                                    Update
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
