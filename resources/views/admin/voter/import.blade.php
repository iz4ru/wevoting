@extends('admin.layouts.app')

@section('title', 'Impor Data Pemilih')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Impor Data Pemilih</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Tambahkan data pemilih baru ke dalam sistem melalui
                            impor data.</p>
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
                        <li>Pastikan jenis file adalah <span class="text-green-600">'.xlsx', '.xls', '.csv'</span></li>
                        <li>Jika tidak ada field <span class="text-blue-600">'access_code'</span> pada tabel di excel, maka akan digenerate otomatis oleh sistem.</li>
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

                        <form action="{{ route('voter.import') }}" method="POST" onsubmit="validateForm(event)"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">

                                <!-- File Input -->
                                <div
                                    class="relative flex items-center border border-gray-300 rounded-md shadow-sm bg-white">
                                    <i class="fa fa-file-import text-gray-300 absolute left-4"></i>
                                    <input type="file" name="file" id="file" accept="file/*"
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

                                <!-- Import Button -->
                                <div class="mt-6 w-full flex flex-column gap-4">
                                    <a href="{{ route('voter') }}"
                                        class="mt-8 w-full px-6 py-4 bg-gray-400/80 hover:bg-gray-500/80 text-white rounded-xl transition-colors flex items-center justify-center gap-3">
                                        <span class="font-semibold">Kembali</span>
                                    </a>
                                    <button type="submit"
                                        class="mt-8 w-full px-6 py-4 bg-[#7C3AED] hover:bg-[#6D31D5] text-white rounded-xl transition-colors flex items-center justify-center gap-3">
                                        <span class="font-semibold">Impor</span>
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
