@extends('admin.layouts.app')

@section('title', 'Log Admin')

@section('content')
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
            <div class="flex flex-col bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="bg-[#926AE1]/20 rounded-lg shadow-lg p-6">
                    <div class="">
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#4F22AA] mb-2">Log Admin</h1>
                        <p class="text-sm text-[#4F22AA] lg:text-base">Lihat audit log dari admin.</p>
                    </div>
                </div>
                <hr class="rounded border-t-2 border-[#B8B8B8]/50 my-8 mx-6">

                <div class="overflow-x-auto text-sm">
                    <table id="adminTable" class="table-auto w-full border-collapse rounded-lg overflow-hidden shadow-lg">
                        <thead class="bg-[#926AE1]/20 backdrop-blur-lg border-gray-300">
                            <tr>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-center">No
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Username</th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">
                                    Role</th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-left">Aktivitas
                                </th>
                                <th class="whitespace-nowrap text-[#4F22AA] border border-gray-300 px-4 py-2 text-center">
                                    Tanggal Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td
                                        class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2 text-center">
                                        {{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        {{ $log->username }}</td>
                                    @if ($log->role == 'admin')
                                        <td class="whitespace-nowrap text-green-600 border border-gray-300 px-4 py-2">
                                            Admin</td>
                                    @elseif($log->role == 'panitia')
                                        <td class="whitespace-nowrap text-amber-600 border border-gray-300 px-4 py-2">
                                            Panitia</td>
                                    @endif
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        {{ $log->activity }}</td>
                                    <td class="whitespace-nowrap text-gray-600 border border-gray-300 px-4 py-2">
                                        {{ $log->created_at }}</td>
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
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "Semua"]
                    ],
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        "infoEmpty": "Tidak ada data",
                        "infoFiltered": "(disaring dari _MAX_ total data)",
                        "search": "Cari User: ",
                        "paginate": {
                            "first": "Awal",
                            "last": "Akhir",
                            "next": "❯",
                            "previous": "❮"
                        }
                    },
                });
            });
        </script>
    @endsection