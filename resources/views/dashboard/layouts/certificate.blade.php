@extends('dashboard.layouts.index')

@section('content')
    <section class="flex justify-center pt-8 pb-16 px-4" x-data="{ selectedCert: null }">
        <div class="w-full max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-6 mt-10">My Certifications</h2>
            <p class="text-center text-gray-600 text-base md:text-lg mb-8 leading-relaxed">
                Below are my certifications with related details.
            </p>

            <div class="space-y-6">
                @forelse ($certificates as $cert)
                    <div class="bg-white rounded-2xl shadow-md p-6 cursor-pointer hover:shadow-lg transition h-[150px]"
                        @click="selectedCert = {{ $cert->toJson() }}">
                        <h3 class="text-xl font-semibold text-cyan-700 mb-2">{{ $cert->title }}</h3>
                        <p class="text-sm text-gray-500">Click to see details</p>
                    </div>
                @empty
                    <div class="text-center text-gray-500 text-lg">
                        No certifications available at the moment.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Modal Popup --}}
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center" x-show="selectedCert"
            x-transition @click.self="selectedCert = null">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 overflow-auto max-h-[90vh]"
                x-show="selectedCert" x-transition>
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-2xl font-bold text-cyan-700" x-text="selectedCert.title"></h3>
                    <button class="text-gray-500 hover:text-red-600" @click="selectedCert = null">✖</button>
                </div>

                <template x-if="selectedCert.details && selectedCert.details.length">
                    <ul class="space-y-6">
                        <template x-for="(detail, index) in selectedCert.details" :key="index">
                            <li class="border-b pb-4">
                                <h4 class="text-lg font-semibold text-gray-800" x-text="detail.subtitle"></h4>
                                <p class="text-sm text-gray-600 mt-1" x-text="detail.description"></p>

                                <template x-if="detail.link">
                                    <a :href="detail.link" class="text-sm text-cyan-500 hover:underline mt-1"
                                        target="_blank">
                                        View Certificate
                                    </a>
                                </template>

                                <template x-if="detail.image">
                                    <div class="mt-1">
                                        <a :href="'/storage/' + detail.image" target="_blank"
                                            class="text-sm text-cyan-500 hover:underline">
                                            Open Certificate Image
                                        </a>
                                    </div>
                                </template>
                            </li>
                        </template>
                    </ul>
                </template>
            </div>
        </div>
    </section>
@endsection
