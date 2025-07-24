@extends('dashboard.admin.index')

@section('page-title', 'About Me')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg-white rounded-2xl shadow-md">
        <h2 class="text-xl sm:text-2xl font-bold mb-6 text-gray-800 text-start">Tentang Saya</h2>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-2 rounded mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($about)
            {{-- Form Update --}}
            <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Foto --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Foto</label>
                        <div class="flex justify-center md:justify-start">
                            <div
                                class="relative w-[250px] sm:w-[280px] md:w-[320px] lg:w-[360px] h-[320px] sm:h-[380px] md:h-[420px] lg:h-[480px] rounded-2xl overflow-hidden shadow-lg border border-gray-200 mb-5">
                                <img src="{{ asset('storage/' . $about->image) }}" alt="About Me"
                                    class="w-full h-full object-cover object-center">
                            </div>
                        </div>
                        <input type="file" name="image"
                            class="block w-full text-sm text-gray-600 border rounded px-3 py-2">
                    </div>

                    {{-- Deskripsi & Statistik --}}
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" rows="6"
                                class="whitespace-pre-line w-full border rounded px-3 py-2 text-sm resize-none" required>{{ str_replace('\n', "\n", $about->description) }}</textarea>
                            <p class="text-xs text-gray-400 mt-1">Tambahkan <code>\n</code> untuk membuat baris baru.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Pengalaman (tahun)</label>
                                <input type="number" name="years_experience" value="{{ $about->years_experience }}"
                                    class="w-full border rounded px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sertifikasi</label>
                                <input type="number" name="certification_total" value="{{ $about->certification_total }}"
                                    class="w-full border rounded px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Perusahaan</label>
                                <input type="number" name="companies_worked" value="{{ $about->companies_worked }}"
                                    class="w-full border rounded px-3 py-2 text-sm" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CV --}}
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">File CV</label>
                    @if ($about->cv_file)
                        <a href="{{ asset('storage/' . $about->cv_file) }}" target="_blank"
                            class="inline-block w-full sm:w-auto text-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md shadow mb-2">
                            Lihat CV
                        </a>
                    @endif
                    <input type="file" name="cv_file"
                        class="block w-full text-sm text-gray-600 border rounded px-3 py-2">
                </div>

                {{-- Tombol --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6">
                    <button type="submit"
                        class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-6 py-2 rounded-md shadow">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            {{-- Hapus --}}
            <form action="{{ route('admin.about.delete', $about->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus data?')" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-2 rounded-md shadow">
                    Hapus Data
                </button>
            </form>
        @else
            {{-- Form Create --}}
            <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Foto --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Foto</label>
                        <input type="file" name="image" class="block w-full text-sm border rounded px-3 py-2" required>
                    </div>

                    {{-- Info --}}
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" rows="6" class="w-full border rounded px-3 py-2 text-sm resize-none" required></textarea>
                            <p class="text-xs text-gray-400 mt-1">Tambahkan <code>\n</code> untuk membuat baris baru.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Pengalaman (thn)</label>
                                <input type="number" name="years_experience" value="{{ $about->years_experience ?? 0 }}"
                                    class="w-full border rounded px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sertifikasi</label>
                                <input type="number" name="certification_total"
                                    value="{{ $about->certification_total ?? 0 }}"
                                    class="w-full border rounded px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Perusahaan</label>
                                <input type="number" name="companies_worked" value="{{ $about->companies_worked ?? 0 }}"
                                    class="w-full border rounded px-3 py-2 text-sm" required>
                            </div>
                        </div>

                        {{-- Upload CV --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Upload File CV</label>
                            <input type="file" name="cv_file"
                                class="block w-full text-sm text-gray-600 border rounded px-3 py-2" required>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-md shadow">
                        Tambah Data
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection
