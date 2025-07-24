@extends('dashboard.admin.index')

@section('page-title', 'Tambah Profil')

@section('content')
    <div class="container mx-auto px-2 py-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Profil Pengguna</h1>

        <form action="{{ route('homes.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-8 shadow-xl rounded-2xl border border-gray-200">
            @csrf

            <div class="col-span-1 md:col-span-2">
                <label for="nama" class="block font-semibold text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" id="nama" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label for="teks" class="block font-semibold text-gray-700 mb-1">Teks</label>
                <textarea name="teks" id="teks" rows="2" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"></textarea>

            </div>

            <div>
                <label for="gambar" class="block font-semibold text-gray-700 mb-1">Foto Profil</label>
                <input type="file" name="gambar" id="gambar" class="w-full border border-gray-300 rounded-lg p-2">
            </div>

            <div class="mb-4">
                <label for="latarbelakang" class="block font-medium text-gray-700">Latar Belakang</label>
                <textarea name="latarbelakang" id="latarbelakang" rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('latarbelakang', $home->latarbelakang ?? '') }}</textarea>

                <p class="text-sm text-gray-500 mt-1">Tambahkan <code>\n</code> untuk membuat enter atau baris baru.</p>
            </div>


            <div class="col-span-1 md:col-span-2 flex justify-between items-center pt-4">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Simpan Profil
                </button>
                <a href="{{ route('homes.index') }}" class="text-gray-600 hover:underline">Kembali</a>
            </div>
        </form>
    </div>
@endsection
