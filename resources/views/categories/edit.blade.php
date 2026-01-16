<x-app-layout>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Edit Kategori</h2>
            <p class="text-sm text-slate-500">Perbarui data kategori.</p>
        </div>
        <a href="{{ route('categories.index') }}" class="flex items-center w-fit px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Batal
        </a>
    </div>

    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-10">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="code" class="block text-sm font-semibold text-slate-700 mb-2">Kode Kategori</label>
                <input type="text" name="code" id="code" value="{{ old('code', $category->code) }}" class="w-full uppercase rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50 font-mono" maxlength="10" required>
                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" id="description" rows="3" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="flex items-center justify-end pt-4">
                <button type="submit" class="px-8 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition shadow-lg shadow-indigo-500/30">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>