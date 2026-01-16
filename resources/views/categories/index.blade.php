<x-app-layout>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Kategori Surat</h2>
            <p class="text-sm text-slate-500">Klasifikasi jenis arsip surat.</p>
        </div>

        <a href="{{ route('categories.create') }}" class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kategori
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
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
                <input type="text" id="searchInput" value="{{ request('search') }}" placeholder="Cari kode atau nama..." class="pl-10 w-full rounded-lg border-slate-300 text-sm text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400 transition shadow-sm">
            </div>
        </div>

        <div class="overflow-x-auto min-h-[300px]">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4 tracking-wide w-24 text-center">Kode</th>
                        <th class="px-6 py-4 tracking-wide">Nama Kategori</th>
                        <th class="px-6 py-4 tracking-wide">Deskripsi</th>
                        <th class="px-6 py-4 tracking-wide text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-slate-100">
                    @include('categories.partials.rows')
                </tbody>
            </table>
        </div>

        <div id="paginationContainer" class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $categories->links() }}
        </div>
    </div>

    <template id="skeletonTemplate">
        @for($i=0; $i<5; $i++)
            <tr class="animate-pulse border-b border-slate-100">
            <td class="px-6 py-4 text-center">
                <div class="h-6 bg-slate-200 rounded mx-auto w-12"></div>
            </td>
            <td class="px-6 py-4">
                <div class="h-5 bg-slate-200 rounded w-1/2"></div>
            </td>
            <td class="px-6 py-4">
                <div class="h-4 bg-slate-200 rounded w-3/4"></div>
            </td>
            <td class="px-6 py-4">
                <div class="flex justify-end gap-2">
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
            const tableBody = document.getElementById('tableBody');
            const skeletonTemplate = document.getElementById('skeletonTemplate');
            const searchIcon = document.getElementById('searchIcon');
            const loadingIcon = document.getElementById('loadingIcon');
            let debounceTimer;

            function fetchData() {
                // Tampilkan Skeleton
                tableBody.innerHTML = skeletonTemplate.innerHTML;
                searchIcon.classList.add('hidden');
                loadingIcon.classList.remove('hidden');

                const params = new URLSearchParams({
                    search: searchInput.value
                });

                fetch(`{{ route('categories.index') }}?` + params.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        tableBody.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        tableBody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-red-500">Gagal memuat data.</td></tr>';
                    })
                    .finally(() => {
                        searchIcon.classList.remove('hidden');
                        loadingIcon.classList.add('hidden');
                    });
            }

            // Debounce Trigger
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(fetchData, 500); // Tunggu 500ms
            });

            // SweetAlert Delete Logic
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-btn')) {
                    e.preventDefault();
                    const form = e.target.closest('.delete-form');
                    Swal.fire({
                        title: 'Hapus Kategori?',
                        text: "Pastikan kategori ini tidak sedang digunakan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#4f46e5',
                        cancelButtonColor: '#ef4444',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-4 py-2',
                            cancelButton: 'rounded-xl px-4 py-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                }
            });
        });
    </script>

    @if(session('success'))
    <script>
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
    </script>
    @endif
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session("error") }}',
            confirmButtonColor: '#ef4444',
            customClass: {
                popup: 'rounded-2xl'
            }
        });
    </script>
    @endif
</x-app-layout>