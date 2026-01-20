<x-app-layout>
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Laporan Kinerja Pegawai</h2>
            <p class="text-sm text-slate-500">Rekapitulasi beban kerja dan penyelesaian tugas disposisi.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('reports.index') }}" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-xl font-bold text-sm hover:bg-slate-50">Kembali</a>
            <a href="{{ route('reports.print.staff') }}" target="_blank" class="px-6 py-2 bg-pink-600 text-white rounded-xl font-bold text-sm hover:bg-pink-700 shadow-lg shadow-pink-500/30 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Laporan
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-bold text-slate-500">
                    <tr>
                        <th class="px-6 py-4 text-center w-12">No</th>
                        <th class="px-6 py-4">Nama Pegawai</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Total Tugas</th>
                        <th class="px-6 py-4 text-center text-yellow-600">Pending</th>
                        <th class="px-6 py-4 text-center text-blue-600">Proses</th>
                        <th class="px-6 py-4 text-center text-green-600">Selesai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($data as $index => $user)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-bold text-slate-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-center font-bold">{{ $user->total_assigned }}</td>
                        <td class="px-6 py-4 text-center font-mono text-yellow-600">{{ $user->total_pending }}</td>
                        <td class="px-6 py-4 text-center font-mono text-blue-600">{{ $user->total_process }}</td>
                        <td class="px-6 py-4 text-center font-mono text-green-600 font-bold">{{ $user->total_completed }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-slate-500">Belum ada data pegawai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>