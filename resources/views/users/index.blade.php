<x-app-layout>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Data Karyawan</h2>
            <p class="text-sm text-slate-500">Manajemen akun pengguna aplikasi.</p>
        </div>

        <a href="{{ route('users.create') }}" class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah User
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('users.index') }}" method="GET" class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau jabatan..." class="pl-10 w-full rounded-lg border-slate-300 text-sm text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400">
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4 tracking-wide">Nama & Email</th>
                        <th class="px-6 py-4 tracking-wide">Jabatan</th>
                        <th class="px-6 py-4 tracking-wide text-center">Role</th>
                        <th class="px-6 py-4 tracking-wide text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800">{{ $user->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-slate-700 font-medium">{{ $user->jabatan ?? '-' }}</span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($user->role == 'admin')
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-800 text-white">Admin</span>
                            @else
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">Karyawan</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-yellow-50 hover:text-yellow-600 transition shadow-sm" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                @if($user->id != Auth::id())
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="delete-btn p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-red-50 hover:text-red-600 transition shadow-sm" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-slate-500">Tidak ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $users->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();
                const form = e.target.closest('.delete-form');
                Swal.fire({
                    title: 'Hapus User?',
                    text: "User ini tidak akan bisa login lagi!",
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
            timer: 3000,
            customClass: {
                popup: 'rounded-2xl'
            }
        });
    </script>
    @endif
</x-app-layout>