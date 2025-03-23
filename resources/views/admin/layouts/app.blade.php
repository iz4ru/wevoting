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

    <title>@yield('title', 'Admin') - Wevoting</title>
</head>

<body class="bg-[#FAFAFA] h-screen relative">
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')
    <main class="flex flex-col min-h-screen">

        <!-- Navigation -->
        @include('admin.layouts.navigation')

        <!-- Main Content - Responsive layout -->
        <div id="mainContent"
            class="flex-1 flex flex-col w-full transition-all duration-300 ease-in-out relative z-10 ml-72 overflow-y-auto">
            <!-- Header - Sticky position -->
            @include('admin.layouts.header')

            <div id="mainPanel" class="flex-1 overflow-y-auto">
                @yield('content')
                @include('admin.layouts.footer')
            </div>
        </div>
        </div>
        </div>

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

        <script>
            document.querySelectorAll(".togglePassword").forEach((icon) => {
                icon.addEventListener("click", function() {
                    const passwordInput = this.previousElementSibling; // Ambil input sebelum ikon
                    passwordInput.type = passwordInput.type === "password" ? "text" : "password";

                    // Ganti ikon
                    this.classList.toggle("fa-eye");
                    this.classList.toggle("fa-eye-slash");
                });
            });
        </script>

        <script>
            setTimeout(function() {
                var successAlert = document.getElementById('successAlert');
                if (successAlert) {
                    successAlert.remove(); // Hapus elemen dari DOM
                }
            }, 3000);

            setTimeout(function() {
                var errorAlert = document.getElementById('errorAlert');
                if (errorAlert) {
                    errorAlert.remove(); // Hapus elemen dari DOM
                }
            }, 3000);
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuToggle = document.getElementById('sidebarToggle');
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('mainContent');
                const overlay = document.getElementById('sidebarOverlay');

                // Check if we're on mobile and set the initial state
                function initSidebar() {
                    if (window.innerWidth < 768) { // md breakpoint
                        closeSidebar(); // Auto close pas pertama load di mobile
                    } else {
                        // On desktop, we start with sidebar open
                        openSidebar();
                    }
                }

                // Initialize sidebar on page load
                initSidebar();

                // Toggle sidebar
                menuToggle.addEventListener('click', function() {
                    if (sidebar.classList.contains('-translate-x-full')) {
                        openSidebar();
                    } else {
                        closeSidebar();
                    }
                });

                // Handle window resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 768) {
                        openSidebar(); // Auto open pas ke desktop
                    } else {
                        closeSidebar(); // Auto close pas ke mobile
                    }
                });

                // Tutup sidebar hanya jika di mobile (bukan desktop)
                document.addEventListener('click', function(event) {
                    if (
                        window.innerWidth < 768 && // Hanya di mobile
                        !sidebar.contains(event.target) && // Bukan sidebar
                        !menuToggle.contains(event.target) // Bukan tombol toggle
                    ) {
                        closeSidebar();
                    }
                });
            });

            // Open sidebar function
            function openSidebar() {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('mainContent');
                const overlay = document.getElementById('sidebarOverlay');

                sidebar.classList.remove('-translate-x-full');

                // Adjust main content margin on desktop
                if (window.innerWidth >= 768) {
                    mainContent.classList.add('ml-72');
                    mainContent.classList.remove('ml-0');
                } else {
                    // Only show overlay on mobile
                    overlay.classList.remove('hidden');
                }
            }

            // Close sidebar function
            function closeSidebar() {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('mainContent');
                const overlay = document.getElementById('sidebarOverlay');

                sidebar.classList.add('-translate-x-full');

                // Adjust main content margin on all screen sizes
                mainContent.classList.remove('ml-72');
                mainContent.classList.add('ml-0');

                // Hide overlay (only exists on mobile)
                overlay.classList.add('hidden');
            }
        </script>
    </main>

</body>

</html>
