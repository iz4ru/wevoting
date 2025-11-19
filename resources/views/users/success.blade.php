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

    <!-- PWA  -->
    <meta name="theme-color" content="#000000" />
    <link rel="apple-touch-icon" href="{{ asset('images/icons/icon-192x192.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <title>Success - Wevoting</title>
</head>

<body class="bg-[#FAFAFA] min-h-screen flex flex-col"
    style="background-image: url('{{ asset('img/bg-login.png') }}'); background-size: cover; background-position: center;">
    <div class="flex-1 flex flex-col">
        <!-- Header with Back Button and Logo -->
        <div class="p-6">
            <div class="flex items-center gap-6 px-8 py-4">
                <i class="fa-solid fa-check-to-slot fa-2xl pr-2 translate-y-4 translate-x-2"
                    style="color: #4F22AA;"></i>
                {{-- <img src="{{ asset('img/logo.png') }}" alt="Wevoting Logo" class="w-8 h-8"> --}}
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center transform -translate-y-2 px-4">
            <div class="w-full max-w-sm">
                <div class="bg-white/30 backdrop-blur-lg rounded-2xl shadow-lg p-8">
                    <!-- Welcome Icon -->
                    <div class="text-left mb-4">
                        <img src="{{ asset('img/checkmark.png') }}" alt="Selamat Datang"
                            class="w-16 h-16 object-contain" />
                    </div>

                    <!-- Welcome Text -->
                    <div class="text-left mb-4">
                        <h1 class="text-4xl font-bold text-gray-700 mb-2">
                            Terima Kasih Banyak!
                        </h1>
                        <p class="text-md text-gray-500">
                            Kamu telah berhasil melakukan voting!
                        </p>
                    </div>

                    <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-4 mx-auto">

                    <div class="h-auto">
                        <p class="text-base text-center mb-4 text-gray-500">
                            Kamu akan diarahkan kembali ke halaman login dalam:
                        </p>
                        <h1 id="countdown" class="text-4xl font-bold text-center text-[#1D7AFC] mb-2">
                            3 Detik
                        </h1>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="py-6 text-center text-gray-500 text-sm">
        &copy; Wevoting 2025 by iz4ru
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

<script>
    let countdown = 3; // Waktu awal dalam detik
    let countdownElement = document.getElementById("countdown"); // Ambil elemen teks

    function updateCountdown() {
        if (countdown > 0) {
            countdown--; // Kurangi 1 detik
            countdownElement.textContent = countdown + " detik"; // Update teks
        }
        if (countdown === 0) {
            window.location.href = "{{ route('voter.login') }}"; // Redirect ke login
        }
    }

    setInterval(updateCountdown, 1000); // Jalankan setiap 1 detik
</script>

</html>
