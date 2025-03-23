@extends('admin.layouts.app')

@section('title', 'Dasbor Utama')

@section('content')
    <!-- Dashboard Content - Scrollable -->
    <div class="flex-1 overflow-y-auto px-8 pt-6 pb-6">
        <div class="space-y-6">
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
            <!-- Election Session Toggle -->
            <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#926AE1]/20 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-bullhorn text-[#411C8C] text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-700">Mulai Sesi Pemilihan</h2>
                            <p class="text-sm text-gray-500">Aktifkan dengan sekali klik</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <form action="{{ route('toggle.election') }}" method="POST" id="toggle-form">
                            @csrf
                            @php
                                $election = App\Models\Election::first();
                            @endphp
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="election-toggle" name="is_active" value="1" class="sr-only peer"
                                onchange="document.getElementById('toggle-form').submit();"
                                {{ $election && $election->is_active ? 'checked' : '' }}> <!-- Cek status dari database -->
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full 
                                peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white 
                                after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#7C3AED]">
                            </div>
                        </form>
                    </label>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Pemilih -->
                <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="w-12 h-12 mb-4 bg-[#926AE1]/20 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-users fa-xl text-[#411C8C]"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-700">{{ count($voter) }}</h3>
                            <p class="text-gray-500">Total Pemilih</p>
                        </div>
                    </div>
                </div>

                <!-- Total Kandidat -->
                <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="w-12 h-12 mb-4 bg-[#72E1B2]/40 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-user fa-xl text-[#22A06B]"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-700">{{ count($candidate) }}</h3>
                            <p class="text-gray-500">Total Kandidat</p>
                        </div>
                    </div>
                </div>

                <!-- Suara Masuk -->
                <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="w-12 h-12 mb-4 bg-[#FFEAB8]/80 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-chart-line fa-xl text-[#FFB300]"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-700">{{ count($voteResults) }}</h3>
                            <p class="text-gray-500">Suara Masuk</p>
                        </div>
                    </div>
                </div>

                <!-- Belum Voting -->
                <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="w-12 h-12 mb-4 bg-[#EA7C6E]/50 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-times fa-2xl text-[#AE2A19]"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-700">{{ count($voterNotVoted) }}</h3>
                            <p class="text-gray-500">Belum Voting</p>
                        </div>
                    </div>
                </div>
            </div>

            @php
                # Background Changing Color
                if ($votedPercentage == 0) {
                    $votedBgColor = 'bg-[#AE2A19]'; // Merah (0%)
                } elseif ($votedPercentage > 0 && $votedPercentage < 50) {
                    $votedBgColor = 'bg-[#FFB300]'; // Kuning (0 - 49.99%)
                } elseif ($votedPercentage >= 50 && $votedPercentage < 100) {
                    $votedBgColor = 'bg-[#1D7AFC]'; // Biru (50 - 99.99%)
                } else {
                    $votedBgColor = 'bg-[#22A06B]'; // Hijau (100%)
                }
                // ----------------------------------------------------------------
                if ($notVotedPercentage == 0) {
                    $notVotedBgColor = 'bg-[#22A06B]'; // Merah (0%)
                } elseif ($notVotedPercentage > 0 && $notVotedPercentage < 50) {
                    $notVotedBgColor = 'bg-[#1D7AFC]'; // Kuning (0 - 49.99%)
                } elseif ($notVotedPercentage >= 50 && $notVotedPercentage < 100) {
                    $notVotedBgColor = 'bg-[#FFB300]'; // Biru (50 - 99.99%)
                } else {
                    $notVotedBgColor = 'bg-[#AE2A19]'; // Hijau (100%)
                }

                # Text Changing Color
                if ($votedPercentage == 0) {
                    $votedTextColor = 'text-[#AE2A19]'; // Merah (0%)
                } elseif ($votedPercentage > 0 && $votedPercentage < 50) {
                    $votedTextColor = 'text-[#FFB300]'; // Kuning (0 - 49.99%)
                } elseif ($votedPercentage >= 50 && $votedPercentage < 100) {
                    $votedTextColor = 'text-[#1D7AFC]'; // Biru (50 - 99.99%)
                } else {
                    $votedTextColor = 'text-[#22A06B]'; // Hijau (100%)
                }
                // ----------------------------------------------------------------
                if ($notVotedPercentage == 0) {
                    $notVotedTextColor = 'text-[#22A06B]'; // Merah (0%)
                } elseif ($notVotedPercentage > 0 && $notVotedPercentage < 50) {
                    $notVotedTextColor = 'text-[#1D7AFC]'; // Kuning (0 - 49.99%)
                } elseif ($notVotedPercentage >= 50 && $notVotedPercentage < 100) {
                    $notVotedTextColor = 'text-[#FFB300]'; // Biru (50 - 99.99%)
                } else {
                    $notVotedTextColor = 'text-[#AE2A19]'; // Hijau (100%)
                }
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Percentage Results -->
                <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6 text-center">
                    <h2 class="text-2xl font-bold text-gray-700 mb-2">Persentase Hasil Perolehan Suara</h2>
                    <p class="text-gray-500 mb-6"></p>

                    <div class="{{ $votedBgColor }} bg-opacity-20 backdrop-blur-lg rounded-lg p-4 inline-block mb-4">
                        <span class="text-4xl lg:text-5xl font-bold {{ $votedTextColor }}">{{ $votedPercentage }}%</span>
                    </div>
                    <p class="text-gray-500">Total Suara Masuk</p>
                </div>
                <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6 text-center">
                    <h2 class="text-2xl font-bold text-gray-700 mb-2">Persentase Belum Memberikan Suara</h2>
                    <p class="text-gray-500 mb-6"></p>

                    <div class="{{ $notVotedBgColor }} bg-opacity-20 backdrop-blur-lg rounded-lg p-4 inline-block mb-4">
                        <span
                            class="text-4xl lg:text-5xl font-bold {{ $notVotedTextColor }}">{{ $notVotedPercentage }}%</span>
                    </div>
                    <p class="text-gray-500">Total Suara Belum Masuk</p>
                </div>
            </div>


            <!-- Charts Section -->
            <div class="grid grid-cols-1 gap-6">
                <!-- Graph -->
                <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-700 mb-2">Grafik Perolehan Suara</h2>
                    <p class="text-sm text-gray-500 mb-2">Lihat grafik perolehan suara setiap kandidat.</p>
                    <div id="voteChart" class="h-64"></div>
                </div>

                <!-- Candidate Results -->
                <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-700 mb-2">Persentase Perolehan Suara</h2>
                    <p class="text-sm text-gray-500 mb-4">Lihat persentase perolehan suara setiap kandidat.</p>

                    <div class="space-y-6">
                        @php
                            $colors = [
                                'bg-[#22A06B]',
                                'bg-[#7C3AED]',
                                'bg-[#FFB300]',
                                'bg-[#EF4444]',
                                'bg-[#1D7AFC]',
                                'bg-[#EC4899]',
                            ];
                            $totalVotes = array_sum($voteCounts);
                        @endphp

                        @foreach ($candidate as $index => $c)
                            @php
                                $votes = 0;
                                $percentage = 0;
                                $colorIndex = $index % count($colors);

                                foreach ($votesByCandidate as $voteData) {
                                    // Cek apakah voteData itu array atau object
                                    if (is_array($voteData)) {
                                        if ($voteData['id_candidate'] == $c->id) {
                                            $votes = $voteData['total_votes'];
                                            break;
                                        }
                                    } else {
                                        if ($voteData->id_candidate == $c->id) {
                                            $votes = $voteData->total_votes;
                                            break;
                                        }
                                    }
                                }

                                if ($totalVotes > 0) {
                                    $percentage = round(($votes / $totalVotes) * 100, 1);
                                }
                            @endphp
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="font-medium text-gray-700">{{ $c->name }}</span>
                                    <span class="font-medium text-gray-700">{{ $percentage }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="{{ $colors[$colorIndex] }} h-4 rounded-full"
                                        style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toggleSwitch = document.getElementById("election-toggle");

                toggleSwitch.addEventListener("change", function() {
                    fetch("/toggle-election-session", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({}),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                            } else {
                                alert("Terjadi kesalahan.");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });
            });
        </script>

        <!-- Initialize ApexCharts -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gunakan data yang sudah disiapkan controller
                const candidates = @json($candidates);
                const voteCounts = @json($voteCounts);

                const colors = ['#22A06B', '#7C3AED', '#FFB300', '#EF4444', '#1D7AFC', '#EC4899'];

                // Create the chart
                const options = {
                    series: [{
                        name: 'Perolehan Suara',
                        data: voteCounts
                    }],
                    chart: {
                        type: 'bar',
                        height: 250,
                        toolbar: {
                            show: false
                        },
                        fontFamily: 'inherit',
                        background: 'transparent'
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            distributed: true,
                            dataLabels: {
                                position: 'top'
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val;
                        },
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold'
                        }
                    },
                    xaxis: {
                        categories: candidates,
                        labels: {
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah Suara'
                        }
                    },
                    colors: colors,
                    legend: {
                        show: false
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + " suara";
                            }
                        }
                    }
                };

                const chart = new ApexCharts(document.querySelector("#voteChart"), options);
                chart.render();
            });
        </script>

    @endsection
