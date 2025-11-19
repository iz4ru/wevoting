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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
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

    <title>Login - Wevoting</title>
</head>
<body class="bg-[#FAFAFA] min-h-screen flex flex-col" style="background-image: url('{{ asset('img/bg-login.png') }}'); background-size: cover; background-position: center;">
    <div class="flex-1 flex flex-col">
        <!-- Header with Back Button and Logo -->
        <div class="p-6">
            <div class="flex items-center gap-6 px-8 py-4">
                <a href="/" class="text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="fa-solid fa-chevron-left text-xl"></i>
                </a>
                <i class="fa-solid fa-check-to-slot fa-2xl pr-2" style="color: #4F22AA;"></i>
                {{-- <img src="{{ asset('img/logo.png') }}" alt="Wevoting Logo" class="w-8 h-8"> --}}
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center transform -translate-y-2 px-4">
            <div class="w-full max-w-sm">
                <div class="bg-white/30 backdrop-blur-lg rounded-2xl shadow-lg p-8">
                    <!-- Welcome Icon -->
                    <div class="text-left mb-4">
                        <img src="{{ asset('img/waving-hand.png') }}" 
                        alt="Selamat Datang" 
                        class="w-16 h-16 object-contain"/>
                    </div>

                    <!-- Welcome Text -->
                    <div class="text-left mb-4">
                        <h1 class="text-4xl font-bold text-gray-700 mb-2">
                            Selamat Datang <br>  Kembali!
                        </h1>
                        <p class="text-md text-gray-500">
                            Kali Ini Mau Log-in Sebagai Apa?
                        </p>
                    </div>

                    <!-- Login Buttons -->
                    <div class="space-y-4">
                        <a href="{{ route('voter.login') }}" 
                           class="flex items-center justify-between w-full px-6 py-4 bg-[#FFB300] hover:bg-[#F59E00] text-white rounded-xl transition-colors">
                            <div class="text-left flex items-center gap-3">
                                <i class="fa-solid fa-user"></i>
                                <span class="font-semibold">Login Sebagai Pemilih</span>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>

                        <a href="{{ route('admin.login') }}" 
                           class="flex items-center justify-between w-full px-6 py-4 bg-[#7C3AED] hover:bg-[#6D31D5] text-white rounded-xl transition-colors">
                            <div class="text-left flex items-center gap-3">
                                <i class="fa-solid fa-gear"></i>
                                <span class="font-semibold">Login Sebagai Admin</span>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="py-6 text-center text-gray-500 text-sm">
            © Wevoting 2025 by iz4ru
        </div>
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
</html>