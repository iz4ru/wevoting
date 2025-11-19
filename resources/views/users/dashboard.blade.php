@extends('users.layouts.app')

@section('title', 'Dasbor Utama')

@section('content')
    <div class="flex-1 overflow-y-auto lg:px-8 lg:py-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg lg:rounded-xl shadow-lg lg:p-6">
                <div class="bg-[#FFD164]/20 rounded-lg shadow-lg p-6 flex flex-row items-center gap-6">
                    <div class="flex items-center justify-center rounded-full">
                        <i class="fa fa-user-circle fa-2xl" aria-hidden="true" style="color: #C78D04"></i>
                    </div>
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#C78D04] mb-2">Selamat Datang,
                            {{ Auth::check() ? Auth::user()->name : '' }}!</h1>
                        <p class="text-sm text-[#C78D04] lg:text-base">Silahkan pilihlah kandidat yang menurut kamu cocok
                            untuk menjadi pemimpin yang baru!
                        </p>
                    </div>
                </div>
                <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-8 mx-6">

                <!-- Alerts -->
                @if (session('success'))
                    <div class="alert alert-success py-2 px-4 mb-8 bg-green-100 text-green-500 border border-green-500 rounded-md"
                        role="alert" id="successAlert" x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error py-2 px-4 mb-8 bg-red-100 text-red-500 border border-red-500 rounded-md"
                        role="alert" id="errorAlert" x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <div class="overflow-x-auto text-sm">

                    @if ($candidates->count() <= 0)
                        <div class="flex items-center justify-center">
                            <p>Tidak ada data yang ditemukan.</p>
                        </div>
                    @endif

                    <!-- Desktop Grid View -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                        @foreach ($candidates as $candidate)
                            <div class="bg-white rounded-xl shadow-lg p-6">
                                <div class="flex justify-center items-center">
                                    <div class="flex flex-col">
                                        <!-- Candidate Name and Position -->
                                        <div class="text-center">
                                            <h3 class="text-xl my-1 font-bold text-gray-700">{{ $candidate->name }}</h3>
                                            <p class="text-gray-700 text-base">{{ $candidate->position->position_name }}
                                            </p>
                                        </div>
                                        <!-- Image -->
                                        <div
                                            class="relative items-center justify-center my-4 bg-[#FFB300]/10 hover:bg-[#FFB300]/20 backdrop-blur-lg rounded-md transform transition ease-in-out">
                                            <img src="{{ Storage::url('images/' . $candidate->image) }}"
                                                class="w-[240px] h-[240px] object-cover rounded-lg border border-gray-300 shadow-sm"
                                                alt="">
                                        </div>
                                        <!-- Action Buttons -->
                                        <div class="grid grid-rows-2 gap-1">
                                            <div x-data="{ open: false }" class="relative">
                                                <button @click="open = true"
                                                    class= "w-full bg-[#22A06B]/20 hover:bg-[#22A06B] text-[#22A06B] hover:text-white backdrop-blur-lg shadow-md rounded-md p-3 flex items-center justify-center gap-2 transform transition ease-in-out">
                                                    <i class="fa-solid fa-circle-check fa-lg lg:fa-xl"></i>
                                                    <span class="text-sm font-semibold">Pilih Kandidat</span>
                                                </button>
                                                <div x-show="open" x-cloak
                                                    class="fixed top-0 left-0 w-full h-full inset-0 bg-black/20 rounded-xl flex justify-center items-center z-50">
                                                </div>
                                                <div x-show="open"
                                                    x-transition:enter="transition ease-out duration-100 transform"
                                                    x-transition:enter-start="opacity-0 scale-95"
                                                    x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75 transform"
                                                    x-transition:leave-start="opacity-100 scale-100"
                                                    x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
                                                    x-cloak
                                                    class="fixed top-0 left-0 w-full h-full rounded-xl flex justify-center items-center z-50">
                                                    <div
                                                        class="p-6 w-[90%] max-w-[540px] bg-white/90 backdrop-blur-lg border-gray-200 rounded-lg shadow-lg items-center justify-center">
                                                        <div class= "bg-[#22A06B]/20 backdrop-blur-lg py-2 rounded-lg">
                                                            <h2
                                                                class="mb-2 text-xl font-bold text-[#22A06B] text-center px-4 translate-y-1">
                                                                Konfirmasi Pilihan</h2>
                                                        </div>
                                                        <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-4 mx-full">
                                                        <p class="mb-6 font-medium text-gray-600 text-center">Yakin untuk
                                                            memilih kandidat ini? <br> Saat ini memilih kandidat:
                                                            <br><span
                                                                class="font-semibold text-[#4F22AA]">({{ $candidate->name }},
                                                                {{ $candidate->position->position_name }})</span>
                                                        </p>
                                                        <form action="{{ route('voter.voting') }}" method="POST">
                                                            @csrf

                                                            <input type="hidden" name="candidate_id"
                                                                value="{{ $candidate->id }}">

                                                            <div class="flex flex-row gap-2 justify-between">
                                                                <button type="button" @click="open = false"
                                                                    class="px-5 py-2.5 bg-gray-400 rounded-lg">
                                                                    <span class="text-white font-semibold">Kembali</span>
                                                                </button>
                                                                <button type="submit"
                                                                    class="px-5 py-2.5 bg-[#22A06B] rounded-lg">
                                                                    <span
                                                                        class="text-[white] font-semibold">Konfirmasi</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
