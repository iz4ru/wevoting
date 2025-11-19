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

        .swiper-slide {
            overflow: visible !important;
            height: auto !important;
        }
    </style>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @livewireStyles
    @livewireScripts

    <!-- Script JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Data Tables -->
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- PWA  -->
    <meta name="theme-color" content="#000000" />
    <link rel="apple-touch-icon" href="{{ asset('images/icons/icon-192x192.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <title>Wevoting</title>
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
                        <a href="{{ route('voter.search') }}"
                            class="flex items-center gap-4 w-full rounded-md px-4 py-2 text-gray-500 hover:bg-gray-200">
                            <i class="fa-solid fa-qrcode text-gray-500 text-md"></i>
                            <span>Cari Kode Akses</span>
                        </a>
                    </div>
                    <div class="">
                        <a href="#candidate"
                            class="flex items-center gap-4 w-full rounded-md px-4 py-2 text-gray-500 hover:bg-gray-200">
                            <i class="fa-solid fa-user text-gray-500 text-md"></i>
                            <span>Kandidat</span>
                        </a>
                    </div>
                    {{-- <div class="">
                        <a href="/login-user"
                            class="flex items-center gap-4 w-full rounded-md px-4 py-2 text-gray-500 hover:bg-gray-200">
                            <i class="fa-solid fa-right-from-bracket text-gray-500 text-md"></i>
                            <span>Masuk</span>
                        </a>
                    </div> --}}
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="hero" class="my-20 overflow-hidden">
            <div class="px-4 md:max-w-7xl mx-auto w-full">
                <div
                    class="flex flex-col px-4 lg:flex-row items-center justify-between gap-12 lg:translate-x-12 transition-transform duration-500 ease-in-out">
                    <!-- Left Content -->
                    <div class="lg:max-w-[600px] py-8">
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-700 leading-tight">
                            Bersuara Itu Hak,
                        </h1>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-700 leading-tight mb-4">
                            <span class="text-[#4F22AA]">Wevoting</span> Bikin Makin<br />
                            Gampang!
                        </h1>
                        <p class="text-gray-500 text-base lg:text-lg leading-relaxed">
                            Tidak perlu kertas suara, semua sudah digital! Hemat waktu,<br class="hidden md:block" />
                            lebih cepat, dan lebih terpercaya. 🗳️✅
                        </p>
                    </div>

                    <!-- Right Image -->
                    <div
                        class="lg:flex-1 transform -translate-y-16 lg:translate-y-0 lg:translate-x-0 transition-all duration-500 ease-in-out">
                        <img src="{{ asset('img/voting-illust.png') }}" alt="Ilustrasi voting digital"
                            class="w-full max-w-[600px] mx-auto object-contain" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Candidate Section - Replace your existing candidate section with this -->
        <section id="candidate">

            <!-- Header -->
            @if (count($candidates) == 0)
                <div class="text-center mb-8 max-w-[500px] lg:max-w-[600px] mx-auto px-4">
                    <h2 class="text-2xl font-bold text-gray-800 mt-6 mb-2">Belum Ada Kandidat Tersedia</h2>
                    <p class="text-gray-500">
                        Silakan menunggu informasi lebih lanjut dari kami!
                    </p>
                </div>
            @elseif (count($candidates) >= 1)
                <div class="text-center mb-8 max-w-[500px] lg:max-w-[600px] mx-auto px-4">
                    <h2 class="text-2xl font-bold text-gray-800 mt-6 mb-2">Pilih Kandidat Terbaikmu!</h2>
                    <p class="text-gray-500">
                        Gunakan hak suaramu untuk memilih pemimpin yang tepat.
                        Cermati, telusuri, dan berikan suaramu dengan mudah lewat Wevoting!
                    </p>
                    <div class="mt-4 flex items-center justify-center gap-2 animate-bounce">
                        <span class="text-[#4F22AA] font-semibold animate-pulse">
                            Geser Untuk Melihat Kandidat Lainnya
                        </span>
                        <i class="fa-solid fa-arrows-left-right text-[#4F22AA] text-lg animate-pulse"></i>
                    </div>
                </div>
            @endif

            <div class="max-w-4xl mx-auto px-4">

                <!-- Swiper Container -->
                <div class="candidate-swiper-container" x-data="candidateCarousel()">
                    <div class="w-full mx-auto relative candidate-swiper my-8" x-ref="candidateSwiper">
                        <!-- Swiper Wrapper -->
                        <div class="swiper-wrapper pb-12">
                            @foreach ($candidates as $candidate)
                                <div class="swiper-slide h-auto overflow-visible">
                                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

                                        <!-- Header Section with Gradient -->
                                        <div class="bg-gradient-to-br from-[#4F22AA] to-[#926AE1] p-6 text-center">
                                            <div
                                                class="inline-block bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full mb-3">
                                                <h3 class="text-lg font-bold text-white">
                                                    {{ $candidate->position->position_name }}
                                                </h3>
                                            </div>
                                            <div class="mt-4 mb-16">
                                                <h2 class="text-2xl font-bold text-white mb-2">{{ $candidate->name }}
                                                </h2>
                                            </div>
                                        </div>

                                        <!-- Candidate Image - Circular with border -->
                                        <div class="relative -mt-16 mb-6">
                                            <div
                                                class="w-48 h-48 mx-auto rounded-full border-4 border-white shadow-xl overflow-hidden bg-gradient-to-br from-[#926AE1]/10 to-[#926AE1]/20">
                                                <img src="{{ Storage::url('images/' . $candidate->image) }}"
                                                    class="w-full h-full object-cover" alt="{{ $candidate->name }}">
                                            </div>
                                        </div>

                                        <!-- Video Section -->
                                        <div class="px-6 mb-6">
                                            <h3
                                                class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                                <i class="fa-solid fa-video text-[#4F22AA]"></i>
                                                Video Kampanye
                                            </h3>
                                            @if (!empty($candidate->video_link) && filter_var($candidate->video_link, FILTER_VALIDATE_URL))
                                                <div class="relative rounded-xl overflow-hidden shadow-md">
                                                    <iframe src="{{ $candidate->video_link }}" frameborder="0"
                                                        class="w-full aspect-video"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                            @else
                                                <div
                                                    class="w-full aspect-video bg-gray-200 rounded-xl flex items-center justify-center text-gray-600 shadow-md">
                                                    <div class="text-center">
                                                        <i class="fa-solid fa-video-slash text-4xl mb-2"></i>
                                                        <p>Video Tidak Tersedia</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Accordion Content with Alpine.js -->
                                        <div class="px-6 pb-6 space-y-4" x-data="{ activeTab: null }">

                                            <!-- Visi Accordion -->
                                            <div class="border border-[#926AE1]/30 rounded-xl overflow-hidden transition-all duration-300"
                                                :class="{ 'mt-4': activeTab === 'visi-{{ $candidate->id }}' }">
                                                <button
                                                    @click="activeTab = activeTab === 'visi-{{ $candidate->id }}' ? null : 'visi-{{ $candidate->id }}'; 
                                                    $nextTick(() => $refs.candidateSwiper.swiper.updateAutoHeight())"
                                                    class="w-full px-4 py-3 bg-gradient-to-r from-[#926AE1]/10 to-[#926AE1]/5 flex items-center justify-between hover:from-[#926AE1]/20 hover:to-[#926AE1]/10 transition-all">
                                                    <div class="flex items-center gap-3">
                                                        <i class="fa-solid fa-bullseye text-[#4F22AA]"></i>
                                                        <span class="font-semibold text-[#411C8C]">VISI</span>
                                                    </div>
                                                    <i class="fa-solid fa-chevron-down text-[#4F22AA] transition-transform duration-300"
                                                        :class="{ 'rotate-180': activeTab === 'visi-{{ $candidate->id }}' }"></i>
                                                </button>
                                                <div x-show="activeTab === 'visi-{{ $candidate->id }}'" x-collapse
                                                    class="px-4 py-4 bg-white">
                                                    <div class="scrollable-content">
                                                        <p class="text-[#411C8C] leading-relaxed whitespace-pre-line">
                                                            {{ $candidate->vision }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Misi Accordion -->
                                            <div class="border border-[#926AE1]/30 rounded-xl overflow-hidden transition-all duration-300"
                                                :class="{ 'mt-4': activeTab === 'misi-{{ $candidate->id }}' }">
                                                <button
                                                    @click="activeTab = activeTab === 'misi-{{ $candidate->id }}' ? null : 'misi-{{ $candidate->id }}'; 
                                                    $nextTick(() => $refs.candidateSwiper.swiper.updateAutoHeight())"
                                                    class="w-full px-4 py-3 bg-gradient-to-r from-[#926AE1]/10 to-[#926AE1]/5 flex items-center justify-between hover:from-[#926AE1]/20 hover:to-[#926AE1]/10 transition-all">
                                                    <div class="flex items-center gap-3">
                                                        <i class="fa-solid fa-list-check text-[#4F22AA]"></i>
                                                        <span class="font-semibold text-[#411C8C]">MISI</span>
                                                    </div>
                                                    <i class="fa-solid fa-chevron-down text-[#4F22AA] transition-transform duration-300"
                                                        :class="{ 'rotate-180': activeTab === 'misi-{{ $candidate->id }}' }"></i>
                                                </button>
                                                <div x-show="activeTab === 'misi-{{ $candidate->id }}'" x-collapse
                                                    class="px-4 py-4 bg-white">
                                                    <div class="scrollable-content">
                                                        <p class="text-[#411C8C] leading-relaxed whitespace-pre-line">
                                                            {{ $candidate->mission }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Program Kerja Accordion -->
                                            <div class="border border-[#926AE1]/30 rounded-xl overflow-hidden transition-all duration-300"
                                                :class="{ 'mt-4': activeTab === 'program-{{ $candidate->id }}' }">
                                                <button
                                                    @click="activeTab = activeTab === 'program-{{ $candidate->id }}' ? null : 'program-{{ $candidate->id }}'; 
                                                    $nextTick(() => $refs.candidateSwiper.swiper.updateAutoHeight())"
                                                    class="w-full px-4 py-3 bg-gradient-to-r from-[#926AE1]/10 to-[#926AE1]/5 flex items-center justify-between hover:from-[#926AE1]/20 hover:to-[#926AE1]/10 transition-all">
                                                    <div class="flex items-center gap-3">
                                                        <i class="fa-solid fa-rocket text-[#4F22AA]"></i>
                                                        <span class="font-semibold text-[#411C8C]">PROGRAM KERJA</span>
                                                    </div>
                                                    <i class="fa-solid fa-chevron-down text-[#4F22AA] transition-transform duration-300"
                                                        :class="{ 'rotate-180': activeTab === 'program-{{ $candidate->id }}' }"></i>
                                                </button>
                                                <div x-show="activeTab === 'program-{{ $candidate->id }}'" x-collapse
                                                    class="px-4 py-4 bg-white">
                                                    <div class="scrollable-content">
                                                        <p class="text-[#411C8C] leading-relaxed whitespace-pre-line">
                                                            {{ $candidate->work_program }}</p>
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
        </section>

        <!-- User Let Login -->
        <div class="bg-[#926AE1] bg-opacity-25 text-white py-12 sm:py-16">
            <div class="max-w-4xl mx-auto px-4">
                <div class="flex flex-col items-center text-center gap-8">
                    <!-- Content -->
                    <div class="max-w-[400px] text-[#411C8C]">
                        <h2 class="text-2xl font-bold mb-4">
                            Sudah Siap Untuk
                            Memberikan Suaramu?
                        </h2>
                        <p>
                            Dengan masuk, kamu bisa memberikan suaramu untuk kandidat
                            yang kamu pilih. Jangan sampai ketinggalan, yuk masuk sekarang!
                        </p>
                    </div>

                    <!-- Button -->
                    <div>
                        <a href="#candidate"
                            class="bg-[#612AD0] text-[#FAFAFA] px-12 py-4 rounded-md text-sm font-bold hover:bg-[#4F22AA] transition-colors flex items-center gap-2">
                            Mulai Voting
                            <i class="fa-solid fa-chevron-right fa-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Let Login -->
        <div class="text-[#411C8C]">
            <div class="max-w-4xl mx-auto mt-8">
                <div class="flex flex-col items-center text-center gap-8">
                    <!-- Content -->
                    <div
                        class="max-w-[600px] bg-[#926AE1] hover:bg-[#612AD0] bg-opacity-20 hover:text-[#FAFAFA] text-[#411C8C] rounded-lg transform transition ease-in-out">
                        <a href="#hero" class="text-sm flex items-center px-8 py-4 gap-2">
                            Kembali ke Atas
                            <i class="fa-solid fa-arrow-up fa-xs" style="color: #411C8C hover:#FAFAFA;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <footer
            class="shadow-lg sm:flex sm:items-center sm:justify-center p-4 sm:p-6 xl:p-4 text-[#411C8C] gap-2 antialiased">
            <p class="mb-4 text-sm text-center text-[#411C8C] sm:mb-0">
                &copy; <a href="/#hero" class="hover:underline">Wevoting</a> 2025 by iz4ru
            </p>
            <div class="flex justify-center items-center space-x-1">
                <a href="https://github.com/iz4ru" data-tooltip-target="tooltip-github"
                    class="inline-flex justify-center p-2 text-[#411C8C] rounded-lg cursor-pointer dark:hover:text-white hover:text-gray-900 hover:bg-[#411C8C]"
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
    
    <!-- Konten -->
    <script>
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
</body>


<script>
    function candidateCarousel() {
        return {
            swiper: null,
            init() {
                // Wait for DOM to be ready
                this.$nextTick(() => {
                    setTimeout(() => {
                        this.swiper = new Swiper(this.$refs.candidateSwiper, {
                            effect: 'cards',
                            grabCursor: true,
                            centeredSlides: true,
                            slidesPerView: 1,
                            autoHeight: true,
                            cardsEffect: {
                                perSlideRotate: 2,
                                perSlideOffset: 8,
                                slideShadows: true
                            },
                            loop: false,
                            // Responsive breakpoints
                            breakpoints: {
                                // Mobile
                                320: {
                                    cardsEffect: {
                                        perSlideRotate: 2,
                                        perSlideOffset: 8,
                                    }
                                },
                                // Tablet
                                768: {
                                    cardsEffect: {
                                        perSlideRotate: 2,
                                        perSlideOffset: 10,
                                    }
                                },
                                // Desktop
                                1024: {
                                    cardsEffect: {
                                        perSlideRotate: 2,
                                        perSlideOffset: 12,
                                    }
                                }
                            },
                            on: {
                                init: function() {
                                    setTimeout(() => {
                                        this.update();
                                        this.updateAutoHeight();
                                    }, 100);
                                },
                                resize: function() {
                                    this.update();
                                }
                            }
                        });
                    }, 100);
                });
            }
        }
    }
</script>

<style>
    .candidate-swiper-container {
        width: 100%;
        overflow: hidden;
    }

    .candidate-swiper {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .candidate-swiper {
            max-width: 90%;
        }
    }
</style>

</html>
