<x-app-layout>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Edit Karyawan</h2>
            <p class="text-sm text-slate-500">Perbarui data atau reset password pengguna.</p>
        </div>
        <a href="{{ route('users.index') }}" class="flex items-center w-fit px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Batal
        </a>
    </div>

    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-6 sm:p-10 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="jabatan" class="block text-sm font-semibold text-slate-700 mb-2">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $user->jabatan) }}" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50" required>
                    @error('jabatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">Role Aplikasi</label>
                    <div class="relative">
                        <select name="role" id="role" class="appearance-none w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/50">
                            <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <h3 class="text-sm font-bold text-slate-800 mb-4">Ubah Password (Opsional)</h3>

                <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-100 mb-4">
                    <p class="text-xs text-yellow-700 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Kosongkan kolom di bawah ini jika tidak ingin mengubah password user.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password Baru</label>
                        <input type="password" name="password" id="password" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-white" placeholder="Biarkan kosong...">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 bg-white" placeholder="Ulangi password...">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pt-4">
                <button type="submit" class="px-8 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition shadow-lg shadow-indigo-500/30">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>