@extends('admin.layouts.app')

@section('title', 'Data Peserta Terpilih')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Tabel Data Pemilih</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Tambahkan data pemilih untuk kandidat atau
                            manajemen pemilih.</p>
                    </div>

                    @if (Auth::user()->role == 'admin')
                    <div class="mt-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 md:gap-4 ">
                        <div class="flex flex-col">
                            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                                <div class="shadow-lg w-max">
                                    <a href="{{ route('voter.create') }}"
                                        class="w-full h-full font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#4F22AA] text-white rounded-md hover:bg-[#3C1C8C]">
                                        <span class="text-sm lg:text-base">Daftarkan Pemilih</span>
                                        <i class="fa-solid fa-user-plus fa-sm lg:fa-md"></i>
                                    </a>
                                </div>
                                <div class="shadow-lg w-max">
                                    <a href="{{ route('voter.show.import') }}"
                                        class="w-full h-full font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#1D7AFC] text-white rounded-md hover:bg-[#1766D4]">
                                        <span class="text-sm lg:text-base">Impor Data</span>
                                        <i class="fa-solid fa-file-import fa-sm lg:fa-md"></i>
                                    </a>
                                </div>
                            </div>

                            <hr class="rounded w-full border-t-2 border-[#4F22AA]/50 my-4 mx-auto">

                            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                                <div class="relative">
                                    <form action="{{ route('voter') }}" method="GET">
                                        <i class="fa fa-vote-yea absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <select placeholder="Validasi" type="select" name="validation" id="validation"
                                        class="text-sm w-full h-14 pl-12 pr-12 text-gray-500 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required autocomplete="off"
                                        onchange="this.form.submit()">
                                        <option value="" disabled selected>Status Vote</option>
                                        <option value="" {{ request('validation') == '' ? 'selected' : '' }}>Semua</option>
                                        <option value="belum" {{ request('validation') == 'belum' ? 'selected' : '' }}>Belum Memilih</option>
                                        <option value="sudah" {{ request('validation') == 'sudah' ? 'selected' : '' }}>Sudah Memilih</option>
                                    </select>
                                </div>
                                    </form>
                                    
                                <div class="shadow-lg w-max">
                                    <a href="{{ route('voter.export') }}"
                                        class="w-full h-full font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#1D7AFC] text-white rounded-md hover:bg-[#1766D4]">
                                        <span class="text-sm lg:text-base">Ekspor Data</span>
                                        <i class="fa-solid fa-file-export fa-sm lg:fa-md"></i>
                                    </a>
                                </div>
                                <div class="shadow-lg w-max">
                                    <div x-data="{ open: false }" class="relative">
                                        <!-- Button Truncate -->
                                        <button @click="open = true"
                                            class="w-full h-full font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#E24A36] text-white rounded-md hover:bg-[#CD311D]">
                                            <span class="text-sm lg:text-base">Truncate</span>
                                            <i class="fa-solid fa-trash fa-sm lg:fa-md"></i>
                                        </button>

                                        <!-- Modal Backdrop -->
                                        <div x-show="open" x-cloak
                                            class="fixed top-0 left-0 w-full h-full inset-0 bg-black/20 rounded-xl flex justify-center items-center z-50">
                                        </div>

                                        <!-- Modal Content -->
                                        <div x-show="open" x-transition:enter="transition ease-out duration-100 transform"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75 transform"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95" @click.away="open = false" x-cloak
                                            class="fixed top-0 left-0 w-full h-full rounded-xl flex justify-center items-center z-50">
                                            <div
                                                class="p-6 w-[360px] lg:w-[540px] bg-white/90 backdrop-blur-lg border-gray-200 rounded-lg shadow-lg items-center justify-center">
                                                <div class="bg-[#E24A36]/20 backdrop-blur-lg py-2 rounded-lg">
                                                    <h2
                                                        class="mb-2 text-xl font-bold text-[#E24A36] text-center px-4 translate-y-1">
                                                        Hapus Semua Data Pemilih</h2>
                                                </div>
                                                <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-6 mx-full">
                                                <p class="mb-6 font-medium text-gray-600 text-center text-sm">Yakin untuk
                                                    menghapus semua data pemilih? <br> Saat ini memilih data dari:<br> <span
                                                        class="font-semibold text-[#E24A36]">{{ $voters->count() }}</span>
                                                    data.</p>
                                                </p>
                                                <form action="{{ route('voter.truncate') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="mb-6">
                                                        <label for="password_confirmation"
                                                            class="text-gray-500 font-medium text-xs lg:text-sm">Konfirmasi
                                                            Password</label>
                                                        <div class="relative">
                                                            <i
                                                                class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                                            <input wire:model="password_confirmation"
                                                                placeholder="Masukkan Password User Ini" type="password"
                                                                name="password_confirmation" id="password_confirmation"
                                                                class="text-sm w-full h-14 pl-12 pr-12 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                                required autocomplete="off">
                                                            <i
                                                                class="fa fa-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 cursor-pointer togglePassword"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-row gap-2 justify-between">
                                                        <button type="button" @click="open = false"
                                                            class="px-5 py-2.5 bg-gray-400 rounded-lg">
                                                            <span class="text-white font-semibold text-sm">Kembali</span>
                                                        </button>
                                                        <button type="submit" class="px-5 py-2.5 bg-[#E24A36] rounded-lg">
                                                            <span class="text-[white] font-semibold text-sm">Hapus</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                </div>
                <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-8 mx-6">

                <!-- Alerts -->
                @if (session('success'))
                    <div class="alert alert-success py-2 px-4 mb-4 bg-green-100 text-green-500 border border-green-500 rounded-md"
                        role="alert" id="successAlert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error py-2 px-4 mb-4 bg-red-100 text-red-500 border border-red-500 rounded-md"
                        role="alert" id="errorAlert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <div class="overflow-x-auto text-sm">
                    <table id="adminTable" class="table-auto w-full border-collapse rounded-lg overflow-hidden shadow-lg">
                        <thead class="bg-[#926AE1]/20 backdrop-blur-lg border-gray-300">
                            <tr>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-center">No
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-center">
                                    No Identitas
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">Nama
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Kelas
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Jurusan / Bidang
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Kode
                                    Akses
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Status Vote
                                </th>
                                @if (Auth::user()->role == 'admin')
                                    <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-center">
                                    Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voters as $voter)
                                <!-- Cek apakah positon dalam session -->
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td
                                        class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2 text-center">
                                        <span class="flex justify-center">{{ $loop->iteration }}</span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2 text-center">
                                        {{ $voter->user_id }}</td>
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        {{ $voter->name }}</td>
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        {{ $voter->class }}</td>
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        {{ $voter->vocation }}</td>
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        {{ $voter->access_code }}</td>
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        @if (isset($voter->validation))
                                        {{ ucwords($voter->validation) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    @if (Auth::user()->role == 'admin')
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        <div class="flex justify-center items-center gap-2">
                                            <a href="{{ route('voter.show', $voter->uuid) }}"
                                                class="text-[#4A95FD] hover:bg-[#4A95FD] hover:text-white rounded-md px-2 py-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <span class="text-gray-300">|</span>
                                            <div x-data="{ open: false }" class="relative">
                                                <button @click="open = true"
                                                    class="text-[#E24A36] hover:bg-[#E24A36] hover:text-white rounded-md px-2 py-1">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <div x-show="open" x-cloak
                                                    class="fixed top-0 left-0 w-full h-full inset-0 bg-black/20 rounded-xl flex justify-center items-center z-50">
                                                </div>
                                                <div x-show="open"
                                                    x-transition:enter="transition ease-out duration-100 transform"
                                                    x-transition:enter-start="opacity-0 scale-95"
                                                    x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75 transform"
                                                    x-transition:leave-start="opacity-100 scale-100"
                                                    x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
                                                    x-cloak
                                                    class="fixed top-0 left-0 w-full h-full rounded-xl flex justify-center items-center z-50">
                                                    <div
                                                        class="p-6 w-[360px] lg:w-[540px] bg-white/90 backdrop-blur-lg border-gray-200 rounded-lg shadow-lg items-center justify-center">
                                                        <div class= "bg-[#E24A36]/20 backdrop-blur-lg py-2 rounded-lg">
                                                            <h2
                                                                class="mb-2 text-xl font-bold text-[#E24A36] text-center px-4 translate-y-1">
                                                                Hapus
                                                                Data Pemilih</h2>
                                                        </div>
                                                        <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-6 mx-full">
                                                        <p class="mb-6 font-medium text-gray-600 text-center">Yakin untuk
                                                            menghapus yang dipilih? <br> Saat ini memilih data
                                                            dari:<br><span
                                                                class="font-semibold text-[#4F22AA]">({{ $voter->name }}, {{ $voter->class }})</span>
                                                        </p>
                                                        <form action="{{ route('voter.delete', $voter->uuid) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="flex flex-row gap-2 justify-between">
                                                                <button type="button" @click="open = false"
                                                                    class="px-5 py-2.5 bg-gray-400 rounded-lg">
                                                                    <span class="text-white font-semibold">Kembali</span>
                                                                </button>
                                                                <button type="submit"
                                                                    class="px-5 py-2.5 bg-[#E24A36] rounded-lg">
                                                                    <span class="text-[white] font-semibold">Hapus</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#adminTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Semua"]
                    ],
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        "infoEmpty": "Tidak ada data",
                        "infoFiltered": "(disaring dari _MAX_ total data)",
                        "search": "Cari : ",
                        "paginate": {
                            "first": "Awal",
                            "last": "Akhir",
                            "next": "❯",
                            "previous": "❮"
                        }
                    },
                    "columnDefs": [{
                            "orderable": false,
                            "targets": -1
                        } // -1 berarti kolom terakhir (Aksi)
                    ],
                });
            });
        </script>

    @endsection
