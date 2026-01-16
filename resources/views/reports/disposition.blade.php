<x-app-layout>
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Laporan Monitoring Disposisi</h2>
            <p class="text-sm text-slate-500">Pratinjau status tindak lanjut surat sebelum dicetak.</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('reports.index') }}" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-xl font-bold text-sm hover:bg-slate-50">
                Kembali
            </a>
            <a href="{{ route('reports.print.disposition', ['start_date' => $startDate, 'end_date' => $endDate, 'status' => $status]) }}" target="_blank" class="px-6 py-2 bg-yellow-600 text-white rounded-xl font-bold text-sm hover:bg-yellow-700 shadow-lg shadow-yellow-500/30 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Laporan
            </a>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 mb-6">
        <form action="{{ route('reports.disposition') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
            <div class="w-full md:w-auto">
                <label class="text-xs font-bold text-slate-500 mb-1 block">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="rounded-xl border-slate-300 text-sm w-full md:w-48 focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <div class="w-full md:w-auto">
                <label class="text-xs font-bold text-slate-500 mb-1 block">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="rounded-xl border-slate-300 text-sm w-full md:w-48 focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <div class="w-full md:w-auto">
                <label class="text-xs font-bold text-slate-500 mb-1 block">Status Tugas</label>
                <select name="status" class="rounded-xl border-slate-300 text-sm w-full md:w-40 focus:ring-yellow-500 focus:border-yellow-500">
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processed" {{ $status == 'processed' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-slate-800 text-white rounded-xl text-sm font-bold hover:bg-slate-700 transition shadow-md">
                Tampilkan Data
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
            <span class="font-bold text-slate-700">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</span>
            <span class="px-3 py-1 rounded-full bg-white border border-slate-200 text-xs font-bold text-slate-600">Total: {{ count($data) }} Data</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-100 text-xs uppercase font-bold text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-center w-12">No</th>
                        <th class="px-4 py-3 w-1/4">Surat Masuk (Asal)</th>
                        <th class="px-4 py-3">Instruksi</th>
                        <th class="px-4 py-3">Penerima</th>
                        <th class="px-4 py-3">Batas Waktu</th>
                        <th class="px-4 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($data as $index => $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="font-bold text-slate-800">{{ $item->incomingLetter->origin ?? '-' }}</div>
                            <div class="text-xs text-slate-500 mt-0.5">Ref: {{ $item->incomingLetter->reference_number ?? '-' }}</div>
                        </td>
                        <td class="px-4 py-3 italic">"{{ $item->note }}"</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-[10px] font-bold">
                                    {{ substr($item->user->name ?? '-', 0, 1) }}
                                </div>
                                <span class="font-medium">{{ $item->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 font-mono text-xs">
                            {{ $item->due_date->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($item->status == 'pending')
                            <span class="px-2 py-1 rounded text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">Pending</span>
                            @elseif($item->status == 'processed')
                            <span class="px-2 py-1 rounded text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">Proses</span>
                            @else
                            <span class="px-2 py-1 rounded text-xs font-bold bg-green-100 text-green-700 border border-green-200">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p>Tidak ada data disposisi pada periode ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>