<!-- resources/views/users/layouts/sidebar.blade.php -->

<!-- Sidebar -->
<div class="fixed top-0 left-0 w-5/6 h-5/6 z-0"
    style="background-image: url('{{ asset('img/radial-blur.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: left top;">
</div>
<div class="flex h-screen relative z-10">
    <!-- Sidebar with Glassmorphism - Fixed position -->
    <div id="sidebar"
        class="fixed w-72 h-screen bg-white-30 backdrop-blur-lg text-white flex flex-col shadow-lg z-30 transform transition-transform duration-300 ease-in-out sidebar-cloak">
        <!-- Logo -->
        <div class="p-10 flex items-center gap-3 border-b border-white/10">
            <div class="w-10 h-10 flex items-center justify-center rounded">
                <i class="fa-solid fa-check-to-slot fa-2xl" style="color: #FFB300;"></i>
                {{-- <img src="{{ asset('img/logo.png') }}" alt="Wevoting Logo" class="w-8 h-8"> --}} <!-- Change this for image logo-->
            </div>
            <span class="text-2xl text-[#FFB300] font-bold">WEVOTING</span>
        </div>
