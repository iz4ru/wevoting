@extends('admin.layouts.app')

@section('title', 'Update Password Admin')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Update Password Admin atau Panitia</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Perbarui informasi password admin atau panitia yang terdaftar dalam sistem.</p>
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
                        <li>Password tidak kurang dari 8 karakter.</li>
                    </ul>

                    <!-- Form Ganti Password -->
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

                        <form wire:submit="updatePassword" action="{{ route('admin.mgmt.change_password', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">

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

                                <!-- Update Admin Button -->
                                <div class="mt-6">
                                    <button type="submit"
                                        class="mt-8 w-full px-6 py-4 bg-[#7C3AED] hover:bg-[#6D31D5] text-white rounded-xl transition-colors flex items-center justify-center gap-3">
                                        <span class="font-semibold">Update Data Admin</span>
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endsection
