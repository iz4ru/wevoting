@extends('admin.layouts.app')

@section('title', 'Update Data Pemilih')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Update Data Pemilih</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Lihat, perbarui informasi data pemilih yang terdaftar dalam sistem.</p>
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
                        <li>Pastikan nomor identitas yang ditambahkan tidak sama dengan pemilih yang lain.</li>
                        <li>Nomor identitas tidak boleh diawali dengan angka nol '0'.</li>
                        <li>Nomor identitas maksimal 10 digit.</li>
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

                        <form action="{{ route('voter.update', $voter->uuid) }}" method="POST" onsubmit="validateForm(event)">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">

                                <!-- ID Number -->
                                <div>
                                    <label for="user_id" class="text-gray-500 font-medium text-sm">Nomor Identitas</label>
                                    <div class="relative">
                                        <i class="fa fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input placeholder="Masukkan Nomor Identitas" type="number" name="user_id"
                                            id="user_id" min="0"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off" value="{{ $voter->user_id }}">
                                    </div>
                                </div>

                                <!-- Name -->
                                <div>
                                    <label for="name" class="text-gray-500 font-medium text-sm">Nama Pemilih</label>
                                    <div class="relative">
                                        <i class="fa fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input placeholder="Masukkan Nama Pemilih" type="text" name="name"
                                            id="name"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off" value="{{ $voter->name }}">
                                    </div>
                                </div>

                                <!-- Class -->
                                <div>
                                    <label for="class" class="text-gray-500 font-medium text-sm">Kelas</label>
                                    <div class="relative">
                                        <i
                                            class="fa fa-chalkboard-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input placeholder="Masukkan Kelas / Bidang" type="text" name="class"
                                            id="class"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off" value="{{ $voter->class }}">
                                    </div>
                                </div>

                                <!-- Vocation -->
                                <div>
                                    <label for="vocation" class="text-gray-500 font-medium text-sm">Jurusan / Bidang</label>
                                    <div class="relative">
                                        <i
                                            class="fa fa-school absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input placeholder="Masukkan Jurusan / Bidang" type="text" name="vocation"
                                            id="class"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off" value="{{ $voter->vocation }}">
                                    </div>
                                </div>

                                <!-- Access Code -->
                                <div>
                                    <label for="access_code" class="text-gray-500 font-medium text-sm">Kode Akses</label>
                                    <div class="relative">
                                        <i class="fa fa-qrcode absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                                        <input placeholder="Masukkan Kode Akses" type="text" name="access_code"
                                            id="access_code"
                                            class="text-sm w-full h-14 pl-12 bg-gray-100 text-gray-500 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off" disabled value="{{ $voter->access_code }}">
                                    </div>
                                </div>
                                
                                <!-- Vote Status -->
                                <div>
                                    <label for="validation" class="text-gray-500 font-medium text-sm">Status Vote</label>
                                    <div class="relative">
                                        <i class="fa fa-user-shield absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                                        <select placeholder="Pilih Role Anda" type="select" name="validation" id="validation"
                                            class="text-sm w-full h-14 pl-12 pr-12 bg-gray-100 text-gray-500 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off" disabled>
                                            <option value="" {{ $voter->validation === 'belum' ? 'selected' : '' }}>Belum</option>
                                            <option value="" {{ $voter->validation === 'sudah' ? 'selected' : '' }}>Sudah</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Update Button -->
                                <div class="mt-6 w-full flex flex-column gap-4">
                                    <a href="{{ route('voter') }}"
                                        class="mt-8 w-full px-6 py-4 bg-gray-400/80 hover:bg-gray-500/80 text-white rounded-xl transition-colors flex items-center justify-center gap-3">
                                        <span class="font-semibold">Kembali</span>
                                    </a>
                                    <button type="submit"
                                        class="mt-8 w-full px-6 py-4 bg-[#7C3AED] hover:bg-[#6D31D5] text-white rounded-xl transition-colors flex items-center justify-center gap-3">
                                        <span class="font-semibold">Simpan</span>
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
