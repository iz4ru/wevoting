@extends('admin.layouts.app')

@section('title', 'Tambahkan Data Posisi')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Tambahkan Data Posisi</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Daftarkan posisi untuk setiap kandidat.</p>
                    </div>
                </div>
                <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-8 mx-6">

                <div class="flex flex-col items-center lg:items-start lg:text-left">
                    <!-- Teks dengan ikon -->
                    <div class="flex items-center gap-2 text-sm lg:text-base text-[#4F22AA] mb-4">
                        <i class="fa fa-keyboard"></i>
                        <span>Silahkan untuk memasukkan data yang harus diisi.</span>
                    </div>

                    <ul class="text-sm list-disc pl-5 mb-8">
                        <li>Pastikan posisi yang ditambahkan tidak duplikat.</li>
                    </ul>

                    <!-- Form Pendaftaran -->
                    <div class="w-full max-w-lg">
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

                        <form action="{{ route('position.store') }}" method="POST"
                            onsubmit="validateForm(event)">
                            @csrf
                            <div class="space-y-4">

                                <!-- Name -->
                                <div>
                                    <label for="position_name" class="text-gray-500 font-medium text-sm">Nama Posisi</label>
                                    <div class="relative">
                                        <i class="fa fa-user-tie absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input placeholder="Masukkan Nama Posisi" type="text" name="position_name"
                                            id="position_name"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off">
                                    </div>
                                </div>

                                <!-- Register Button -->
                                <div class="mt-6 w-full flex flex-column gap-4">
                                    <a href="{{ route('position') }}" class="mt-8 w-full px-6 py-4 bg-gray-400/80 hover:bg-gray-500/80 text-white rounded-xl transition-colors flex items-center justify-center gap-3">
                                        <span class="font-semibold">Kembali</span>
                                    </a>
                                    <button type="submit"
                                        class="mt-8 w-full px-6 py-4 bg-[#7C3AED] hover:bg-[#6D31D5] text-white rounded-xl transition-colors flex items-center justify-center gap-3">
                                        <span class="font-semibold">Tambahkan</span>
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <script>
                    document.getElementById("name").addEventListener("input", function() {
                        var name = this.value;

                        var username = name.toLowerCase().replace(/\s/g, '');

                        document.getElementById("username").value = username;
                    });
                </script> --}}
            </div>

        @endsection
