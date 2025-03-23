<!-- resources/views/users/layouts/navigation.blade.php -->

<!-- Navigation -->
    <nav class="flex-1 overflow-y-auto">
        <ul class="">
            <li>
                <x-nav-link href="{{ route('voter.dashboard') }}" :active="request()->routeIs(['voter.dashboard', 'voter.candidate.preview'])"
                    class="flex items-center gap-3 px-6 py-3 border-white">
                    <i class="fa-solid fa-home"></i>
                    <span class="font-semibold">Dasbor Utama</span>
                </x-nav-link>
            </li>
        </ul>
    </nav>
    </div>

<!-- Overlay for mobile when sidebar is open -->
<div id="sidebarOverlay"
    class="overflow-y-auto fixed inset-0 drop-shadow-xl bg-black/5 bg-opacity-20 z-20 hidden md:hidden"
    onclick="closeSidebar()"></div>
