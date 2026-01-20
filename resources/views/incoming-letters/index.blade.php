<x-app-layout>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Surat Masuk</h2>
            <p class="text-sm text-slate-500">Kelola dan cari arsip surat yang masuk ke instansi.</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('incoming-letters.export') }}" class="flex items-center justify-center px-4 py-2 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/30">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export Excel
            </a>
            <a href="{{ route('incoming-letters.create') }}" class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Catat Surat
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row gap-4 justify-between items-center">

            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg id="searchIcon" class="h-4 w-4 text-slate-400 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <svg id="loadingIcon" class="animate-spin h-4 w-4 text-indigo-600 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <input type="text" id="searchInput" value="{{ request('search') }}" placeholder="Ketik untuk mencari..." class="pl-10 w-full rounded-lg border-slate-300 text-sm text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400 transition shadow-sm">
            </div>

            <div class="flex gap-2 w-full sm:w-auto">
                <select id="categoryFilter" class="w-full sm:w-auto rounded-lg border-slate-300 text-sm text-slate-600 focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <select id="orderFilter" class="w-full sm:w-auto rounded-lg border-slate-300 text-sm text-slate-600 focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer">
                    <option value="newest" {{ request('order') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('order') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto min-h-[300px]">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4 tracking-wide w-1/3">Detail Surat</th>
                        <th class="px-6 py-4 tracking-wide">Asal & Tujuan</th>
                        <th class="px-6 py-4 tracking-wide">Kategori</th>
                        <th class="px-6 py-4 tracking-wide text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-slate-100">
                    @include('incoming-letters.partials.rows')
                </tbody>
            </table>
        </div>

        @if($letters->hasPages())
        <div id="paginationContainer" class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $letters->links() }}
        </div>
        @endif
    </div>

    <template id="skeletonTemplate">
        @for($i=0; $i<5; $i++)
            <tr class="animate-pulse border-b border-slate-100">
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-slate-200 rounded-lg"></div>
                    <div class="space-y-2 flex-1">
                        <div class="h-3 bg-slate-200 rounded w-1/3"></div>
                        <div class="h-4 bg-slate-200 rounded w-3/4"></div>
                        <div class="h-3 bg-slate-200 rounded w-1/2"></div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="space-y-2">
                    <div class="h-4 bg-slate-200 rounded w-2/3"></div>
                    <div class="h-3 bg-slate-200 rounded w-1/2"></div>
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="h-6 bg-slate-200 rounded-full w-20"></div>
            </td>
            <td class="px-6 py-4">
                <div class="flex justify-end gap-2">
                    <div class="h-8 w-8 bg-slate-200 rounded-lg"></div>
                    <div class="h-8 w-8 bg-slate-200 rounded-lg"></div>
                    <div class="h-8 w-8 bg-slate-200 rounded-lg"></div>
                </div>
            </td>
            </tr>
            @endfor
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const orderFilter = document.getElementById('orderFilter');
            const tableBody = document.getElementById('tableBody');
            const skeletonTemplate = document.getElementById('skeletonTemplate');
            const searchIcon = document.getElementById('searchIcon');
            const loadingIcon = document.getElementById('loadingIcon');

            let debounceTimer;

            // Fungsi Utama Fetch Data
            function fetchData() {
                // 1. Tampilkan Skeleton & Loading Icon
                tableBody.innerHTML = skeletonTemplate.innerHTML;
                searchIcon.classList.add('hidden');
                loadingIcon.classList.remove('hidden');

                // 2. Ambil value dari input
                const search = searchInput.value;
                const category = categoryFilter.value;
                const order = orderFilter.value;

                // 3. Susun URL Query
                const params = new URLSearchParams({
                    search: search,
                    category_id: category,
                    order: order
                });

                // 4. AJAX Request (Fetch)
                fetch(`{{ route('incoming-letters.index') }}?` + params.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest' // Penting agar Controller tahu ini AJAX
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        // 5. Ganti isi tabel dengan hasil dari server
                        tableBody.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        tableBody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-red-500">Gagal memuat data.</td></tr>';
                    })
                    .finally(() => {
                        // 6. Sembunyikan Loading Icon
                        searchIcon.classList.remove('hidden');
                        loadingIcon.classList.add('hidden');
                    });
            }

            // Event Listener: Search dengan Debounce (500ms)
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(fetchData, 500); // Tunggu 500ms setelah user berhenti mengetik
            });

            // Event Listener: Filter Dropdown (Langsung fetch)
            categoryFilter.addEventListener('change', fetchData);
            orderFilter.addEventListener('change', fetchData);

            // Event Delegation untuk Tombol Hapus (Karena tombol ini ada di dalam tabel yang direload via AJAX)
            document.addEventListener('click', function(e) {
                // Cek apakah yang diklik adalah tombol hapus (atau icon di dalamnya)
                if (e.target.closest('.delete-btn')) {
                    e.preventDefault(); // Stop submit langsung

                    const form = e.target.closest('.delete-form');

                    // Tampilkan SweetAlert
                    Swal.fire({
                        title: 'Hapus Arsip Ini?',
                        text: "Data dan file surat akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#4f46e5', // Warna Indigo sesuai tema
                        cancelButtonColor: '#ef4444', // Warna Merah
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-2xl', // Biar rounded sesuai tema
                            confirmButton: 'rounded-xl px-4 py-2',
                            cancelButton: 'rounded-xl px-4 py-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit form manual jika user klik Ya
                        }
                    });
                }
            });

            // Cek apakah ada Session Flash Message (Success) dari Controller
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                confirmButtonColor: '#4f46e5',
                timer: 3000,
                customClass: {
                    popup: 'rounded-2xl'
                }
            });
            @endif
        });
    </script>
</x-app-layout>