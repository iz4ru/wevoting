<!-- resources/views/admin/layouts/navigation.blade.php -->

<!-- Navigation -->
@if (Auth::user()->role == 'admin')
    <nav class="flex-1 overflow-y-auto">
        <ul class="">
            <li>
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                    class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-home"></i>
                    <span class="font-semibold">Dasbor Utama</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('admin.mgmt') }}" :active="request()->routeIs(['admin.mgmt', 'admin.mgmt.create', 'admin.mgmt.show', 'admin.mgmt.form_password'])"
                    class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="font-semibold">Manajemen Admin</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#" class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-semibold">Data Kandidat</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#"
                    class="flex items-center gap-3 px-6 py-3 bg-[#E3E3E3]/50 hover:bg-[#C1C1C1]/50 border-white">
                    <i class="fa-solid fa-user-check" style="color: #718295"></i>
                    <span class="font-semibold text-[#718295]">Data Peserta Terpilih</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#"
                    class="flex items-center gap-3 px-6 py-3 bg-[#E3E3E3]/50 hover:bg-[#C1C1C1]/50 border-white">
                    <i class="fa-solid fa-list" style="color: #718295"></i>
                    <span class="font-semibold text-[#718295]">Data Posisi</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('logs') }}" :active="request()->routeIs('logs')"
                    class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-history"></i>
                    <span class="font-semibold">Log Admin</span>
                </x-nav-link>
            </li>
        </ul>
    </nav>
    </div>
@elseif(Auth::user()->role == 'panitia')
    <nav class="flex-1 overflow-y-auto">
        <ul class="">
            <li>
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                    class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-home"></i>
                    <span class="font-semibold">Dasbor Utama</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#" class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-semibold">Data Kandidat</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#"
                    class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-user-check"></i>
                    <span class="font-semibold">Data Peserta Terpilih</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#"
                    class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-list"></i>
                    <span class="font-semibold">Data Posisi</span>
                </x-nav-link>
            </li>
        </ul>
    </nav>
    </div>
@endif

<!-- Auth Admin / Panitia Check -->
@if (Auth::user()->role == 'panitia' && request()->is(['management', 'logs']))
    @php abort(403, 'Unauthorized'); @endphp
@endif

<!-- Overlay for mobile when sidebar is open -->
<div id="sidebarOverlay"
    class="overflow-y-auto fixed inset-0 drop-shadow-xl bg-black/5 bg-opacity-20 z-20 hidden md:hidden"
    onclick="closeSidebar()"></div>
