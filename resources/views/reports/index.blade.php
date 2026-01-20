<x-app-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-bold text-slate-800">Pusat Laporan</h2>
        <p class="text-slate-500 mt-2">Pilih jenis laporan yang ingin ditampilkan dan dicetak.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 max-w-7xl mx-auto">

        <a href="{{ route('reports.incoming') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-lg group-hover:text-indigo-600 transition-colors">Agenda Masuk</h3>
            <p class="text-sm text-slate-500 mt-2">Laporan surat diterima.</p>
        </a>

        <a href="{{ route('reports.outgoing') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-lg group-hover:text-green-600 transition-colors">Agenda Keluar</h3>
            <p class="text-sm text-slate-500 mt-2">Laporan surat dikirim.</p>
        </a>

        <a href="{{ route('reports.disposition') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-lg group-hover:text-yellow-600 transition-colors">Monitoring Tugas</h3>
            <p class="text-sm text-slate-500 mt-2">Status disposisi staff.</p>
        </a>

        <a href="{{ route('reports.staff') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-lg group-hover:text-pink-600 transition-colors">Kinerja Pegawai</h3>
            <p class="text-sm text-slate-500 mt-2">Rekap beban kerja.</p>
        </a>

        <a href="{{ route('reports.print.category') }}" target="_blank" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-lg group-hover:text-purple-600 transition-colors">Rekap Kategori</h3>
            <p class="text-sm text-slate-500 mt-2">Statistik per jenis.</p>
        </a>

    </div>
</x-app-layout>