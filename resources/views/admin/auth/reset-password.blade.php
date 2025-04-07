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

    <!-- Script JS -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <title>Admin - Wevoting</title>
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
                        <img src="{{ asset('img/lock-key.png') }}" 
                        alt="Selamat Datang" 
                        class="w-16 h-16 object-contain"/>
                    </div>

                    <!-- Welcome Text -->
                    <div class="text-left mb-4">
                        <h1 class="text-4xl font-bold text-gray-700 mb-2">
                            Satu Langkah Lagi!
                        </h1>
                        <p class="text-md text-gray-500">
                            Yuk masukkan dulu form reset passwordnya!
                        </p>
                    </div>

                    <!-- Register Form -->
                    <div class="">
                        <form wire:submit='register' action="{{ route('password.update') }}" method="POST" onsubmit="validateForm(event)">
                            @csrf
                            <div class="space-y-4">

                                <input type="hidden" name=token id="token" value={{ $token }}>

                                <!-- Email -->
                                <div class="relative w-full">
                                    <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                    <input wire:model="email" placeholder="Masukkan Email Anda" type="email" name="email" id="email" 
                                        class="text-sm w-full h-14 pl-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                        required autofocus autocomplete="email">
                                </div>
                                
                                <!-- Password -->
                                <div class="relative w-full">
                                    <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                    <input wire:model="password" placeholder="Masukkan Password Anda" type="password" name="password" id="password"
                                        class="text-sm w-full h-14 pl-12 pr-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required autocomplete="off">
                                    <i class="fa fa-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 cursor-pointer togglePassword"></i>
                                </div>

                                <!-- Confirm Password -->
                                <div class="relative w-full">
                                    <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                    <input wire:model="password_confirmation" placeholder="Konfirmasi Password Anda" type="password" name="password_confirmation" id="password_confirmation"
                                        class="text-sm w-full h-14 pl-12 pr-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required autocomplete="off">
                                    <i class="fa fa-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 cursor-pointer togglePassword"></i>
                                </div>
                
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show text-sm py-2 px-4 bg-green-100 text-green-500 border border-green-500 rounded-md" role="alert" id="successAlert">
                                    <p>{{ session('success') }}</p>
                                </div>
                                @endif          

                                @if(session('error'))
                                <div class="alert alert-error alert-dismissible fade show text-sm py-2 px-4 bg-red-100 text-red-500 border border-red-500 rounded-md" role="alert" id="errorAlert">
                                    <p>{{ session('error') }}</p>
                                </div>
                                @endif               
                                
                                <script>
                                    document.querySelectorAll(".togglePassword").forEach((icon) => {
                                        icon.addEventListener("click", function () {
                                            const passwordInput = this.previousElementSibling; // Ambil input sebelum ikon
                                            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
                                
                                            // Ganti ikon
                                            this.classList.toggle("fa-eye");
                                            this.classList.toggle("fa-eye-slash");
                                        });
                                    });
                                </script>

                                <script>
                                    // Menghilangkan alert setelah 1 detik
                                    setTimeout(function() {
                                        var successAlert = document.getElementById('successAlert');
                                        if (successAlert) {
                                            successAlert.style.display = 'none';
                                        }
                                    }, 3000);
                                    setTimeout(function() {
                                        var errorAlert = document.getElementById('errorAlert');
                                        if (errorAlert) {
                                            errorAlert.style.display = 'none';
                                        }
                                    }, 3000);
                                </script>
                            </div>

                            <!-- Register Buttons -->
                            <div class="space-y-4 mt-4">
                                <button type="submit" 
                                    class="flex items-center justify-center w-full px-6 py-4 bg-[#22A06B] hover:bg-[#1A754E] text-white rounded-xl transition-colors">
                                    <div class="text-center flex items-center gap-3">
                                        <span class="font-semibold">Reset Password</span>
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
            &copy; Wevoting 2025 by iz4ru
        </div>
    </div>
</body>
</html>