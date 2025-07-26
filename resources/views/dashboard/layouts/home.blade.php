@extends('dashboard.layouts.index')

@section('content')
    <section class="hero bg-gray-50">
        <div class="hero-container">
            @if ($home)
                {{-- Image --}}
                <div class="hero-img">
                    <img src="{{ asset($home->gambar) }}" alt="{{ $home->nama }}"
                        class="cursor-pointer transition duration-300 ease-in-out hover:scale-105"
                        onclick="openImageModal('{{ asset($home->gambar) }}')">
                </div>

                {{-- Text --}}
                <div class="hero-text">
                    <h2>Hi, I'm</h2>
                    <h1>{{ $home->nama }}</h1>
                    <h3 class="whitespace-pre-line text-gray-700 font-medium">
                        {{ str_replace('\n', "\n", $home->latarbelakang) }}
                    </h3>
                    <p>{{ $home->teks }}</p>
                    <a href="{{ route('contact.create') }}" class="btn-contact">
                        Contact Me <i data-feather="arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="text-center text-gray-500 py-10">
                    <p class="text-lg font-semibold">Data belum tersedia.</p>
                    <p class="text-sm text-gray-400">Silakan tambahkan data melalui dashboard admin.</p>
                </div>
            @endif
        </div>

        {{-- Modal --}}
        <div id="imageModal"
            class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 opacity-0 scale-95 pointer-events-none transition duration-300 ease-out"
            onclick="closeImageModal()" style="cursor: auto">
            <img id="modalImage"
                class="max-w-full max-h-full rounded-lg shadow-lg transform transition duration-300 ease-in-out"
                alt="Zoomed Image">
        </div>
    </section>

    <script>
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const image = document.getElementById('modalImage');
            image.src = src;
            modal.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
            modal.classList.add('opacity-100', 'scale-100');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            const image = document.getElementById('modalImage');
            modal.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            modal.classList.remove('opacity-100', 'scale-100');
            setTimeout(() => {
                image.src = '';
            }, 300);
        }
    </script>
@endsection
