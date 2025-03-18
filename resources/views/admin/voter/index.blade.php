@extends('admin.layouts.app')

@section('title', 'Data Peserta Terpilih')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Tabel Data Pemilih</h1>
                        <p class="text-sm text-[#4F22AA] mb-4 lg:text-base">Tambahkan data pemilih untuk kandidat atau
                            manajemen pemilih.</p>
                    </div>

                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-3 md:gap-4 ">
                        <div class="flex flex-col">
                            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                                <div class="shadow-lg w-max">
                                    <a href="#"
                                        class="w-full h-full font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#4F22AA] text-white rounded-md hover:bg-[#3C1C8C]">
                                        <span class="text-sm lg:text-base">Tambah Pemilih</span>
                                        <i class="fa-solid fa-user-plus fa-sm lg:fa-md"></i>
                                    </a>
                                </div>
                                <div class="shadow-lg w-max">
                                    <a href="#"
                                        class="w-full h-full font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#1D7AFC] text-white rounded-md hover:bg-[#1766D4]">
                                        <span class="text-sm lg:text-base">Impor Excel / CSV</span>
                                        <i class="fa-solid fa-file-import fa-sm lg:fa-md"></i>
                                    </a>
                                </div>
                            </div>

                            <hr class="rounded w-full border-t-2 border-[#4F22AA]/50 my-4 mx-auto">

                            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                                <div class="relative">
                                    <i class="fa fa-vote-yea absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                                    <select placeholder="Pilih Role Anda" type="select" name="role" id="role"
                                        class="text-sm w-full h-14 pl-12 pr-12 text-gray-300 placeholder:text-gray-300 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required autocomplete="off"
                                        onchange="this.classList.remove('text-gray-300'); this.classList.add('text-gray-700');">
                                        <option value="" disabled selected>Status Vote</option>
                                        <option value="belum">Belum Memilih</option>
                                        <option value="sudah">Sudah Memilih</option>
                                    </select>
                                </div>
                                <div class="shadow-lg w-max">
                                    <a href="#"
                                        class="w-full h-full font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#1D7AFC] text-white rounded-md hover:bg-[#1766D4]">
                                        <span class="text-sm lg:text-base">Print</span>
                                        <i class="fa-solid fa-print fa-sm lg:fa-md"></i>
                                    </a>
                                </div>
                                <div class="shadow-lg w-max">
                                    <a href="#"
                                        class="w-full h-full font-semibold flex items-center gap-3 px-4 py-3 lg:px-6 lg:py-4 bg-[#E24A36] text-white rounded-md hover:bg-[#CD311D]">
                                        <span class="text-sm lg:text-base">Truncate</span>
                                        <i class="fa-solid fa-trash fa-sm lg:fa-md"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


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
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Nomor Identitas
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">Nama
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Kelas
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">Kode
                                    Akses
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Status Vote
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($voters as $voter) --}}
                            <!-- Cek apakah positon dalam session -->
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2 text-center">
                                    <span class="flex justify-center">//</span>
                                </td>
                                <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                    //</td>
                                <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                    //</td>
                                <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                    //</td>
                                <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                    //</td>
                                <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                    //</td>
                                <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="#"
                                            class="text-[#4A95FD] hover:bg-[#4A95FD] hover:text-white rounded-md px-2 py-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <span class="text-gray-300">|</span>
                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-[#E24A36] hover:bg-[#E24A36] hover:text-white rounded-md px-2 py-1">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            {{-- @endforeach --}}
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
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "Semua"]
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
