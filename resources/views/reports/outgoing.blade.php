<x-app-layout>
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Laporan Surat Keluar</h2>
            <p class="text-sm text-slate-500">Pratinjau data sebelum dicetak.</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('reports.index') }}" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-xl font-bold text-sm hover:bg-slate-50">
                Kembali
            </a>
            <a href="{{ route('reports.print.outgoing', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Laporan
            </a>
        </div>
    </div>

    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200 mb-6">
        <form action="{{ route('reports.incoming') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
            <div class="w-full md:w-auto">
                <label class="text-xs font-bold text-slate-500 mb-1 block">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="rounded-xl border-slate-300 text-sm w-full md:w-48">
            </div>
            <div class="w-full md:w-auto">
                <label class="text-xs font-bold text-slate-500 mb-1 block">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="rounded-xl border-slate-300 text-sm w-full md:w-48">
            </div>
            <button type="submit" class="px-5 py-2 bg-slate-800 text-white rounded-xl text-sm font-bold hover:bg-slate-700">
                Tampilkan Data
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 bg-slate-50 border-b border-slate-100 flex justify-between">
            <span class="font-bold text-slate-700">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</span>
            <span class="text-sm text-slate-500">Total: {{ count($data) }} Data</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-100 text-xs uppercase font-bold text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3">No. Agenda</th>
                        <th class="px-4 py-3">No. Surat</th>
                        <th class="px-4 py-3">Tgl Surat</th>
                        <th class="px-4 py-3">Tujuan</th>
                        <th class="px-4 py-3">Perihal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($data as $index => $item)
                    <tr>
                        <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-mono text-indigo-600 font-bold">{{ $item->agenda_number }}</td>
                        <td class="px-4 py-3">{{ $item->reference_number }}</td>
                        <td class="px-4 py-3">{{ $item->letter_date->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 font-bold">{{ $item->destination }}</td>
                        <td class="px-4 py-3 line-clamp-1">{{ $item->description }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">Tidak ada data pada periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>