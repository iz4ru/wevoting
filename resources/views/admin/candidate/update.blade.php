@extends('admin.layouts.app')

@section('title', 'Update Kandidat')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Update Kandidat</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Perbarui kandidat dengan informasi terbaru untuk
                            pemilihan.</p>
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
                        <li>Pastikan pilihan posisi tidak sama dengan kandidat yang lainnya.</li>
                        <li>Pastikan link video kampanye berasal dari <span class="text-red-500 underline">YouTube</span>
                            dengan menggunakan embed link.</li>
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

                        <form action="{{ route('candidate.update', $candidate->id) }}" method="POST"
                            enctype="multipart/form-data" onsubmit="validateForm(event)">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">

                                <!-- Name -->
                                <div>
                                    <label for="name" class="text-gray-500 font-medium text-sm">Nama</label>
                                    <div class="relative">
                                        <i class="fa fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input wire:model="name" placeholder="Masukkan Nama" type="text" name="name"
                                            id="name"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="name" value="{{ $candidate->name }}">
                                    </div>
                                </div>

                                <!-- Work Program -->
                                <div>
                                    <label for="work_program" class="text-gray-500 font-medium text-sm">Program
                                        Kerja</label>
                                    <div class="relative">
                                        <i
                                            class="fa fa-clipboard-list absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <textarea placeholder="Masukkan Program Kerja" type="textarea" name="work_program" id="work_program"
                                            class="text-sm w-full h-14 pl-12 lead placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off">{{ old('work_program', $candidate->work_program) }}</textarea>
                                    </div>
                                </div>

                                <!-- Vision -->
                                <div>
                                    <label for="vision" class="text-gray-500 font-medium text-sm">Visi</label>
                                    <div class="relative">
                                        <i
                                            class="fa fa-map-signs absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <textarea placeholder="Masukkan Visi" type="textarea" name="vision" id="vision"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off">{{ old('vision', $candidate->vision) }}</textarea>
                                    </div>
                                </div>

                                <!-- Mission -->
                                <div>
                                    <label for="mission" class="text-gray-500 font-medium text-sm">Misi</label>
                                    <div class="relative">
                                        <i
                                            class="fa fa-bullseye absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <textarea placeholder="Masukkan Misi" type="textarea" name="mission" id="mission"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off">{{ old('mission', $candidate->mission) }}</textarea>
                                    </div>
                                </div>

                                <!-- Photo -->
                                <div x-data="{ preview: '{{ $candidate->image ? asset('storage/images/' . $candidate->image) : '' }}' }" x-init="preview = '{{ $candidate->image ? asset('storage/images/' . $candidate->image) : '' }}'">
                                    <label for="image" class="text-gray-500 font-medium text-sm">Foto</label>

                                    <!-- Preview Image -->
                                    <div class="mb-3">
                                        <template x-if="preview">
                                            <img :src="preview"
                                                class="w-[360px] h-[360px] object-cover border border-gray-300 shadow-sm">
                                        </template>
                                    </div>

                                    <!-- File Input -->
                                    <div
                                        class="relative flex items-center border border-gray-300 rounded-md shadow-sm bg-white">
                                        <i class="fa fa-camera text-gray-300 absolute left-4"></i>
                                        <input type="file" name="image" id="image" accept="image/*"
                                            @change="let file = $event.target.files[0]; 
                                                if (file) { 
                                                    let reader = new FileReader(); 
                                                    reader.onload = e => preview = e.target.result; 
                                                    reader.readAsDataURL(file); 
                                                }"
                                            class="text-sm w-full h-14 pl-12 pr-4 text-gray-500 border-none focus:ring-0 
                                            file:mt-2.5 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                                            file:bg-[#7C3AED] file:hover:bg-[#6D31D5] file:text-white file:cursor-pointer file:font-medium">
                                    </div>
                                </div>

                                <!-- Video Link -->
                                <div>
                                    <label for="video_link" class="text-gray-500 font-medium text-sm">Link Video
                                        Kampanye</label>
                                    <div class="relative">
                                        <i class="fa fa-link absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input placeholder="Masukkan Tautan Video" type="text" name="video_link"
                                            id="video_link"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            autocomplete="link" value="{{ $candidate->video_link }}">
                                    </div>
                                </div>

                                <!-- Position -->
                                <div>
                                    <label for="id_position" class="text-gray-500 font-medium text-sm">Pilih Posisi</label>
                                    <div class="relative">
                                        <i class="fa fa-list absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <select placeholder="Pilih Posisi" type="select" name="id_position"
                                            id="id_position"
                                            class="text-sm w-full h-14 pl-12 pr-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off">
                                            @if ($positions->count() <= 0)
                                                <option value="" disabled selected>Tidak Ada Data Posisi, Buat
                                                    Terlebih Dahulu!</option>
                                            @endif
                                            <option value="" disabled selected>Pilih Posisi</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}"
                                                    {{ $candidate->id_position == $position->id ? 'selected' : '' }}>
                                                    {{ $position->position_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Register Candidate Button -->
                                <div class="mt-6 w-full flex flex-column gap-4">
                                    <a href="{{ route('candidate') }}"
                                        class="mt-8 w-full px-6 py-4 bg-gray-400/80 hover:bg-gray-500/80 text-white rounded-xl transition-colors flex items-center justify-center gap-3">
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
            </div>

        @endsection
