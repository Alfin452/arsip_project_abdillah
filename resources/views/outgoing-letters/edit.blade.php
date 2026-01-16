<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Edit Surat Keluar</h2>
            <p class="text-sm text-slate-500">Perbarui informasi arsip surat.</p>
        </div>
        <a href="{{ route('outgoing-letters.show', $outgoingLetter->id) }}" class="flex items-center w-fit px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Batal
        </a>
    </div>

    <form action="{{ route('outgoing-letters.update', $outgoingLetter->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
                <div class="mb-6 pb-4 border-b border-slate-100 flex items-center gap-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 text-sm font-bold shadow-sm ring-4 ring-white">1</span>
                    <h3 class="text-lg font-bold text-slate-800">Identitas Surat</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="reference_number" class="block text-sm font-semibold text-slate-700 mb-2">Nomor Surat</label>
                        <input type="text" name="reference_number" id="reference_number" value="{{ old('reference_number', $outgoingLetter->reference_number) }}" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50 transition-all">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <div class="relative">
                            <select name="category_id" id="category_id" class="appearance-none w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50 transition-all">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $outgoingLetter->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="destination" class="block text-sm font-semibold text-slate-700 mb-2">Tujuan Surat</label>
                        <input type="text" name="destination" id="destination" value="{{ old('destination', $outgoingLetter->destination) }}" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50 transition-all">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
                <div class="mb-6 pb-4 border-b border-slate-100 flex items-center gap-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 text-sm font-bold shadow-sm ring-4 ring-white">2</span>
                    <h3 class="text-lg font-bold text-slate-800">Waktu & Isi</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="letter_date" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Surat</label>
                        <input type="text" name="letter_date" id="letter_date" value="{{ old('letter_date', $outgoingLetter->letter_date->format('Y-m-d')) }}" class="datepicker w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-white cursor-pointer">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Perihal / Ringkasan Isi</label>
                        <textarea name="description" id="description" rows="3" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50 transition-all">{{ old('description', $outgoingLetter->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
                <div class="mb-6 pb-4 border-b border-slate-100 flex items-center gap-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 text-sm font-bold shadow-sm ring-4 ring-white">3</span>
                    <h3 class="text-lg font-bold text-slate-800">Dokumen Digital</h3>
                </div>

                <div class="mb-4 p-3 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg border border-slate-100 shadow-sm">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase">File Saat Ini</p>
                            <a href="{{ asset('storage/' . $outgoingLetter->file_path) }}" target="_blank" class="text-sm font-bold text-indigo-600 hover:underline">
                                Lihat Dokumen Terlampir
                            </a>
                        </div>
                    </div>
                </div>

                <div class="relative flex flex-col items-center justify-center px-6 py-10 border-2 border-dashed border-slate-300 rounded-2xl hover:bg-slate-50 hover:border-green-400 transition-all group">
                    <div class="text-center space-y-2">
                        <label for="file" class="cursor-pointer">
                            <span class="text-base font-semibold text-green-600 hover:text-green-500 underline decoration-2 underline-offset-2">Klik untuk ganti file</span>
                            <span class="text-slate-500"> (opsional)</span>
                            <input id="file" name="file" type="file" class="sr-only" accept=".pdf,.jpg,.png,.jpeg">
                        </label>
                        <p class="text-xs text-slate-400">Biarkan kosong jika tidak ingin mengubah file.</p>
                    </div>
                    <p id="file-name" class="mt-4 text-sm font-medium text-slate-800 hidden"></p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-2 pb-10">
                <button type="submit" class="px-8 py-2.5 text-sm font-bold text-black bg-green-600 rounded-xl hover:bg-green-700 focus:ring-4 focus:ring-green-200 transition shadow-lg shadow-green-500/30">
                    Simpan Perubahan
                </button>
            </div>

        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "j F Y",
                locale: "id",
                theme: "airbnb"
            });
            const fileInput = document.getElementById('file');
            const fileNameDisplay = document.getElementById('file-name');
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileNameDisplay.textContent = 'File baru terpilih: ' + this.files[0].name;
                    fileNameDisplay.classList.remove('hidden');
                }
            });
        });
    </script>
</x-app-layout>