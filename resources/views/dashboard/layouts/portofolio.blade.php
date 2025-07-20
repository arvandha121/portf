@extends('dashboard.layouts.index')

@section('content')
    <section class="flex justify-center pt-8 pb-16 px-4" x-data="{
        selectedProject: null,
        selectedType: 'all',
        projects: {{ $projects->toJson() }},
        get filteredProjects() {
            return this.selectedType === 'all' ?
                this.projects :
                this.projects.filter(p => p.tipe === this.selectedType);
        },
        uniqueTypes() {
            const types = this.projects.map(p => p.tipe);
            return ['all', ...new Set(types)];
        }
    }" x-init="$watch('selectedType', () => { selectedProject = null })">
        <div class="w-full max-w-7xl mx-auto">

            {{-- Heading --}}
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-4 mt-10">My Portfolios</h2>
            <p class="text-center text-gray-600 text-base md:text-lg mb-8 leading-relaxed">
                Below are some of my personal or professional portfolio projects.
            </p>

            {{-- Filter Buttons --}}
            <div class="flex flex-wrap justify-center gap-3 mb-10">
                <template x-for="type in uniqueTypes()" :key="type">
                    <button class="px-4 py-2 rounded-full text-sm font-medium transition duration-200 ease-in-out"
                        :class="selectedType === type ? 'bg-indigo-600 text-white shadow' :
                            'bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-black'"
                        x-text="type === 'all' ? 'Semua' : type" @click="selectedType = type">
                    </button>
                </template>
            </div>

            {{-- If no projects --}}
            <template x-if="filteredProjects.length === 0">
                <div class="text-center text-gray-500 text-lg">
                    No portfolio projects available for selected filter.
                </div>
            </template>

            {{-- Portfolio Cards --}}
            <div class="flex justify-center">
                <template x-if="selectedType === 'all'">
                    <div class="grid gap-6"
                        :class="{
                            'grid-cols-1': filteredProjects.length === 1,
                            'grid-cols-2': filteredProjects.length === 2,
                            'grid-cols-3': filteredProjects.length >= 3
                        }">
                        <template x-for="project in filteredProjects" :key="project.id">
                            <div class="bg-white rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-transform duration-300 cursor-pointer p-4"
                                @click="selectedProject = project">
                                <div class="aspect-[2/1] overflow-hidden rounded-lg mb-3">
                                    <img :src="'/storage/' + project.image" alt=""
                                        class="w-full h-[300px] object-cover transition duration-300 hover:scale-105">
                                </div>
                                <div class="space-y-2">
                                    <h3 class="text-lg font-semibold text-gray-800" x-text="project.title"></h3>
                                    <p class="text-sm text-indigo-600 font-medium" x-text="project.tipe"></p>
                                    <p class="text-sm text-gray-600 line-clamp-3" x-text="project.description"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-if="selectedType !== 'all'">
                    <div class="flex justify-center">
                        <div class="grid gap-6"
                            :class="{
                                'grid-cols-1': filteredProjects.length === 1,
                                'grid-cols-2': filteredProjects.length >= 2
                            }">
                            <template x-for="project in filteredProjects" :key="project.id">
                                <div class="bg-white rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-transform duration-300 cursor-pointer w-[440px] md:w-[500px] p-6"
                                    @click="selectedProject = project">
                                    <div class="aspect-[6/3] overflow-hidden rounded-lg mb-4">
                                        <img :src="'/storage/' + project.image" alt=""
                                            class="w-full h-[320px] object-cover transition duration-300 hover:scale-105">
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-xl font-semibold text-gray-800" x-text="project.title"></h3>
                                        <p class="text-sm text-indigo-600 font-medium" x-text="project.tipe"></p>
                                        <p class="text-sm text-gray-600 line-clamp-4" x-text="project.description"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                {{-- <template x-if="selectedType !== 'all'">
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                        <template x-for="project in filteredProjects" :key="project.id">
                            <div class="bg-white rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-transform duration-300 cursor-pointer p-4"
                                @click="selectedProject = project">
                                <div class="aspect-[3/2] overflow-hidden rounded-lg mb-3">
                                    <img :src="'/storage/' + project.image" alt=""
                                        class="w-full h-[350px] object-cover transition duration-300 hover:scale-105">
                                </div>
                                <div class="space-y-2">
                                    <h3 class="text-base font-semibold text-gray-800" x-text="project.title"></h3>
                                    <p class="text-sm text-indigo-600 font-medium" x-text="project.tipe"></p>
                                    <p class="text-sm text-gray-600 line-clamp-3" x-text="project.description"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </template> --}}
            </div>
        </div>

        {{-- Modal --}}
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center" x-show="selectedProject"
            x-transition @click.self="selectedProject = null">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 overflow-auto max-h-[90vh]"
                x-show="selectedProject" x-transition>
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-2xl font-bold text-gray-800" x-text="selectedProject.title"></h3>
                    <button class="text-gray-500 hover:text-red-600" @click="selectedProject = null">✖</button>
                </div>

                <img :src="'/storage/' + selectedProject.image" alt="" class="w-full rounded-lg mb-4">
                <p class="text-sm text-indigo-600 font-medium" x-text="selectedProject.tipe"></p>
                <p class="text-gray-700 mt-3 text-sm" x-text="selectedProject.description"></p>

                <template x-if="selectedProject.link">
                    <a :href="selectedProject.link" target="_blank" rel="noopener noreferrer"
                        class="inline-block mt-4 text-blue-600 hover:underline text-sm font-medium">
                        Visit Project &rarr;
                    </a>
                </template>
            </div>
        </div>
    </section>
@endsection
