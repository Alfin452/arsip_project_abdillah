@forelse($letters as $letter)
<tr class="hover:bg-slate-50/80 transition-colors duration-200">
    <td class="px-6 py-4 align-top">
        <div class="flex items-start gap-3">
            <div class="p-2 bg-green-50 rounded-lg text-green-600 mt-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </div>
            <div>
                <div class="font-bold text-slate-800 text-base mb-1">
                    {{ $letter->reference_number }}
                </div>
                <div class="text-slate-500 line-clamp-2 leading-relaxed text-sm">
                    {{ $letter->description }}
                </div>
            </div>
        </div>
    </td>

    <td class="px-6 py-4 align-top">
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2 text-slate-700 font-medium">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ $letter->destination }}
            </div>
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $letter->letter_date->format('d M Y') }}
            </div>
        </div>
    </td>

    <td class="px-6 py-4 align-top">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
            {{ $letter->category->name }}
        </span>
    </td>

    <td class="px-6 py-4 align-top text-right">
        <div class="flex justify-end gap-2">

            <a href="{{ route('outgoing-letters.show', $letter->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-green-50 hover:text-green-600 transition shadow-sm" title="Lihat Detail">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </a>

            <a href="{{ route('outgoing-letters.edit', $letter->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-yellow-50 hover:text-yellow-600 transition shadow-sm" title="Edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </a>

            <form action="{{ route('outgoing-letters.destroy', $letter->id) }}" method="POST" class="inline delete-form">
                @csrf
                @method('DELETE')
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
    <td colspan="4" class="px-6 py-12 text-center">
        <div class="flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </div>
            <h3 class="text-slate-900 font-semibold text-lg">Belum ada surat keluar</h3>
            <p class="text-slate-500 text-sm mt-1">Mulai arsipkan surat keluar instansi di sini.</p>
        </div>
    </td>
</tr>
@endforelse