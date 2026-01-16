<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 border border-indigo-200">
                    {{ $incomingLetter->category->name }}
                </span>
                <span class="text-slate-300">|</span>
                <span class="text-sm text-slate-500 font-medium">Agenda #{{ $incomingLetter->agenda_number }}</span>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mt-1">Detail Surat Masuk</h2>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('incoming-letters.index') }}" class="flex items-center px-4 py-2 bg-white border border-slate-300 rounded-xl text-slate-700 text-sm font-medium hover:bg-slate-50 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>

            <a href="{{ route('incoming-letters.edit', $incomingLetter->id) }}" class="flex items-center px-4 py-2 bg-yellow-50 border border-yellow-200 rounded-xl text-yellow-700 text-sm font-medium hover:bg-yellow-100 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Data
            </a>

            <a href="{{ asset('storage/' . $incomingLetter->file_path) }}" target="_blank" download class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download File
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-1 space-y-6">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Utama</h3>

                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Asal Instansi</label>
                        <p class="text-base font-semibold text-slate-800 mt-1">{{ $incomingLetter->origin }}</p>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nomor Surat</label>
                        <p class="text-base font-semibold text-slate-800 mt-1">{{ $incomingLetter->reference_number }}</p>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Perihal</label>
                        <p class="text-sm text-slate-600 mt-1 leading-relaxed bg-slate-50 p-3 rounded-lg border border-slate-100">
                            {{ $incomingLetter->description }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Detail Waktu</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tgl. Surat</label>
                        <div class="flex items-center gap-2 mt-1 text-sm font-medium text-slate-700">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $incomingLetter->letter_date->isoFormat('D MMMM Y') }}
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Diterima Tgl</label>
                        <div class="flex items-center gap-2 mt-1 text-sm font-medium text-slate-700">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $incomingLetter->received_date->isoFormat('D MMMM Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl shadow-lg text-white p-6 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 opacity-10">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold">Perintah Disposisi</h3>
                        <span class="px-2 py-1 bg-white/10 rounded-lg text-xs font-bold">{{ $incomingLetter->dispositions->count() }} Terkirim</span>
                    </div>
                    <p class="text-sm text-slate-300 mb-4">Berikan instruksi tindak lanjut kepada staff terkait surat ini.</p>

                    <button onclick="document.getElementById('dispositionModal').classList.remove('hidden')" class="w-full py-2.5 bg-white text-slate-900 font-bold rounded-xl text-sm hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Disposisi Baru
                    </button>
                </div>
            </div>

            @if($incomingLetter->dispositions->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Riwayat Instruksi</h3>
                <div class="space-y-4">
                    @foreach($incomingLetter->dispositions as $disp)
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex justify-between items-start mb-2">
                            <span class="font-bold text-sm text-indigo-700">{{ $disp->user->name }}</span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full {{ $disp->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst($disp->status) }}
                            </span>
                        </div>
                        <p class="text-xs text-slate-600 mb-2 italic">"{{ $disp->note }}"</p>
                        <div class="flex items-center gap-2 text-[10px] text-slate-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Batas: {{ $disp->due_date->format('d M Y') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden h-full flex flex-col min-h-[600px]">
                <div class="p-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center z-20 relative">
                    <h3 class="font-bold text-slate-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Preview Dokumen
                    </h3>
                    <a href="{{ asset('storage/' . $incomingLetter->file_path) }}" target="_blank" class="text-xs font-medium text-indigo-600 hover:underline">
                        Buka di Tab Baru &nearr;
                    </a>
                </div>

                <div class="flex-1 bg-slate-200 relative overflow-hidden group">
                    @php $ext = pathinfo($incomingLetter->file_path, PATHINFO_EXTENSION); @endphp

                    @if(in_array(strtolower($ext), ['pdf']))
                    <iframe src="{{ asset('storage/' . $incomingLetter->file_path) }}" class="w-full h-full absolute inset-0" frameborder="0"></iframe>

                    @elseif(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                    <div class="absolute top-4 left-1/2 transform -translate-x-1/2 z-10 flex items-center gap-2 bg-white/90 backdrop-blur shadow-lg rounded-full px-4 py-2 border border-slate-200 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <button onclick="zoomOut()" class="p-1 text-slate-600 hover:text-indigo-600 transition" title="Zoom Out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </button>
                        <span id="zoomLevel" class="text-xs font-bold text-slate-500 w-12 text-center">100%</span>
                        <button onclick="zoomIn()" class="p-1 text-slate-600 hover:text-indigo-600 transition" title="Zoom In">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                        <div class="w-px h-4 bg-slate-300 mx-1"></div>
                        <button onclick="resetZoom()" class="p-1 text-slate-600 hover:text-red-600 transition" title="Reset">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="w-full h-full overflow-auto flex items-center justify-center p-4" id="imageContainer">
                        <img id="previewImage" src="{{ asset('storage/' . $incomingLetter->file_path) }}" alt="Surat Scan" class="max-w-full shadow-lg rounded-lg transition-transform duration-200 origin-center">
                    </div>

                    @else
                    <div class="flex flex-col items-center justify-center h-full text-slate-500 p-10">
                        <p class="font-medium">Preview tidak tersedia.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="dispositionModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">

                    <form action="{{ route('dispositions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="incoming_letter_id" value="{{ $incomingLetter->id }}">

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg font-bold leading-6 text-slate-900" id="modal-title">Buat Disposisi Baru</h3>
                                    <div class="mt-6 space-y-4">

                                        <div>
                                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tujuan Disposisi (Staff)</label>
                                            <div class="relative">
                                                <select name="user_id" class="appearance-none w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5">
                                                    @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->jabatan }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Batas Waktu</label>
                                            <div class="relative">
                                                <input type="text" name="due_date" class="datepicker w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 pl-10 cursor-pointer" placeholder="Pilih tanggal deadline...">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Instruksi</label>
                                            <textarea name="note" rows="3" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm" placeholder="Tulis instruksi tindak lanjut..."></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 rounded-b-2xl">
                            <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto transition">Kirim Disposisi</button>
                            <button type="button" onclick="document.getElementById('dispositionModal').classList.add('hidden')" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-2 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition">Batal</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Init Datepicker Modal
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "j F Y",
                locale: "id",
                allowInput: true,
                theme: "airbnb",
                defaultDate: new Date().fp_incr(3) // Default +3 hari dari sekarang
            });
        });

        // 2. Logic Zoom Gambar
        let scale = 1;
        const img = document.getElementById('previewImage');
        const zoomText = document.getElementById('zoomLevel');

        // Cek apakah gambar ada (kalau PDF, elemen ini null)
        if (img) {
            function updateZoom() {
                img.style.transform = `scale(${scale})`;
                zoomText.innerText = Math.round(scale * 100) + '%';
            }

            function zoomIn() {
                scale += 0.1;
                updateZoom();
            }

            function zoomOut() {
                if (scale > 0.5) { // Batas minimal zoom out
                    scale -= 0.1;
                    updateZoom();
                }
            }

            function resetZoom() {
                scale = 1;
                updateZoom();
            }
        }
    </script>
</x-app-layout>