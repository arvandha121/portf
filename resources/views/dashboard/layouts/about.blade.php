@extends('dashboard.layouts.index')

@section('content')
    <section class="flex justify-center pt-12 pb-20 px-4 sm:px-6 about-section bg-[#f9fafb]">
        <div class="w-full max-w-6xl mx-auto">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-[#1F2937] mb-4 sm:mb-6 mt-4 sm:mt-6">
                About Me
            </h2>
            <p class="text-center text-gray-600 text-sm sm:text-base mb-8 sm:mb-12">
                Here is a short introduction to who I am and what I do.
            </p>

            @if ($about)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-12 items-center">
                    {{-- Foto --}}
                    <div class="flex justify-center">
                        <div
                            class="relative w-[280px] sm:w-[320px] md:w-[360px] lg:w-[400px] h-[360px] sm:h-[420px] md:h-[480px] lg:h-[520px] rounded-2xl overflow-hidden shadow-lg border border-gray-200">
                            <img src="{{ asset('storage/' . $about->image) }}" alt="About Me"
                                class="w-full h-full object-cover object-center">
                        </div>
                    </div>

                    {{-- Deskripsi & Statistik --}}
                    <div>
                        <p
                            class="whitespace-pre-line text-gray-700 text-sm sm:text-base leading-relaxed mb-6 sm:mb-8 text-justify">
                            {{ str_replace('\n', "\n", $about->description) }}
                        </p>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 sm:gap-6 text-center mb-6 sm:mb-8">
                            <div class="rounded-xl p-3 sm:p-4 bg-white shadow-md border border-gray-100">
                                <p class="text-2xl sm:text-3xl font-extrabold text-cyan-600">
                                    {{ str_pad($about->years_experience, 2, '0', STR_PAD_LEFT) }}+
                                </p>
                                <p class="text-xs sm:text-sm text-gray-600 italic mt-1">Years</p>
                            </div>
                            <div class="rounded-xl p-3 sm:p-4 bg-white shadow-md border border-gray-100">
                                <p class="text-2xl sm:text-3xl font-extrabold text-cyan-600">
                                    {{ str_pad($about->certification_total, 2, '0', STR_PAD_LEFT) }}+
                                </p>
                                <p class="text-xs sm:text-sm text-gray-600 italic mt-1">Certificates</p>
                            </div>
                            <div
                                class="rounded-xl p-3 sm:p-4 bg-white shadow-md border border-gray-100 col-span-2 sm:col-span-1">
                                <p class="text-2xl sm:text-3xl font-extrabold text-cyan-600">
                                    {{ str_pad($about->companies_worked, 2, '0', STR_PAD_LEFT) }}+
                                </p>
                                <p class="text-xs sm:text-sm text-gray-600 italic mt-1">Companies</p>
                            </div>
                        </div>

                        {{-- Tombol Download CV --}}
                        @if ($about->cv_file)
                            <div class="text-start h-[65px] sm:h-[75px]">
                                <a href="{{ asset('storage/' . $about->cv_file) }}" download
                                    class="inline-block w-full sm:w-fit text-center bg-cyan-600 hover:bg-cyan-700 text-white text-sm sm:text-base font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-xl transition duration-300 shadow-lg">
                                    📄 Download CV
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-center text-gray-600 mt-8 text-sm sm:text-base">No About Me data available.</p>
            @endif
        </div>
    </section>
@endsection
