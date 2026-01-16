<x-app-layout>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                @if(Auth::user()->role == 'admin')
                Monitoring Disposisi
                @else
                Inbox Disposisi Saya
                @endif
            </h2>
            <p class="text-sm text-slate-500">
                @if(Auth::user()->role == 'admin')
                Pantau status tindak lanjut surat oleh karyawan.
                @else
                Daftar tugas dan instruksi surat yang harus ditindaklanjuti.
                @endif
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row gap-4 justify-between items-center">

            <div class="flex p-1 bg-slate-200 rounded-xl">
                <a href="{{ route('dispositions.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition {{ !request('status') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                    Semua
                </a>
                <a href="{{ route('dispositions.index', ['status' => 'pending']) }}" class="px-4 py-2 text-sm font-medium rounded-lg transition {{ request('status') == 'pending' ? 'bg-white text-yellow-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                    Pending
                </a>
                <a href="{{ route('dispositions.index', ['status' => 'processed']) }}" class="px-4 py-2 text-sm font-medium rounded-lg transition {{ request('status') == 'processed' ? 'bg-white text-blue-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                    Proses
                </a>
                <a href="{{ route('dispositions.index', ['status' => 'completed']) }}" class="px-4 py-2 text-sm font-medium rounded-lg transition {{ request('status') == 'completed' ? 'bg-white text-green-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                    Selesai
                </a>
            </div>
        </div>

        <div class="overflow-x-auto min-h-[300px]">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4 tracking-wide w-1/3">Surat & Instruksi</th>
                        <th class="px-6 py-4 tracking-wide">Penerima & Deadline</th>
                        <th class="px-6 py-4 tracking-wide text-center">Status</th>
                        <th class="px-6 py-4 tracking-wide text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($dispositions as $disp)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <div class="flex gap-3">
                                <div class="mt-1">
                                    @if($disp->status == 'completed')
                                    <div class="p-2 bg-green-100 text-green-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg></div>
                                    @elseif($disp->status == 'processed')
                                    <div class="p-2 bg-blue-100 text-blue-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg></div>
                                    @else
                                    <div class="p-2 bg-yellow-100 text-yellow-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg></div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-indigo-600 mb-1">
                                        Asal: {{ $disp->incomingLetter->origin ?? '-' }}
                                    </div>
                                    <p class="text-slate-800 font-medium line-clamp-2 italic">"{{ $disp->note }}"</p>
                                    <a href="{{ route('incoming-letters.show', $disp->incoming_letter_id) }}" class="text-xs text-slate-400 hover:text-indigo-600 hover:underline mt-1 inline-block">
                                        Lihat Detail Surat &rarr;
                                    </a>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 align-top">
                            <div class="flex flex-col gap-1">
                                @if(Auth::user()->role == 'admin')
                                <div class="flex items-center gap-2 font-bold text-slate-700">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $disp->user->name }}
                                </div>
                                @endif

                                <div class="flex items-center gap-2 text-xs {{ \Carbon\Carbon::parse($disp->due_date)->isPast() && $disp->status != 'completed' ? 'text-red-600 font-bold' : 'text-slate-500' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Deadline: {{ \Carbon\Carbon::parse($disp->due_date)->format('d M Y') }}
                                </div>

                                @if(\Carbon\Carbon::parse($disp->due_date)->isPast() && $disp->status != 'completed')
                                <span class="text-[10px] bg-red-100 text-red-700 px-2 py-0.5 rounded w-fit font-bold">Terlambat</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4 align-top text-center">
                            @if($disp->status == 'pending')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">Pending</span>
                            @elseif($disp->status == 'processed')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">Diproses</span>
                            @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">Selesai</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 align-top text-right">
                            @if(Auth::id() == $disp->user_id && $disp->status != 'completed')
                            <form action="{{ route('dispositions.update', $disp->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                @if($disp->status == 'pending')
                                <button type="submit" name="status" value="processed" class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition shadow-sm">
                                    Mulai Kerjakan
                                </button>
                                @elseif($disp->status == 'processed')
                                <button type="submit" name="status" value="completed" class="px-3 py-1.5 bg-green-600 text-white text-xs font-bold rounded-lg hover:bg-green-700 transition shadow-sm">
                                    Tandai Selesai
                                </button>
                                @endif
                            </form>
                            @elseif($disp->status == 'completed')
                            <span class="text-xs text-slate-400 italic">Tugas Selesai</span>
                            @endif

                            @if(Auth::user()->role == 'admin')
                            <form action="{{ route('dispositions.destroy', $disp->id) }}" method="POST" class="inline-block ml-1 delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-btn p-1.5 bg-white border border-slate-200 rounded-lg text-slate-400 hover:bg-red-50 hover:text-red-600 transition shadow-sm" title="Hapus Disposisi">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <h3 class="text-slate-500 font-medium">Tidak ada data disposisi.</h3>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $dispositions->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();
                const form = e.target.closest('.delete-form');
                Swal.fire({
                    title: 'Hapus Disposisi?',
                    text: "Data ini tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            }
        });
    </script>
</x-app-layout>