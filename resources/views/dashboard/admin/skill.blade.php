@extends('dashboard.admin.index')

@section('page-title', 'My Skills')

@section('content')
    <div class="space-y-8 px-4 sm:px-6 lg:px-10 pt-6">
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM TAMBAH SKILL --}}
        <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Tambah Skill Baru</h2>
            <form action="{{ route('admin.skills.create') }}" method="POST"
                class="grid grid-cols-1 sm:flex sm:flex-row gap-3">
                @csrf
                <input type="text" name="title" placeholder="Contoh: Web Development"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition w-full sm:w-auto">
                    + Tambah
                </button>
            </form>
        </div>

        {{-- LOOPING SKILL --}}
        @foreach ($skills as $skill)
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200 space-y-6">
                {{-- UPDATE TITLE + DELETE --}}
                <div class="grid grid-cols-1 sm:flex sm:flex-row sm:items-center justify-between gap-4">
                    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:flex sm:flex-row items-center gap-3 w-full">
                            <input type="text" name="title" value="{{ $skill->title }}"
                                class="w-full sm:flex-1 px-4 py-2 border-b-2 border-gray-300 text-xl font-semibold text-gray-800 focus:outline-none focus:border-blue-500 transition">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition w-full sm:w-auto">
                                Simpan
                            </button>
                        </div>
                    </form>
                    <form action="{{ route('admin.skills.delete', $skill->id) }}" method="POST"
                        onsubmit="return confirm('Yakin mau hapus skill ini?')" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full sm:w-auto px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm mt-2 sm:mt-0">
                            🗑️ Hapus Skill
                        </button>
                    </form>
                </div>

                {{-- DAFTAR SUBSKILL --}}
                <div class="overflow-x-auto pb-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                        @foreach ($skill->details as $detail)
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <form action="{{ route('admin.skills.details.update', $detail->id) }}" method="POST"
                                    class="space-y-3">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="subtitle" value="{{ $detail->subtitle }}"
                                        class="w-full border-b text-sm font-semibold text-gray-700 focus:outline-none">
                                    <select name="experience" class="w-full text-sm border rounded px-2 py-1 text-gray-700">
                                        @foreach (['Kurang dari setahun', '1 tahun', '2 tahun', '3 tahun', 'Lebih dari 3 tahun'] as $exp)
                                            <option {{ $detail->experience == $exp ? 'selected' : '' }}>{{ $exp }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div>
                                        <input type="range" name="percentage" value="{{ $detail->percentage }}"
                                            min="0" max="100" class="w-full accent-blue-500"
                                            oninput="document.getElementById('percent-{{ $detail->id }}').innerText = this.value">
                                        <p class="text-right text-xs text-gray-500 mt-1">
                                            <span id="percent-{{ $detail->id }}">{{ $detail->percentage }}</span>%
                                        </p>
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-green-500 text-white py-1 rounded hover:bg-green-600 transition">
                                        Update
                                    </button>
                                </form>
                                <form action="{{ route('admin.skills.details.delete', $detail->id) }}" method="POST"
                                    class="mt-2 text-right">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- TAMBAH SUBSKILL --}}
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <h4 class="text-sm font-semibold text-gray-600 mb-3">Tambah Subskill</h4>
                    <form action="{{ route('admin.skills.details.create', $skill->id) }}" method="POST"
                        class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                        @csrf
                        <input type="text" name="subtitle" placeholder="Subskill (contoh: HTML)"
                            class="border px-3 py-2 rounded focus:outline-none w-full" required>

                        <select name="experience" class="border px-3 py-2 rounded focus:outline-none w-full" required>
                            <option disabled selected>Pengalaman</option>
                            @foreach (['Kurang dari setahun', '1 tahun', '2 tahun', '3 tahun', 'Lebih dari 3 tahun'] as $exp)
                                <option value="{{ $exp }}">{{ $exp }}</option>
                            @endforeach
                        </select>

                        <input type="number" name="percentage" min="0" max="100" placeholder="%" required
                            class="border px-3 py-2 rounded focus:outline-none w-full">

                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded w-full md:w-auto">
                            + Tambah
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
