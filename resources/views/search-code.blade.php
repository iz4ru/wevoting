<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lexend:400,600,700,800&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

        .modal-backdrop {
            backdrop-filter: blur(4px);
        }

        /* Progress bar animation */
        @keyframes shrink {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>
    @livewireStyles
    @livewireScripts

    <!-- Script JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- PWA  -->
    <meta name="theme-color" content="#4F22AA" />
    <link rel="apple-touch-icon" href="{{ asset('images/icons/icon-192x192.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <title>Cari Kode Akses - Wevoting</title>
</head>

<body class="bg-[#FAFAFA] overflow-x-hidden">
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col max-w-full">
        <!-- Navbar -->
        <nav
            class="fixed top-0 left-0 w-full bg-white/30 backdrop-blur-lg px-4 py-4 flex justify-between items-center shadow-lg z-50
            lg:top-5 lg:left-1/2 lg:-translate-x-1/2 lg:w-11/12 lg:max-w-7xl lg:rounded-2xl lg:px-8 lg:py-5 lg:transform">
            <!-- Logo -->
            <div class="flex items-center">
                <i class="fa-solid fa-check-to-slot fa-xl sm:fa-2xl px-2" style="color: #4F22AA;"></i>
                <span class="text-[#4F22AA] text-secondary font-bold text-xl sm:text-2xl ml-2">WEVOTING</span>
            </div>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="w-10 h-10 overflow-hidden">
                    <i class="fa-solid fa-bars text-gray-600 hover:text-gray-800 text-xl"></i>
                </button>
                <!-- Dropdown Menu -->
                <div x-show="open" x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    @click.away="open = false" x-cloak
                    class="absolute right-0 w-48 bg-[#FAFAFA] shadow-lg rounded-lg p-2 z-50 transition transisiton-transform duration-300 ease-in-out">
                    <div class="">
                        <a href="/"
                            class="flex items-center gap-4 w-full rounded-md px-4 py-2 text-gray-500 hover:bg-gray-200">
                            <i class="fa-solid fa-home text-gray-500 text-md"></i>
                            <span>Beranda</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Search Section -->
        <section class="my-20 pt-16 pb-12">
            <div class="px-4 md:max-w-4xl mx-auto w-full">
                <!-- Header -->
                <div class="text-center mb-12 px-4">
                    <div class="inline-block mb-4">
                        <i class="fa-solid fa-id-card fa-3xl text-[#4F22AA]"></i>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">
                        Cari Kode Akses Anda
                    </h1>
                    <p class="text-gray-500 text-base max-w-2xl mx-auto">
                        Masukkan NIS / NO ID / NIP Anda untuk menemukan kode akses voting. Pastikan nomor identitas yang
                        dimasukkan sesuai dengan data yang terdaftar.
                    </p>
                </div>

                <!-- Search Form -->
                <div class="max-w-2xl mx-auto" x-data="searchCode()">
                    <div class="bg-white rounded-2xl shadow-xl p-6 lg:p-8">
                        <!-- Search Input -->
                        <form @submit.prevent="searchByNIS" x-show="!showResult" x-cloak>
                            <div class="relative mb-6">
                                <label for="nis" class="block text-sm font-semibold text-[#411C8C] mb-2">
                                    NIS / NO ID / NIP
                                </label>
                                <div class="relative">
                                    <input type="text" id="nis" x-model="nisInput" required
                                        placeholder="Contoh: 12345678"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-base border border-[#926AE1]/30 rounded-xl px-5 py-4 pr-12 transition duration-300 ease focus:outline-none focus:border-[#4F22AA] focus:ring-2 focus:ring-[#4F22AA]/20 hover:border-[#926AE1]/50 shadow-sm" />
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                        <i class="fa-solid fa-id-card text-[#926AE1]"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    <i class="fa-solid fa-circle-info text-[#4F22AA]"></i>
                                    Masukkan nomor identitas Anda dengan lengkap
                                </p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" :disabled="isLoading"
                                class="w-full bg-[#612AD0] text-white px-6 py-4 rounded-xl font-bold hover:bg-[#4F22AA] transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                                <template x-if="!isLoading">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        Cari Kode Akses
                                    </span>
                                </template>
                                <template x-if="isLoading">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-spinner fa-spin"></i>
                                        Mencari...
                                    </span>
                                </template>
                            </button>
                        </form>

                        <!-- Error Message -->
                        <div x-show="errorMessage" x-cloak class="mt-6 bg-red-50 border border-red-200 rounded-xl p-4">
                            <div class="flex items-center gap-3 text-red-700">
                                <i class="fa-solid fa-circle-exclamation text-xl"></i>
                                <p class="font-semibold" x-text="errorMessage"></p>
                            </div>
                        </div>

                        <!-- Result Display (After Confirmation) -->
                        <div x-show="showResult && voterData" x-cloak class="space-y-6">
                            <!-- Success Header -->
                            <div class="text-center">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                                    <i class="fa-solid fa-circle-check fa-2xl text-green-600"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-[#411C8C] mb-2">Kode Akses Ditemukan!</h2>
                                <p class="text-gray-500">Berikut adalah kode akses Anda untuk melakukan voting</p>
                            </div>

                            <!-- Voter Information Card -->
                            <div
                                class="bg-gradient-to-br from-[#4F22AA] to-[#612AD0] rounded-2xl p-6 text-white shadow-xl">
                                <div class="space-y-4">
                                    <!-- Name -->
                                    <div class="flex items-start gap-3">
                                        <i class="fa-solid fa-user text-xl mt-1"></i>
                                        <div>
                                            <p class="text-sm text-white/80">Nama Lengkap</p>
                                            <p class="text-lg font-bold" x-text="voterData.name"></p>
                                        </div>
                                    </div>

                                    <!-- NIS -->
                                    <div class="flex items-start gap-3">
                                        <i class="fa-solid fa-id-card text-xl mt-1"></i>
                                        <div>
                                            <p class="text-sm text-white/80">NIS / NO ID / NIP</p>
                                            <p class="text-lg font-bold" x-text="voterData.user_id"></p>
                                        </div>
                                    </div>

                                    <!-- Class -->
                                    <div class="flex items-start gap-3">
                                        <i class="fa-solid fa-school text-xl mt-1"></i>
                                        <div>
                                            <p class="text-sm text-white/80">Kelas</p>
                                            <p class="text-lg font-bold" x-text="voterData.class"></p>
                                        </div>
                                    </div>

                                    <!-- Vocation -->
                                    <div class="flex items-start gap-3">
                                        <i class="fa-solid fa-graduation-cap text-xl mt-1"></i>
                                        <div>
                                            <p class="text-sm text-white/80">Jurusan / Bidang</p>
                                            <p class="text-lg font-bold" x-text="voterData.vocation"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Access Code Display -->
                            <div
                                class="bg-gradient-to-br from-[#926AE1]/10 to-[#926AE1]/5 rounded-2xl p-8 border-2 border-[#926AE1]/30">
                                <div class="text-center">
                                    <p class="text-sm font-semibold text-[#411C8C] mb-3">KODE AKSES ANDA</p>
                                    <div class="bg-white rounded-xl px-8 py-6 mb-4 shadow-inner">
                                        <p class="text-4xl font-bold text-[#4F22AA] tracking-widest"
                                            x-text="voterData.access_code"></p>
                                    </div>
                                    <div x-data="{ copied: false }">
                                        <button
                                            @click="copied = true; copyCode(voterData.access_code); setTimeout(() => copied = false, 3000)"
                                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105"
                                            :class="copied ? 'bg-green-500 hover:bg-green-600 text-white' :
                                                'bg-[#612AD0] hover:bg-[#4F22AA] text-white'">
                                            <i class="fa-solid transition-all duration-300"
                                                :class="copied ? 'fa-check animate-bounce' : 'fa-copy'"></i>
                                            <span x-text="copied ? 'Tersalin!' : 'Salin Kode Akses'"></span>
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button @click="resetSearch"
                                    class="flex-1 bg-white text-[#4F22AA] px-6 py-4 rounded-xl text-center font-bold hover:bg-gray-50 transition-colors flex items-center justify-center gap-2 border-2 border-[#926AE1]/30">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    <span>Cari Lagi</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div
                        class="mt-6 bg-gradient-to-r from-[#926AE1]/10 to-[#926AE1]/5 rounded-xl p-5 border border-[#926AE1]/20">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-info text-[#4F22AA] text-xl mt-1"></i>
                            <div class="flex-1">
                                <h4 class="font-semibold text-[#411C8C] mb-2">Informasi Penting</h4>
                                <ul class="space-y-1 text-sm text-gray-600">
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check text-[#4F22AA] text-xs mt-1"></i>
                                        <span>Kode akses bersifat rahasia dan personal</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check text-[#4F22AA] text-xs mt-1"></i>
                                        <span>Jangan bagikan kode akses kepada orang lain</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check text-[#4F22AA] text-xs mt-1"></i>
                                        <span>Gunakan kode akses untuk login dan voting</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check text-[#4F22AA] text-xs mt-1"></i>
                                        <span>Pastikan NIS/NO ID/NIP yang dimasukkan benar</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Home Button -->
                    <div class="mt-8 flex justify-center" x-show="!showResult">
                        <a href="/"
                            class="bg-white text-[#4F22AA] px-8 py-4 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors flex items-center justify-center gap-2 border-2 border-[#926AE1]/30">
                            <i class="fa-solid fa-home"></i>
                            <span>Kembali ke Beranda</span>
                        </a>
                    </div>

                    <!-- Confirmation Modal -->
                    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
                        @keydown.escape.window="cancelConfirmation">
                        <!-- Backdrop -->
                        <div class="fixed inset-0 bg-black/50 modal-backdrop transition-opacity" x-show="showModal"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            @click="cancelConfirmation">
                        </div>

                        <!-- Modal Content -->
                        <div class="flex min-h-screen items-center justify-center p-4">
                            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full mx-auto"
                                x-show="showModal" x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95">

                                <!-- Modal Header -->
                                <div
                                    class="bg-gradient-to-br from-[#4F22AA] to-[#612AD0] text-white p-6 rounded-t-2xl">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-circle-question fa-2xl"></i>
                                        <h3 class="text-xl font-bold">Konfirmasi Identitas</h3>
                                    </div>
                                </div>

                                <!-- Modal Body -->
                                <div class="p-6">
                                    <p class="text-gray-600 mb-4">Apakah benar nama yang mengakses atas nama:</p>

                                    <div
                                        class="bg-gradient-to-br from-[#926AE1]/10 to-[#926AE1]/5 rounded-xl p-6 mb-6 border-2 border-[#926AE1]/30">
                                        <div class="text-center">
                                            <i class="fa-solid fa-user fa-2xl text-[#4F22AA] mb-4"></i>
                                            <p class="text-2xl font-bold text-[#411C8C] mt-4" x-text="tempVoterData?.name">
                                            </p>
                                            <p class="text-sm text-gray-500 mt-2">NIS / NO ID / NIP: <span
                                                    x-text="tempVoterData?.user_id"></span></p>
                                        </div>
                                    </div>

                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                        <div class="flex gap-3">
                                            <i
                                                class="fa-solid fa-triangle-exclamation text-yellow-600 text-lg mt-1"></i>
                                            <p class="text-sm text-yellow-800">
                                                Pastikan nama di atas adalah nama Anda sebelum melanjutkan. Jika bukan,
                                                silakan cari kembali dengan NIS / NO ID / NIP yang benar.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Modal Actions -->
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        <button @click="confirmIdentity"
                                            class="flex-1 bg-[#612AD0] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#4F22AA] transition-colors flex items-center justify-center gap-2 shadow-lg">
                                            <i class="fa-solid fa-check"></i>
                                            <span>Ya, Benar</span>
                                        </button>
                                        <button @click="cancelConfirmation"
                                            class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-300 transition-colors flex items-center justify-center gap-2">
                                            <i class="fa-solid fa-xmark"></i>
                                            <span>Bukan Saya</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer
            class="mt-auto shadow-lg sm:flex sm:items-center sm:justify-center p-4 sm:p-6 xl:p-4 text-[#411C8C] gap-2 antialiased">
            <p class="mb-4 text-sm text-center text-[#411C8C] sm:mb-0">
                &copy; <a href="/" class="hover:underline">Wevoting</a> 2025 by iz4ru
            </p>
            <div class="flex justify-center items-center space-x-1">
                <a href="https://github.com/iz4ru" data-tooltip-target="tooltip-github"
                    class="inline-flex justify-center p-2 text-[#411C8C] rounded-lg cursor-pointer hover:text-white hover:bg-[#411C8C] transition-colors"
                    target="_blank">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Github</span>
                </a>
            </div>
        </footer>
    </div>

    <!-- Alpine.js Component -->
    <script>
        function searchCode() {
            return {
                nisInput: '',
                isLoading: false,
                showModal: false,
                showResult: false,
                tempVoterData: null,
                voterData: null,
                errorMessage: '',

                // Toast notification state
                toasts: [],

                async searchByNIS() {
                    this.errorMessage = '';
                    this.isLoading = true;

                    try {
                        const response = await fetch(`/api/search-voter?user_id=${encodeURIComponent(this.nisInput)}`);

                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        const data = await response.json();

                        if (data.success) {
                            this.tempVoterData = data.voter;
                            this.showModal = true;
                        } else {
                            this.errorMessage = data.message ||
                                'Data tidak ditemukan. Pastikan NIS/NO ID/NIP yang Anda masukkan benar.';
                        }
                    } catch (error) {
                        console.error('Error searching:', error);
                        this.errorMessage = 'Terjadi kesalahan saat mencari data. Silakan coba lagi.';
                    } finally {
                        this.isLoading = false;
                    }
                },

                confirmIdentity() {
                    this.voterData = this.tempVoterData;
                    this.showModal = false;
                    this.showResult = true;
                    this.tempVoterData = null;
                },

                cancelConfirmation() {
                    this.showModal = false;
                    this.tempVoterData = null;
                    this.nisInput = '';
                    this.errorMessage = 'Silakan coba masukkan NIS/NO ID/NIP yang benar.';
                },

                resetSearch() {
                    this.nisInput = '';
                    this.voterData = null;
                    this.showResult = false;
                    this.errorMessage = '';
                },

                // Copy function dengan toast notification
                async copyCode(code) {
                    try {
                        await navigator.clipboard.writeText(code);
                        this.showToast('success', 'Kode akses sudah disalin!', 'Kode berhasil disalin ke clipboard');
                    } catch (err) {
                        console.error('Failed to copy:', err);
                        this.copyCodeFallback(code);
                    }
                },

                copyCodeFallback(code) {
                    try {
                        const textarea = document.createElement('textarea');
                        textarea.value = code;
                        textarea.style.position = 'fixed';
                        textarea.style.opacity = '0';
                        document.body.appendChild(textarea);
                        textarea.select();
                        textarea.setSelectionRange(0, 99999);

                        const successful = document.execCommand('copy');
                        document.body.removeChild(textarea);

                        if (successful) {
                            this.showToast('success', 'Kode akses sudah disalin!', 'Kode berhasil disalin ke clipboard');
                        } else {
                            this.showToast('error', 'Gagal menyalin!', 'Silakan salin kode secara manual');
                        }
                    } catch (err) {
                        this.showToast('error', 'Gagal menyalin!', 'Silakan salin kode secara manual');
                    }
                },

                // Toast notification system
                showToast(type, title, message) {
                    const id = Date.now();
                    const toast = {
                        id: id,
                        type: type,
                        title: title,
                        message: message,
                        show: true
                    };

                    this.toasts.push(toast);

                    // Auto remove after 3 seconds
                    setTimeout(() => {
                        this.removeToast(id);
                    }, 3000);
                },

                removeToast(id) {
                    const index = this.toasts.findIndex(toast => toast.id === id);
                    if (index > -1) {
                        this.toasts[index].show = false;
                        setTimeout(() => {
                            this.toasts.splice(index, 1);
                        }, 300);
                    }
                }
            }
        }

        // Register service worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js')
                .then(function(registration) {
                    console.log('Service Worker registered!', registration.scope);
                })
                .catch(function(error) {
                    console.log('Service Worker registration failed:', error);
                });
        }
    </script>

    <!-- Toast Notification Container -->
    <div x-data="searchCode()" class="fixed top-20 right-4 z-[60] space-y-3 max-w-sm w-full pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="toast.show" x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0" class="pointer-events-auto">

                <!-- Success Toast -->
                <div x-show="toast.type === 'success'"
                    class="bg-white border border-green-200 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-check text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-green-800" x-text="toast.title"></h4>
                            <p class="text-xs text-green-600 mt-1" x-text="toast.message"></p>
                        </div>
                        <button @click="removeToast(toast.id)"
                            class="flex-shrink-0 text-green-400 hover:text-green-600 transition-colors">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>
                    <!-- Progress Bar -->
                    <div class="h-1 bg-green-200">
                        <div class="h-full bg-green-500 animate-[shrink_3s_linear]"></div>
                    </div>
                </div>

                <!-- Error Toast -->
                <div x-show="toast.type === 'error'"
                    class="bg-white border border-red-200 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-xmark text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-red-800" x-text="toast.title"></h4>
                            <p class="text-xs text-red-600 mt-1" x-text="toast.message"></p>
                        </div>
                        <button @click="removeToast(toast.id)"
                            class="flex-shrink-0 text-red-400 hover:text-red-600 transition-colors">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>
                    <div class="h-1 bg-red-200">
                        <div class="h-full bg-red-500 animate-[shrink_3s_linear]"></div>
                    </div>
                </div>
            </div>
        </template>
    </div>


</body>

</html>
