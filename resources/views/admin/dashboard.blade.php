@extends('admin.layouts.app')

@section('title', 'Dasbor Utama')

            @section('content')
                <!-- Dashboard Content - Scrollable -->
                    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
                        <div class="space-y-6">
                        <!-- Election Session Toggle -->
                        <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-[#926AE1]/20 rounded-lg flex items-center justify-center">
                                        <i class="fa-solid fa-bullhorn text-[#411C8C] text-xl"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold text-gray-700">Mulai Sesi Pemilihan</h2>
                                        <p class="text-sm text-gray-500">Aktifkan dengan sekali klik</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="" class="sr-only peer">
                                    <div
                                        class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#7C3AED]">
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Statistics Cards -->
                        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Total Pemilih -->
                            <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div
                                            class="w-12 h-12 mb-4 bg-[#926AE1]/20 rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-users fa-xl text-[#411C8C]"></i>
                                        </div>
                                        <h3 class="text-3xl font-bold text-gray-700">1.321</h3>
                                        <p class="text-gray-500">Total Pemilih</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Kandidat -->
                            <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div
                                            class="w-12 h-12 mb-4 bg-[#72E1B2]/40 rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-user fa-xl text-[#22A06B]"></i>
                                        </div>
                                        <h3 class="text-3xl font-bold text-gray-700">4</h3>
                                        <p class="text-gray-500">Total Kandidat</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Suara Masuk -->
                            <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div
                                            class="w-12 h-12 mb-4 bg-[#FFEAB8]/80 rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-chart-line fa-xl text-[#FFB300]"></i>
                                        </div>
                                        <h3 class="text-3xl font-bold text-gray-700">538</h3>
                                        <p class="text-gray-500">Suara Masuk</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Belum Voting -->
                            <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div
                                            class="w-12 h-12 mb-4 bg-[#EA7C6E]/50 rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-times fa-2xl text-[#AE2A19]"></i>
                                        </div>
                                        <h3 class="text-3xl font-bold text-gray-700">783</h3>
                                        <p class="text-gray-500">Belum Voting</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Percentage Results -->
                        <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6 text-center">
                            <h2 class="text-2xl font-bold text-gray-700 mb-2">Persentase Hasil Perolehan Suara</h2>
                            <p class="text-gray-500 mb-6">Periode 2024/2025</p>

                            <div class="bg-blue-100 rounded-lg p-4 inline-block mb-2">
                                <span class="text-5xl font-bold text-blue-500">17,43%</span>
                            </div>
                            <p class="text-gray-500">Total Suara Masuk</p>
                        </div>

                        <!-- Charts Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Graph -->
                            <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                                <h2 class="text-xl font-bold text-gray-700 mb-4">Grafik Perolehan Suara</h2>
                                <div class="h-64 flex items-center justify-center">
                                    <p class="text-gray-500">Grafik akan ditampilkan di sini</p>
                                </div>
                            </div>

                            <!-- Candidate Results -->
                            <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                                <h2 class="text-xl font-bold text-gray-700 mb-4">Persentase Perolehan Suara</h2>

                                <div class="space-y-6">
                                    <div>
                                        <div class="flex justify-between mb-2">
                                            <span class="font-medium text-gray-700">Kandidat 1</span>
                                            <span class="font-medium text-gray-700">50%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-4">
                                            <div class="bg-green-500 h-4 rounded-full" style="width: 50%"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex justify-between mb-2">
                                            <span class="font-medium text-gray-700">Kandidat 2</span>
                                            <span class="font-medium text-gray-700">30%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-4">
                                            <div class="bg-[#7C3AED] h-4 rounded-full" style="width: 30%"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex justify-between mb-2">
                                            <span class="font-medium text-gray-700">Kandidat 3</span>
                                            <span class="font-medium text-gray-700">15%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-4">
                                            <div class="bg-yellow-500 h-4 rounded-full" style="width: 15%"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex justify-between mb-2">
                                            <span class="font-medium text-gray-700">Kandidat 4</span>
                                            <span class="font-medium text-gray-700">5%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-4">
                                            <div class="bg-red-500 h-4 rounded-full" style="width: 5%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endsection
                    