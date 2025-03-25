<!DOCTYPE html>
<html lang="en">

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

    <title>Wevoting</title>
</head>

<body class="bg-[#FAFAFA] overflow-x-hidden">
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col max-w-full">
        <!-- Navbar -->
        <nav
            class="fixed left-0 w-full sm:top-5 sm:left-1/2 sm:transform sm:-translate-x-1/2 sm:w-11/12 sm:max-w-7xl bg-white/30 backdrop-blur-lg sm:rounded-2xl px-4 sm:px-8 py-5 sm:py-4 flex justify-between items-center shadow-lg z-50">
            <!-- Logo -->
            <div class="flex items-center">
                <i class="fa-solid fa-check-to-slot fa-xl sm:fa-2xl px-2" style="color: #4F22AA;"></i>
                <span class="text-[#4F22AA] text-secondary font-bold text-xl sm:text-2xl ml-2">WEVOTING</span>
            </div>

            <!-- Navigation Button Group -->
            <div class="flex gap-2 sm:gap-4">
                <a href="#candidate"
                    class="button bg-[#E3E3E3] text-[#323A43] backdrop-blur-lg px-6 sm:px-8 py-3 sm:py-3 rounded-md text-xs sm:text-sm font-normal hover:bg-[#d6d6d6] transition-colors">Kandidat</a>
                <a href="/login-user"
                    class="button bg-[#612AD0] text-[#FAFAFA] px-6 sm:px-8 py-3 sm:py-3 rounded-md text-xs sm:text-sm font-bold hover:bg-[#4F22AA] transition-colors flex items-center gap-1 sm:gap-2">
                    Masuk
                    <i class="fa-solid fa-chevron-right fa-xs sm:fa-sm"></i>
                </a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="hero" class="py-20 overflow-hidden">
            <div class="px-4 md:max-w-7xl mx-auto w-full">
                <div
                    class="flex flex-col px-4 lg:flex-row items-center justify-between gap-12 lg:translate-x-12 transition-transform duration-500 ease-in-out">
                    <!-- Left Content -->
                    <div class="lg:max-w-[600px] py-8">
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-700 leading-tight">
                            Bersuara Itu Hak,<br />
                        </h1>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-700 leading-tight mb-4">
                            <span class="text-[#4F22AA]">Wevoting</span> Bikin Makin<br />
                            Gampang!
                        </h1>
                        <p class="text-gray-500 text-lg leading-relaxed">
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

        <!-- Candidate Section -->
        <section id="candidate">
            <div class="lg:py-8">
                <div class="max-w-6xl mx-auto px-4">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mt-6 mb-2">Pilih Kandidat Terbaikmu!</h2>
                        <p class="text-gray-600">
                            Gunakan hak suaramu untuk memilih pemimpin yang tepat. <br>
                            Cermati, telusuri, dan berikan suaramu dengan mudah lewat Wevoting!
                        </p>
                    </div>

                    <!-- Mobile & Desktop Swiper View -->
                    <div class="candidate-swiper-container" x-data="candidateCarousel()">
                        <!-- Swiper Container -->
                        <div class="w-full mx-auto relative candidate-swiper" x-ref="candidateSwiper">
                            <!-- Swiper Wrapper -->
                            <div class="swiper-wrapper">
                                @foreach ($candidates as $candidate)
                                    <div class="swiper-slide h-auto">
                                        <div class="bg-[#F1F1F1] bg-opacity-40 rounded-lg shadow-lg p-6">
                                            <div class="flex flex-col items-center gap-2">
                                                <!-- Candidate Position -->
                                                <div
                                                    class="bg-[#926AE1] bg-opacity-20 text-[#FAFAFA] px-16 py-2 rounded-md text-sm font-bold transition-colors flex items-center gap-2 mb-4">
                                                    <h3 class="text-xl font-semibold text-[#411C8C]">
                                                        {{ $candidate->position->position_name }}</h3>
                                                </div>
                                                <!-- Candidate Image -->
                                                <div
                                                    class="relative items-center justify-center my-4 bg-[#926AE1]/10 hover:bg-[#926AE1]/20 backdrop-blur-lg rounded-md transform transition ease-in-out">
                                                    <img src="{{ Storage::url('images/' . $candidate->image) }}"
                                                        class="w-[240px] h-[240px] lg:w-[360px] lg:h-[360px] object-cover rounded-lg border border-gray-300 shadow-sm"
                                                        alt="{{ $candidate->name }}">
                                                </div>
                                                <!-- Candidate Name -->
                                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                                    {{ $candidate->name }}</h3>

                                                <!-- Collapsible Content Sections -->
                                                <div class="space-y-4 w-full">
                                                    <!-- Visi -->
                                                    <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-4">
                                                        <div class="text-[#411C8C]">
                                                            <h3 class="font-semibold uppercase mb-2">Visi</h3>
                                                            <p class="text-content whitespace-pre-line"
                                                                id="vision-text-{{ $candidate->id }}">
                                                                {{ Str::limit($candidate->vision, 255, '...') }}
                                                            </p>
                                                            <p class="text-content hidden whitespace-pre-line"
                                                                id="vision-text-full-{{ $candidate->id }}">
                                                                {{ $candidate->vision }}
                                                            </p>
                                                            <button
                                                                class="toggle-button text-[#1D7AFC] hover:underline mt-2"
                                                                data-short="vision-text-{{ $candidate->id }}"
                                                                data-full="vision-text-full-{{ $candidate->id }}">
                                                                Lihat Selengkapnya
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Misi -->
                                                    <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-4">
                                                        <div class="text-[#411C8C]">
                                                            <h3 class="font-semibold uppercase mb-2">Misi</h3>
                                                            <p class="text-content whitespace-pre-line"
                                                                id="mission-text-{{ $candidate->id }}">
                                                                {{ Str::limit($candidate->mission, 255, '...') }}
                                                            </p>
                                                            <p class="text-content hidden whitespace-pre-line"
                                                                id="mission-text-full-{{ $candidate->id }}">
                                                                {{ $candidate->mission }}
                                                            </p>
                                                            <button
                                                                class="toggle-button text-[#1D7AFC] hover:underline mt-2"
                                                                data-short="mission-text-{{ $candidate->id }}"
                                                                data-full="mission-text-full-{{ $candidate->id }}">
                                                                Lihat Selengkapnya
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Program Kerja -->
                                                    <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-4">
                                                        <div class="text-[#411C8C]">
                                                            <h3 class="font-semibold uppercase mb-2">Program Kerja
                                                            </h3>
                                                            <p class="text-content whitespace-pre-line"
                                                                id="work-text-{{ $candidate->id }}">
                                                                {{ Str::limit($candidate->work_program, 255, '...') }}
                                                            </p>
                                                            <p class="text-content hidden whitespace-pre-line"
                                                                id="work-text-full-{{ $candidate->id }}">
                                                                {{ $candidate->work_program }}
                                                            </p>
                                                            <button
                                                                class="toggle-button text-[#1D7AFC] hover:underline mt-2"
                                                                data-short="work-text-{{ $candidate->id }}"
                                                                data-full="work-text-full-{{ $candidate->id }}">
                                                                Lihat Selengkapnya
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Video Section -->
                                                <div class="mt-6 w-full">
                                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Video Kampanye
                                                    </h3>
                                                    @if (!empty($candidate->video_link) && filter_var($candidate->video_link, FILTER_VALIDATE_URL))
                                                        <iframe src="{{ $candidate->video_link }}" frameborder="0"
                                                            class="w-full aspect-video bg-gray-200 rounded-lg flex items-center justify-center">
                                                        </iframe>
                                                    @else
                                                        <div
                                                            class="w-full aspect-video bg-gray-200 rounded-lg flex items-center justify-center text-gray-600">
                                                            <p>Maaf, Video Sedang Tidak Tersedia</p>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Pagination -->
                            <div class="swiper-pagination relative mt-4"></div>
                            <!-- Custom Navigation Buttons -->
                            <div
                                class="custom-swiper-button-prev absolute left-0 top-1/2 transform -translate-y-1/2 z-10 text-[#4F22AA] w-10 h-10 rounded-full flex items-center justify-center cursor-pointer">
                                <i class="fa-solid fa-chevron-left"></i>
                            </div>
                            <div
                                class="custom-swiper-button-next absolute right-0 top-1/2 transform -translate-y-1/2 z-10 text-[#4F22AA] w-10 h-10 rounded-full flex items-center justify-center cursor-pointer">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
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
                    <div class="max-w-[600px] text-[#411C8C]">
                        <h2 class="text-4xl font-bold mb-4">
                            Sudah Siap Untuk <br />
                            Memberikan Suaramu?
                        </h2>
                        <p class="text-lg">
                            Dengan masuk, kamu bisa memberikan suaramu untuk kandidat
                            yang kamu pilih. Jangan sampai ketinggalan, yuk masuk sekarang!
                        </p>
                    </div>

                    <!-- Button -->
                    <div>
                        <a href="{{ route('voter.login') }}"
                            class="bg-[#612AD0] text-[#FAFAFA] px-12 py-4 rounded-md text-sm font-bold hover:bg-[#4F22AA] transition-colors flex items-center gap-2">
                            Mulai Voting
                            <i class="fa-solid fa-chevron-right fa-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Let Login -->
        <div class="text-[#411C8C] py-12 sm:py-8 ">
            <div class="max-w-4xl mx-auto px-4">
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
</body>

<style>
    /* Enhanced positioning for swiper buttons to appear on sides of candidate images */
    .custom-swiper-button-prev,
    .custom-swiper-button-next {
        position: absolute;
        z-index: 10;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #4F22AA;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .custom-swiper-button-prev:hover,
    .custom-swiper-button-next:hover {
        background-color: #4F22AA;
        color: white;
    }

    /* Position buttons at the image level instead of at the top level */
    .custom-swiper-button-prev {
        left: 35px;
        top: 300px;
        /* This will be adjusted by JS to match image position */
    }

    .custom-swiper-button-next {
        right: 35px;
        top: 300px;
        /* This will be adjusted by JS to match image position */
    }

    /* Maintain responsiveness */
    @media (max-width: 640px) {

        .custom-swiper-button-prev,
        .custom-swiper-button-next {
            width: 35px;
            height: 35px;
            top: 220px;
            /* Adjust for smaller screens */
        }
    }
</style>

<style>
    /* Styling untuk menyembunyikan slide yang tidak aktif */
    .swiper-slide {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    .swiper-slide-active {
        opacity: 1;
        visibility: visible;
    }
</style>

<script>
    function candidateCarousel() {
        return {
            swiper: null,
            init() {
                // Wait for DOM to be fully loaded
                setTimeout(() => {
                    // Initialize Swiper with custom navigation
                    this.swiper = new Swiper(this.$refs.candidateSwiper, {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: true,
                        autoHeight: true,
                        observer: true,
                        observeParents: true,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.custom-swiper-button-next',
                            prevEl: '.custom-swiper-button-prev',
                        },
                        // Disable multiple slides per view
                        breakpoints: {
                            0: {
                                slidesPerView: 1,
                            },
                            640: {
                                slidesPerView: 1,
                            },
                            768: {
                                slidesPerView: 1,
                            },
                            1024: {
                                slidesPerView: 1,
                            }
                        },
                        on: {
                            init: function() {
                                // Force update after initialization
                                setTimeout(() => {
                                    this.update();
                                }, 100);
                            },
                            slideChange: function() {
                                // Swiper akan otomatis menambahkan class swiper-slide-active
                                // pada slide yang aktif, dan CSS kita akan menangani visibilitas
                            }
                        }
                    });

                    // Add resize event listener to update swiper
                    window.addEventListener('resize', () => {
                        if (this.swiper) {
                            this.swiper.update();
                        }
                    });
                }, 0);
            }
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan semua tombol "Lihat Selengkapnya"
        const toggleButtons = document.querySelectorAll('.toggle-button');

        // Menambahkan event listener untuk setiap tombol
        toggleButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const shortId = this.getAttribute('data-short');
                const fullId = this.getAttribute('data-full');

                const shortText = document.getElementById(shortId);
                const fullText = document.getElementById(fullId);

                shortText.classList.toggle('hidden');
                fullText.classList.toggle('hidden');

                if (this.innerText === "Lihat Selengkapnya") {
                    this.innerText = "Sembunyikan";
                } else {
                    this.innerText = "Lihat Selengkapnya";
                }
            });
        });
    });
</script>

</html>
