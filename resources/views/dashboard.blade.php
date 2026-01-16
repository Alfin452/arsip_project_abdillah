<x-app-layout>
    <div class="mb-8 bg-gradient-to-r from-indigo-700 to-purple-700 rounded-3xl p-8 text-white shadow-xl shadow-indigo-200 relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">Halo, {{ Auth::user()->name }}!</h1>
                <p class="text-indigo-100 mt-2 text-lg">Dashboard monitoring arsip digital instansi.</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm p-3 rounded-xl border border-white/20 text-center min-w-[120px]">
                <p class="text-xs uppercase tracking-wider font-bold text-indigo-100">Hari Ini</p>
                <p class="text-xl font-bold">{{ date('d M Y') }}</p>
            </div>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 bg-white/10 transform skew-x-12 translate-x-12"></div>
        <div class="absolute right-10 bottom-0 h-32 w-32 bg-white/10 rounded-full blur-2xl"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Arsip Masuk</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $stats['incoming'] }}</h3>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-500 w-2/3 rounded-full"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Arsip Keluar</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $stats['outgoing'] }}</h3>
                </div>
                <div class="p-3 bg-green-50 text-green-600 rounded-xl group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-green-500 w-1/2 rounded-full"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
            <div class="flex justify-between items-start">
                <div>
                    @if(Auth::user()->role == 'admin')
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pending Global</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $stats['pending_global'] }}</h3>
                    @else
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tugas Saya</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $stats['my_pending'] }}</h3>
                    @endif
                </div>
                <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-yellow-500 w-1/3 rounded-full"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total User</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $stats['users'] }}</h3>
                </div>
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-purple-500 w-full rounded-full"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="font-bold text-slate-800 mb-4">Statistik Arsip {{ date('Y') }}</h3>
            <div id="trendChart" class="w-full h-80"></div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="font-bold text-slate-800 mb-4">Distribusi Kategori</h3>
            @if(empty($chartSeries))
            <div class="h-64 flex flex-col items-center justify-center text-slate-400">
                <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                </svg>
                <p class="text-sm">Belum ada data kategori.</p>
            </div>
            @else
            <div id="categoryChart" class="w-full h-80 flex justify-center"></div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-red-50/50 flex items-center justify-between">
                <h3 class="font-bold text-red-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Segera Jatuh Tempo
                </h3>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($upcomingDeadlines as $task)
                <div class="p-4 hover:bg-slate-50 transition">
                    <div class="flex justify-between items-start mb-1">
                        <span class="text-xs font-bold text-slate-500 uppercase">Deadline: {{ \Carbon\Carbon::parse($task->due_date)->format('d M') }}</span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-bold">
                            {{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-sm font-bold text-slate-800 line-clamp-1">{{ $task->incomingLetter->origin }}</p>
                    <p class="text-xs text-slate-500 line-clamp-1 mb-2">"{{ $task->note }}"</p>
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-[10px] font-bold">
                            {{ substr($task->user->name, 0, 1) }}
                        </div>
                        <span class="text-xs text-slate-600">{{ $task->user->name }}</span>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center">
                    <p class="text-sm text-slate-500">Tidak ada disposisi mendesak.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Masuk Terbaru</h3>
                <a href="{{ route('incoming-letters.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Semua &rarr;</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentIncoming as $letter)
                <div class="p-4 hover:bg-slate-50 transition flex items-start gap-3">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs">SM</div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-slate-800 truncate">{{ $letter->origin }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ $letter->reference_number }}</p>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-sm text-slate-500">Kosong</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Keluar Terbaru</h3>
                <a href="{{ route('outgoing-letters.index') }}" class="text-xs font-bold text-green-600 hover:underline">Semua &rarr;</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentOutgoing as $letter)
                <div class="p-4 hover:bg-slate-50 transition flex items-start gap-3">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center font-bold text-xs">SK</div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-slate-800 truncate">Ke: {{ $letter->destination }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ $letter->reference_number }}</p>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-sm text-slate-500">Kosong</div>
                @endforelse
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. CONFIG CHART TREN BULANAN
            const trendOptions = {
                series: [{
                    name: 'Surat Masuk',
                    data: @json($incomingPerMonth)
                }, {
                    name: 'Surat Keluar',
                    data: @json($outgoingPerMonth)
                }],
                chart: {
                    type: 'area',
                    height: 320,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'inherit'
                },
                colors: ['#4f46e5', '#16a34a'], // Indigo, Green
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    show: false
                }, // Sembunyikan angka Y-axis biar bersih
                grid: {
                    strokeDashArray: 4,
                    borderColor: '#f1f5f9'
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                legend: {
                    position: 'top'
                }
            };

            const trendChart = new ApexCharts(document.querySelector("#trendChart"), trendOptions);
            trendChart.render();


            // 2. CONFIG CHART DONUT KATEGORI
            const catData = @json($chartSeries);
            const catLabels = @json($chartCategories);

            if (catData.length > 0) {
                const pieOptions = {
                    series: catData,
                    labels: catLabels,
                    chart: {
                        type: 'donut',
                        height: 320,
                        fontFamily: 'inherit'
                    },
                    colors: ['#6366f1', '#ec4899', '#f59e0b', '#10b981', '#3b82f6'],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        fontSize: '14px',
                                        fontWeight: 600,
                                        color: '#64748b'
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        position: 'bottom'
                    }
                };

                const categoryChart = new ApexCharts(document.querySelector("#categoryChart"), pieOptions);
                categoryChart.render();
            }
        });
    </script>
</x-app-layout>