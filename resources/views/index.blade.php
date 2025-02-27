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

    <title>Wevoting</title>
</head>
<body class="bg-[#FAFAFA] overflow-x-hidden">
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col max-w-full">
        <!-- Navbar -->
        <nav class="fixed top-5 left-1/2 transform -translate-x-1/2 w-11/12 max-w-7xl bg-white/30 backdrop-blur-lg rounded-2xl px-8 py-4 flex justify-between items-center shadow-lg z-50">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-check-to-slot fa-2xl pr-2" style="color: #4F22AA;"></i>
                <span class="text-[#4F22AA] text-secondary font-bold text-2xl ml-2">WEVOTING</span>
            </div>

            <!-- Navigation Button Group -->
            <div class="flex gap-4">
                <button class="bg-[#E3E3E3] text-[#323A43] backdrop-blur-lg px-4 sm:px-8 py-3 rounded-md text-sm font-normal hover:bg-[#d6d6d6] transition-colors">Kandidat</button>
                <button class="bg-[#7C3AED] text-[#FAFAFA] px-8 py-3 rounded-md text-sm font-bold hover:bg-[#6D31D5] transition-colors flex items-center gap-2">
                    Masuk
                    <i class="fa-solid fa-chevron-right fa-sm"></i>
                </button>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="flex-grow flex items-center justify-center py-20 overflow-hidden">
            <div class="px-4 md:px-8 max-w-7xl mx-auto w-full">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                    <!-- Left Content -->
                    <div class="lg:max-w-[600px]">
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 leading-tight mb-6">
                            Bersuara Itu Hak,<br/>
                            Wevoting Bikin Makin<br/>
                            Gampang!
                        </h1>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Tidak perlu kertas suara, semua sudah digital! Hemat waktu,<br class="hidden md:block"/>
                            lebih cepat, dan lebih terpercaya.
                        </p>
                    </div>

                    <!-- Right Image -->
                    <div class="lg:flex-1">
                        <img src="{{ asset('img/voting-illust.png') }}" 
                             alt="Ilustrasi voting digital" 
                             class="w-full max-w-[600px] mx-auto object-contain"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Candidate Section -->
        <div class="py-8 sm:py-16">
            <div class="max-w-6xl mx-auto px-4">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Pilih Kandidat Terbaikmu!</h2>
                    <p class="text-gray-600">
                        Gunakan hak suaramu untuk memilih pemimpin yang tepat.
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
                        <button class="bg-[#612AD0] text-[#FAFAFA] px-12 py-4 rounded-md text-sm font-bold hover:bg-[#6D31D5] transition-colors flex items-center gap-2">
                            Mulai Voting
                            <i class="fa-solid fa-chevron-right fa-sm"></i>
                        </button>   
                    </div>
                </div>
            </div>
        </div>

                <!-- User Let Login -->
                <div class="text-[#411C8C] py-12 sm:py-16">
                    <div class="max-w-4xl mx-auto px-4">
                        <div class="flex flex-col items-center text-center gap-8">
                            <!-- Content -->
                            <div class="max-w-[600px]">
                                <a href="#" class="text-lg flex items-center gap-2">
                                    Kembali ke Atas
                                    <i class="fa-solid fa-arrow-up fa-xs" style="color: #411c8c;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
</body>
</html>