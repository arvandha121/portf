@extends('dashboard.admin.index')

@section('page-title', 'Dashboard Home')

@section('content')
    <div class="container mx-auto px-4 py-5">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Profil Pengguna</h1>
            @if ($homes->isEmpty())
                <a href="{{ route('homes.create') }}"
                    class="inline-block bg-indigo-600 text-white text-md px-6 py-3 rounded-xl shadow-md hover:bg-indigo-700 transition">
                    + Tambah Profil
                </a>
            @endif
        </div>

        @forelse ($homes as $home)
            <div
                class="bg-white shadow-xl rounded-3xl p-10 flex flex-col items-center text-center gap-6 w-full mb-12 border border-gray-200">
                {{-- Gambar profil --}}
                <div class="flex-shrink-0">
                    <img src="{{ asset($home->gambar) }}" alt="{{ $home->nama }}"
                        class="w-48 h-48 object-cover rounded-full shadow-lg border-4 border-indigo-200">
                </div>

                {{-- Konten teks --}}
                <div class="flex-1 w-full">
                    <h3 class="text-3xl font-bold text-gray-900 ">{{ $home->nama }}</h3>

                    <div class="whitespace-pre-line text-gray-700 text-lg mb-6 leading-relaxed">
                        {{ str_replace('\n', "\n", $home->latarbelakang) }}
                    </div>

                    <div class="text-gray-700 text-lg mb-6 leading-relaxed">
                        {!! nl2br($home->teks) !!}
                    </div>

                    <div class="mb-6">
                        <span class="inline-block bg-indigo-100 text-indigo-700 text-sm font-medium px-4 py-2 rounded-full">
                            Dibuat pada: {{ $home->created_at->format('d M Y') }}
                        </span>
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="flex justify-center flex-wrap gap-4 mt-6">
                        <a href="{{ route('homes.edit', $home->id) }}"
                            class="bg-yellow-500 text-white text-sm px-5 py-2 rounded-lg hover:bg-yellow-600 transition">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('homes.destroy', $home->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white text-sm px-5 py-2 rounded-lg hover:bg-red-700 transition">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 text-xl">Belum ada data profil.</div>
        @endforelse
    </div>
@endsection
