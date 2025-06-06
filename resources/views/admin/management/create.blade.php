@extends('admin.layouts.app')

@section('title', 'Tambahkan Admin')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Tambahkan Admin atau Panitia</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Daftarkan admin atau panitia baru untuk membantu
                            pengelolaan sistem.</p>
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
                        <li>Pastikan email tidak sama dengan admin atau panitia lainnya.</li>
                        <li>Password tidak kurang dari 8 karakter.</li>
                        <li>Username akan otomatis digenerate oleh sistem.</li>
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

                        <form wire:submit='register' action="{{ route('admin.mgmt.store') }}" method="POST"
                            onsubmit="validateForm(event)">
                            @csrf
                            <div class="space-y-4">

                                <!-- Name -->
                                <div>
                                    <label for="name" class="text-gray-500 font-medium text-sm">Nama</label>
                                    <div class="relative">
                                        <i class="fa fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input wire:model="name" placeholder="Masukkan Nama" type="text" name="name"
                                            id="name"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="name">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="text-gray-500 font-medium text-sm">Email</label>
                                    <div class="relative">
                                        <i
                                            class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input wire:model="email" placeholder="Masukkan Email" type="email" name="email"
                                            id="email"
                                            class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="email">
                                    </div>
                                </div>

                                <!-- Username -->
                                {{-- <div>
                                    <label for="username" class="text-gray-500 font-medium text-sm">Username</label>
                                    <div class="relative">
                                        <i class="fa fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input placeholder="Username Akan Diisi Otomatis" type="text" name="username"
                                            id="username"
                                            class="text-sm w-full h-14 pl-12 text-gray-400 placeholder:text-gray-300 border bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="username" readonly>
                                    </div>
                                </div> --}}

                                <!-- Password -->
                                <div>
                                    <label for="password" class="text-gray-500 font-medium text-sm">Password</label>
                                    <div class="relative">
                                        <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input wire:model="password" placeholder="Masukkan Password" type="password"
                                            name="password" id="password"
                                            class="text-sm w-full h-14 pl-12 pr-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off">
                                        <i
                                            class="fa fa-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 cursor-pointer togglePassword"></i>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="text-gray-500 font-medium text-sm">Konfirmasi
                                        Password</label>
                                    <div class="relative">
                                        <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <input wire:model="password_confirmation" placeholder="Konfirmasi Password"
                                            type="password" name="password_confirmation" id="password_confirmation"
                                            class="text-sm w-full h-14 pl-12 pr-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off">
                                        <i
                                            class="fa fa-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 cursor-pointer togglePassword"></i>
                                    </div>
                                </div>

                                <!-- Role -->
                                <div>
                                    <label for="role" class="text-gray-500 font-medium text-sm">Pilih Role</label>
                                    <div class="relative">
                                        <i
                                            class="fa fa-user-shield absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                        <select placeholder="Pilih Role Anda" type="select" name="role" id="role"
                                            class="text-sm w-full h-14 pl-12 pr-12 text-gray-300 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required autocomplete="off"
                                            onchange="this.classList.remove('text-gray-300'); this.classList.add('text-gray-700');">
                                            <option value="" disabled selected>Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="panitia">Panitia</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Register Admin Button -->
                                <div class="mt-6 w-full flex flex-column gap-4">
                                    <a href="{{ route('admin.mgmt') }}" class="mt-8 w-full px-6 py-4 bg-gray-400/80 hover:bg-gray-500/80 text-white rounded-xl transition-colors flex items-center justify-center gap-3">
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
