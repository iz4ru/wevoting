<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lexend:400,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Script JS -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <title>Wevoting</title>
</head>
<body class="bg-[#FAFAFA] overflow-x-hidden">
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col max-w-full">
        <!-- Navbar -->
        <nav class="fixed left-0 w-full sm:top-5 sm:left-1/2 sm:transform sm:-translate-x-1/2 sm:w-11/12 sm:max-w-7xl bg-white/30 backdrop-blur-lg sm:rounded-2xl px-4 sm:px-8 py-5 sm:py-4 flex justify-between items-center shadow-lg z-50">
            <!-- Logo -->
            <div class="flex items-center">
                <i class="fa-solid fa-check-to-slot fa-xl sm:fa-2xl px-2" style="color: #4F22AA;"></i>
                <span class="text-[#4F22AA] text-secondary font-bold text-xl sm:text-2xl ml-2">WEVOTING</span>
            </div>

            <!-- Navigation Button Group -->
            <div class="flex gap-2 sm:gap-4">
                <a href="#candidate" class="button bg-[#E3E3E3] text-[#323A43] backdrop-blur-lg px-6 sm:px-8 py-3 sm:py-3 rounded-md text-xs sm:text-sm font-normal hover:bg-[#d6d6d6] transition-colors">Kandidat</a>
                <a href="/login-user" class="button bg-[#612AD0] text-[#FAFAFA] px-6 sm:px-8 py-3 sm:py-3 rounded-md text-xs sm:text-sm font-bold hover:bg-[#4F22AA] transition-colors flex items-center gap-1 sm:gap-2">
                    Masuk
                    <i class="fa-solid fa-chevron-right fa-xs sm:fa-sm"></i>
                </a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="hero" class="py-20 overflow-hidden">
            <div class="px-4 md:max-w-7xl mx-auto w-full">
                <div class="flex flex-col px-4 lg:flex-row items-center justify-between gap-12 lg:translate-x-12 transition-transform duration-500 ease-in-out">
                    <!-- Left Content -->
                    <div class="lg:max-w-[600px] py-8">
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-700 leading-tight">
                            Bersuara Itu Hak,<br/>
                        </h1>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-700 leading-tight mb-4">
                            <span class="text-[#4F22AA]">Wevoting</span> Bikin Makin<br/>
                            Gampang!
                        </h1>
                        <p class="text-gray-500 text-lg leading-relaxed">
                            Tidak perlu kertas suara, semua sudah digital! Hemat waktu,<br class="hidden md:block"/>
                            lebih cepat, dan lebih terpercaya. 🗳️✅
                        </p>
                    </div>

                    <!-- Right Image -->
                    <div class="lg:flex-1 transform -translate-y-16 lg:translate-y-0 lg:translate-x-0 transition-all duration-500 ease-in-out">
                        <img src="{{ asset('img/voting-illust.png') }}" 
                            alt="Ilustrasi voting digital" 
                            class="w-full max-w-[600px] mx-auto object-contain"/>
                    </div>
                </div>
            </div>
        </section>


    <!-- Candidate Section -->
    <section id="candidate">
        <div class="lg:py-8 -translate-y-16 sm:-translate-y-0">
            <div class="max-w-6xl mx-auto px-4">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Pilih Kandidat Terbaikmu!</h2>
                    <p class="text-gray-600">
                        Gunakan hak suaramu untuk memilih pemimpin yang tepat. <br>
                        Cermati, telusuri, dan berikan suaramu dengan mudah lewat Wevoting!
                    </p>
                </div>

                <!-- Candidate Card -->
                <div class="bg-[#F1F1F1] bg-opacity-40 rounded-lg shadow-lg p-6 mb-8">
                    <div class=" flex flex-col items-center gap-2">
                        <!-- Candidate Position -->
                        <div class="bg-[#926AE1] bg-opacity-20 text-[#FAFAFA] px-16 py-2 rounded-md text-sm font-bold transition-colors flex items-center gap-2 mb-4">
                        <h3 class="text-xl font-semibold text-[#411C8C]">Kandidat X</h3>
                        </div>
                        <!-- Candidate Image -->
                        <div class="w-48 h-48 mx-auto mb-6 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">Kandidat 1</span>
                        </div>
                        <!-- Candidate Name -->
                        <h3 class="text-lg font-semibold text-gray-800 mb-8">Budi Hartono & Cici Cahyani</h3>
                    </div>

                    <!-- Candidate Info -->
                    <div class="space-y-6">
                        <!-- Visi -->
                        <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-6">
                            <div class="text-[#411C8C]">
                            <h3 class="font-semibold uppercase mb-2">Visi</h3>
                            <p class="">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas fringilla tortor in varius. Curabitur vitae erat neque. Ut vulputate ultricies libero ac cursus elit. Curabitur imperdiet lacus nec elit sodales, eu consectetur velit dictum. Nam consectetur dolor in vulputate ullamcorper floris ligula risus, venenatis sed odio eu, sodales venenatis enim. Ut sit amet venenatis...
                            </p>
                            </div>
                        </div>

                        <!-- Misi -->
                        <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-6">
                            <div class="text-[#411C8C]">
                                <h3 class="font-semibold uppercase mb-2">Misi</h3>
                                <p class="">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas fringilla tortor in varius. Curabitur vitae erat neque. Ut vulputate ultricies libero ac cursus elit. Curabitur imperdiet lacus nec elit sodales, eu consectetur velit dictum. Nam consectetur dolor in vulputate ullamcorper floris ligula risus, venenatis sed odio eu, sodales venenatis enim. Ut sit amet venenatis...
                                </p>
                                </div>
                        </div>

                        <!-- Program Kerja -->
                        <div class="bg-[#926AE1] bg-opacity-20 rounded-lg p-6">
                            <div class="text-[#411C8C]">
                                <h3 class="font-semibold uppercase mb-2">Program Kerja</h3>
                                <p class="">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas fringilla tortor in varius. Curabitur vitae erat neque. Ut vulputate ultricies libero ac cursus elit. Curabitur imperdiet lacus nec elit sodales, eu consectetur velit dictum. Nam consectetur dolor in vulputate ullamcorper floris ligula risus, venenatis sed odio eu, sodales venenatis enim. Ut sit amet venenatis...
                                </p>
                                </div>
                        </div>

                        <!-- Video Section -->
                        <div class="mt-12">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Video Kampanye</h3>
                            <div class="w-full aspect-video bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400">Video Placeholder</span>
                            </div>
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
                            Sudah Siap Untuk <br/> 
                            Memberikan Suaramu?
                        </h2>
                        <p class="text-lg">
                            Dengan masuk, kamu bisa memberikan suaramu untuk kandidat
                            yang kamu pilih. Jangan sampai ketinggalan, yuk masuk sekarang!
                        </p>
                    </div>

                    <!-- Button -->
                    <div>
                        <a href="{{ route('users.login') }}" class="bg-[#612AD0] text-[#FAFAFA] px-12 py-4 rounded-md text-sm font-bold hover:bg-[#4F22AA] transition-colors flex items-center gap-2">
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
                            <div class="max-w-[600px] bg-[#926AE1] hover:bg-[#612AD0] bg-opacity-20 hover:text-[#FAFAFA] text-[#411C8C] rounded-lg">
                                <a href="#hero" class="text-sm flex items-center px-8 py-4 gap-2">
                                    Kembali ke Atas
                                    <i class="fa-solid fa-arrow-up fa-xs" style="color: #411C8C hover:#FAFAFA;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="shadow-lg sm:flex sm:items-center sm:justify-center p-4 sm:p-6 xl:p-4 text-[#411C8C] gap-2 antialiased">
                    <p class="mb-4 text-sm text-center text-[#411C8C] sm:mb-0">
                        &copy; <a href="/#hero" class="hover:underline">Wevoting</a> 2025 by iz4ru
                    </p>
                    <div class="flex justify-center items-center space-x-1">
                        <a href="https://github.com/iz4ru" data-tooltip-target="tooltip-github" class="inline-flex justify-center p-2 text-[#411C8C] rounded-lg cursor-pointer dark:hover:text-white hover:text-gray-900 hover:bg-[#411C8C]" target="_blank">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Github</span>
                        </a>
                    </div>
                </footer>

    </div>
</body>
</html>