<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan pemanggilan itu penting!
        // User dan Kategori harus ada dulu sebelum buat Surat.
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            LetterSeeder::class,
        ]);
    }
}
