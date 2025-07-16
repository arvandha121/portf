@extends('dashboard.layouts.index')

@section('content')
    <section class="flex justify-center pt-8 pb-16 px-4 skill-section">
        <div class="w-full max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-5">My Skills</h2>
            <p class="text-center text-gray-600 text-base md:text-lg mb-8 max-w-2xl mx-auto leading-relaxed mb-12">
                Here are the skills in my experience
            </p>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-2">
                @forelse ($skills as $skill)
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition duration-300">
                        <h3 class="text-xl font-semibold text-cyan-600 mb-4">
                            {{ $skill->title }}
                        </h3>

                        <ul class="space-y-4">
                            @foreach ($skill->details as $detail)
                                <li>
                                    <div class="flex justify-between text-sm font-medium text-gray-700">
                                        <span>{{ $detail->subtitle }}</span>
                                        <span>{{ $detail->percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-cyan-500 h-2 rounded-full transition-all duration-300"
                                            style="width: {{ $detail->percentage }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1 italic">
                                        {{ $detail->subtitle }} — {{ ucfirst($detail->experience) }} experience
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 text-lg">
                        No skills available at the moment.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
