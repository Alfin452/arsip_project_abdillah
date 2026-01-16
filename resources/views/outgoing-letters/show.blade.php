<x-app-layout>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                    {{ $outgoingLetter->category->name }}
                </span>
                <span class="text-slate-300">|</span>
                <span class="text-sm text-slate-500 font-medium">Surat Keluar</span>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mt-1">Detail Surat Keluar</h2>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('outgoing-letters.index') }}" class="flex items-center px-4 py-2 bg-white border border-slate-300 rounded-xl text-slate-700 text-sm font-medium hover:bg-slate-50 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>

            <a href="{{ route('outgoing-letters.edit', $outgoingLetter->id) }}" class="flex items-center px-4 py-2 bg-yellow-50 border border-yellow-200 rounded-xl text-yellow-700 text-sm font-medium hover:bg-yellow-100 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Data
            </a>

            <a href="{{ asset('storage/' . $outgoingLetter->file_path) }}" target="_blank" download class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
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
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tujuan Surat</label>
                        <p class="text-base font-semibold text-slate-800 mt-1">{{ $outgoingLetter->destination }}</p>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nomor Surat</label>
                        <p class="text-base font-semibold text-slate-800 mt-1">{{ $outgoingLetter->reference_number }}</p>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Surat</label>
                        <div class="flex items-center gap-2 mt-1 text-sm font-medium text-slate-700">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $outgoingLetter->letter_date->isoFormat('D MMMM Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Isi Ringkas</h3>
                <p class="text-sm text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100 italic">
                    "{{ $outgoingLetter->description }}"
                </p>
            </div>
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
                    <a href="{{ asset('storage/' . $outgoingLetter->file_path) }}" target="_blank" class="text-xs font-medium text-indigo-600 hover:underline">
                        Buka di Tab Baru &nearr;
                    </a>
                </div>

                <div class="flex-1 bg-slate-200 relative overflow-hidden group">
                    @php $ext = pathinfo($outgoingLetter->file_path, PATHINFO_EXTENSION); @endphp

                    @if(in_array(strtolower($ext), ['pdf']))
                    <iframe src="{{ asset('storage/' . $outgoingLetter->file_path) }}" class="w-full h-full absolute inset-0" frameborder="0"></iframe>

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
                        <img id="previewImage" src="{{ asset('storage/' . $outgoingLetter->file_path) }}" alt="Surat Scan" class="max-w-full shadow-lg rounded-lg transition-transform duration-200 origin-center">
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

    <script>
        let scale = 1;
        const img = document.getElementById('previewImage');
        const zoomText = document.getElementById('zoomLevel');

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
                if (scale > 0.5) {
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