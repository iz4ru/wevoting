@extends('admin.layouts.app')

@section('title', 'Data Kandidat')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Data Kandidat</h1>
                        <p class="text-sm text-[#4F22AA] mb-4 lg:text-base">Tambahkan data kandidat atau manajemen kandidat.
                        </p>
                    </div>
                    <div class="shadow-lg w-max">
                        <a href="{{ route('candidate') }}"
                            class="font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#4F22AA] text-white rounded-md hover:bg-[#3C1C8C]">
                            <span class="text-sm lg:text-base">Tambah Kandidat</span>
                            <i class="fa-solid fa-user-plus fa-sm lg:fa-md"></i>
                        </a>
                    </div>
                </div>
                <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-8 mx-6">

                <!-- Alerts -->
                @if (session('success'))
                    <div class="alert alert-success py-2 px-4 mb-4 bg-green-100 text-green-500 border border-green-500 rounded-md"
                        role="alert" id="successAlert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error py-2 px-4 mb-4 bg-red-100 text-red-500 border border-red-500 rounded-md"
                        role="alert" id="errorAlert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <div class="overflow-x-auto text-sm">

                    <!-- Candidates Cards -->
                    <div class="px-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 md:grid-cols-1 gap-6 mb-8">

                        <div class="bg-white/30 backdrop-blur-xl rounded-xl shadow-lg p-6">
                            <div class="flex justify-center items-center">
                                <div class="flex flex-col">
                                    <!-- Candidate Name and Position -->
                                    <div class="text-center">
                                        <h3 class="text-xl my-1 font-bold text-gray-700">Satria & Siti</h3>
                                        <p class="text-gray-700 text-base">Kandidat 1</p>
                                    </div>
                                    <!-- Image -->
                                    <div class="relative items-center justify-center my-4 bg-[#926AE1]/10 backdrop-blur-lg rounded-md">
                                        <img src="{{ asset('img/candidate.png') }}" class="w-[360px]" alt="">
                                    </div>
                                    <!-- Progress Bar -->
                                    <div
                                        class="bg-[#72E1B2]/20 backdrop-blur-lg shadow-md rounded-md p-2 mb-4 flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-chart-bar fa-lg lg:fa-xl" style="color: #22A06B;"></i>
                                        <span class="text-[#22A06B] text-base font-semibold">Perolehan Suara: <span
                                                class="font-bold">47%</span></span>
                                    </div>
                                    <!-- Action Bar -->
                                    <div class="grid grid-cols-3 gap-3">
                                        <a href="#">
                                            <div
                                                class="bg-[#4A95FD]/20 backdrop-blur-lg shadow-md rounded-md p-2 mb-3 flex items-center justify-center gap-2">
                                                <i class="fa-solid fa-pen-to-square fa-md lg:fa-lg"
                                                    style="color: #1D7AFC;"></i>
                                                <span class="text-[#1D7AFC] text-sm font-semibold">Edit</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div
                                                class="bg-[#FFB300]/20 backdrop-blur-lg shadow-md rounded-md p-2 mb-3 flex items-center justify-center gap-2">
                                                <i class="fa-solid fa-eye fa-md lg:fa-ld" style="color: #E5A100;"></i>
                                                <span class="text-[#E5A100] text-sm font-semibold">Lihat</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div
                                                class="bg-[#E24A36]/20 backdrop-blur-lg shadow-md rounded-md p-2 mb-3 flex items-center justify-center gap-2">
                                                <i class="fa-solid fa-trash fa-md lg:fa-lg" style="color: #CD311D;"></i>
                                                <span class="text-[#CD311D] text-sm font-semibold">Hapus</span>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
