<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'admin',
            'jabatan' => 'Kepala Tata Usaha',
        ]);

        // Buat Akun Karyawan
        User::create([
            'name' => 'Budi Staff',
            'email' => 'staff@staff.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
            'jabatan' => 'Staff IT',
        ]);

        // Tambah user lain jika perlu
        User::create([
            'name' => 'Siti Sekretaris',
            'email' => 'siti@staff.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
            'jabatan' => 'Sekretaris',
        ]);
    }
}
