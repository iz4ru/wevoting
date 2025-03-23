@extends('admin.layouts.app')

@section('title', 'Preview Kandidat')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Preview Kandidat</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Lihat preview dari kandidat untuk landing page.</p>
                    </div>
                </div>
                <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-8 mx-6">

                <a href="{{ route('candidate') }}" class=" w-1/2 lg:w-1/4 px-6 py-4 bg-gray-400/80 hover:bg-gray-500/80 text-white rounded-xl transition-colors flex items-center justify-center gap-3">
                    <span class="font-semibold">Kembali</span>
                </a>
            </div>
        </div>

        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg mt-6">
                <!-- Candidate Section -->
                <section id="candidate">
                    <div class="lg:py-8">
                        <div class="max-w-6xl mx-auto px-4">
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-800 mt-6 mb-2">Pilih Kandidat Terbaikmu!</h2>
                                <p class="text-gray-600">
                                    Gunakan hak suaramu untuk memilih pemimpin yang tepat. <br>
                                    Cermati, telusuri, dan berikan suaramu dengan mudah lewat Wevoting!
                                </p>
                            </div>

                            <!-- Candidate Card -->
                            <div class="bg-[#F1F1F1] bg-opacity-40 rounded-lg shadow-lg p-6 mb-8">
                                <div class=" flex flex-col items-center gap-2">
                                    <!-- Candidate Position -->
                                    <div
                                        class="bg-[#926AE1] bg-opacity-20 text-[#FAFAFA] px-16 py-2 rounded-md text-sm font-bold transition-colors flex items-center gap-2 mb-4">
                                        <h3 class="text-xl font-semibold text-[#411C8C]">
                                            {{ $candidate->position->position_name }}</h3>
                                    </div>
                                    <!-- Candidate Image -->
                                    <div
                                        class="relative items-center justify-center my-4 bg-[#926AE1]/10 hover:bg-[#926AE1]/20 backdrop-blur-lg rounded-md transform transition ease-in-out">
                                        <img src="{{ Storage::url('images/' . $candidate->image) }}"
                                            class="w-[320px] h-[320px] lg:w-[360px] lg:h-[360px] object-cover rounded-lg border border-gray-300 shadow-sm"
                                            alt="">
                                    </div>
                                    <!-- Candidate Name -->
                                    <h3 class="text-lg font-semibold text-gray-800 mb-8">{{ $candidate->name }}</h3>
                                </div>

                                <!-- Candidate Info -->
                                <div class="space-y-6">
                                    <!-- Visi -->
                                    <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-6">
                                        <div class="text-[#411C8C]">
                                            <h3 class="font-semibold uppercase mb-2">Visi</h3>
                                            <p class="text-content whitespace-pre-line" id="vision-text">
                                                {{ Str::limit($candidate->vision, 255, '...') }}
                                            </p>
                                            <p class="text-content hidden whitespace-pre-line" id="vision-text-full">
                                                {{ $candidate->vision }}
                                            </p>
                                            <button class="toggle-button text-[#1D7AFC] hover:underline mt-2"
                                                data-short="vision-text" data-full="vision-text-full">
                                                Lihat Selengkapnya
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Misi -->
                                    <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-6">
                                        <div class="text-[#411C8C]">
                                            <h3 class="font-semibold uppercase mb-2">Misi</h3>
                                            <p class="text-content whitespace-pre-line" id="mission-text">
                                                {{ Str::limit($candidate->mission, 255, '...') }}
                                            </p>
                                            <p class="text-content hidden whitespace-pre-line" id="mission-text-full">
                                                {{ $candidate->mission }}
                                            </p>
                                            <button class="toggle-button text-[#1D7AFC] hover:underline mt-2"
                                                data-short="mission-text" data-full="mission-text-full">
                                                Lihat Selengkapnya
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Program Kerja -->
                                    <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-6">
                                        <div class="text-[#411C8C]">
                                            <h3 class="font-semibold uppercase mb-2">Program Kerja</h3>
                                            <p class="text-content whitespace-pre-line" id="work-text">
                                                {{ Str::limit($candidate->work_program, 255, '...') }}
                                            </p>
                                            <p class="text-content hidden whitespace-pre-line" id="work-text-full">
                                                {{ $candidate->work_program }}
                                            </p>
                                            <button class="toggle-button text-[#1D7AFC] hover:underline mt-2"
                                                data-short="work-text" data-full="work-text-full">
                                                Lihat Selengkapnya
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Video Section -->
                                    <div class="mt-12">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Video Kampanye</h3>
                                        <iframe src="{{ $candidate->video_link }}" frameborder="0"
                                            class="w-full aspect-video bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400">Video Placeholder</span>
                                        </iframe>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>


    @endsection
