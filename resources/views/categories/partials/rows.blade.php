@forelse($categories as $category)
<tr class="hover:bg-slate-50/80 transition-colors">
    <td class="px-6 py-4 text-center">
        <span class="inline-block px-2 py-1 rounded bg-slate-100 border border-slate-200 text-xs font-bold text-slate-700 font-mono">
            {{ $category->code }}
        </span>
    </td>

    <td class="px-6 py-4 font-bold text-slate-800">
        {{ $category->name }}
    </td>

    <td class="px-6 py-4 text-slate-500">
        {{ $category->description ?? '-' }}
    </td>

    <td class="px-6 py-4 text-right">
        <div class="flex justify-end gap-2">
            <a href="{{ route('categories.edit', $category->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-yellow-50 hover:text-yellow-600 transition shadow-sm" title="Edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </a>

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline delete-form">
                @csrf @method('DELETE')
                <button type="button" class="delete-btn p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-red-50 hover:text-red-600 transition shadow-sm" title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </form>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center py-10 text-slate-500">
        <div class="flex flex-col items-center justify-center">
            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
            <p>Tidak ada kategori ditemukan.</p>
        </div>
    </td>
</tr>
@endforelse