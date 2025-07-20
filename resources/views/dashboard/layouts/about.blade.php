@extends('dashboard.layouts.index')

@section('content')
    <section class="flex justify-center pt-12 pb-20 px-4 about-section bg-[#f9fafb]">
        <div class="w-full max-w-6xl mx-auto">
            <h2 class="text-4xl font-extrabold text-center text-[#1F2937] mb-6 mt-6">About Me</h2>
            <p class="text-center text-gray-600 text-base mb-12">
                Here is a short introduction to who I am and what I do.
            </p>

            @if ($about)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    {{-- Foto --}}
                    <div class="flex justify-center">
                        <div
                            class="relative w-[400px] h-[520px] rounded-2xl overflow-hidden shadow-lg border border-gray-200">
                            <img src="{{ asset('storage/' . $about->image) }}" alt="About Me"
                                class="w-full h-full object-cover object-center">
                        </div>
                    </div>

                    {{-- Deskripsi & Statistik --}}
                    <div>
                        <p class="text-gray-700 text-base leading-relaxed mb-8">
                            {{ $about->description }}
                        </p>

                        <div class="grid grid-cols-3 gap-6 text-center mb-8">
                            <div class="rounded-xl p-4 bg-white shadow-md border border-gray-100">
                                <p class="text-3xl font-extrabold text-cyan-600">
                                    {{ str_pad($about->years_experience, 2, '0', STR_PAD_LEFT) }}+
                                </p>
                                <p class="text-sm text-gray-600 italic mt-1">Years Experience</p>
                            </div>
                            <div class="rounded-xl p-4 bg-white shadow-md border border-gray-100">
                                <p class="text-3xl font-extrabold text-cyan-600">
                                    {{ str_pad($about->certification_total, 2, '0', STR_PAD_LEFT) }}+
                                </p>
                                <p class="text-sm text-gray-600 italic mt-1">Certifications</p>
                            </div>
                            <div class="rounded-xl p-4 bg-white shadow-md border border-gray-100">
                                <p class="text-3xl font-extrabold text-cyan-600">
                                    {{ str_pad($about->companies_worked, 2, '0', STR_PAD_LEFT) }}+
                                </p>
                                <p class="text-sm text-gray-600 italic mt-1">Companies</p>
                            </div>
                        </div>

                        {{-- Tombol Download CV --}}
                        @if ($about->cv_file)
                            <div class="text-start h-[75px]">
                                <a href="{{ asset('storage/' . $about->cv_file) }}" download
                                    class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white text-base font-semibold px-8 py-4 rounded-xl transition duration-300 shadow-lg">
                                    📄 Download CV
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-center text-gray-600 mt-8 text-base">No About Me data available.</p>
            @endif
        </div>
    </section>
@endsection
