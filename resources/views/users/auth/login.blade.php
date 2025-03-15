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

    <title>Pemilih - Wevoting</title>
</head>
<body class="bg-[#FAFAFA] min-h-screen flex flex-col" style="background-image: url('{{ asset('img/bg-login.png') }}'); background-size: cover; background-position: center;">
    <div class="flex-1 flex flex-col">
        <!-- Header with Back Button and Logo -->
        <div class="p-6">
            <div class="flex items-center gap-6 px-8 py-4">
                <a href="/login-user" class="text-gray-600 hover:text-gray-800 transition-colors">
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
                        <img src="{{ asset('img/person.png') }}" 
                        alt="Selamat Datang" 
                        class="w-16 h-16 object-contain"/>
                    </div>

                    <!-- Welcome Text -->
                    <div class="text-left mb-4">
                        <h1 class="text-4xl font-bold text-gray-700 mb-2">
                            Pilihlah Pemimpin <br>  Barumu!
                        </h1>
                        <p class="text-md text-gray-500">
                            Sudah punya kode akses? Yuk, masuk!
                        </p>
                    </div>

                    <!-- Login Form -->
                    <div class="">
                        <form action="#" method="POST" onsubmit="validateForm(event)">
                            @csrf
                            <div class="space-y-4">
                                <div class="relative w-full">
                                    <i class="fa fa-qrcode absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                    <input placeholder="Masukkan Kode Akses" type="textbox" name="code" id="code" 
                                        class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" 
                                        required autocomplete="off">
                                </div>                                
                            </div>
                            
                            <!-- Login Buttons -->
                            <div class="space-y-4 mt-4">
                                <button type="submit" 
                                   class="flex items-center justify-center w-full px-6 py-4 bg-[#FFB300] hover:bg-[#F59E00] text-white rounded-xl transition-colors">
                                    <div class="text-center flex items-center gap-3">
                                        <span class="font-semibold">Masuk</span>
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="py-6 text-center text-gray-500 text-sm">
            © Wevoting 2025 by iz4ru
        </div>
    </div>
</body>
</html>