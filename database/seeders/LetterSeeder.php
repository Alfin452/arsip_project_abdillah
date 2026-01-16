<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\Disposition;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class LetterSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil Data Pendukung
        $catUndangan = Category::where('code', 'UND')->first();
        $catSK = Category::where('code', 'SK')->first();
        $staffBudi = User::where('email', 'staff@staff.com')->first();

        // 1. BUAT CONTOH SURAT MASUK
        $suratMasuk = IncomingLetter::create([
            'reference_number' => '005/DINAS-LUAR/V/2025',
            'origin' => 'Dinas Pendidikan Kota',
            'agenda_number' => '001',
            'letter_date' => Carbon::now()->subDays(2), // 2 hari lalu
            'received_date' => Carbon::now()->subDays(1), // diterima kemarin
            'description' => 'Undangan Sosialisasi Aplikasi Arsip Digital',
            'category_id' => $catUndangan->id,
            'file_path' => 'dummy_surat_masuk.pdf', // File dummy
        ]);

        // 2. BUAT DISPOSISI OTOMATIS UNTUK SURAT MASUK DI ATAS
        // Ceritanya Admin/Pimpinan menyuruh Budi untuk hadir
        Disposition::create([
            'incoming_letter_id' => $suratMasuk->id,
            'user_id' => $staffBudi->id, // Disposisi ke Budi
            'status' => 'pending',
            'note' => 'Tolong dihadiri dan buat rangkuman hasil rapatnya.',
            'due_date' => Carbon::now()->addDays(3), // Deadline 3 hari lagi
        ]);

        // 3. BUAT CONTOH SURAT KELUAR
        OutgoingLetter::create([
            'reference_number' => '099/SK/KANTOR-KITA/2025',
            'destination' => 'Seluruh Karyawan',
            'letter_date' => Carbon::now(),
            'description' => 'SK Penetapan Jam Kerja Baru Bulan Ramadhan',
            'category_id' => $catSK->id,
            'file_path' => 'dummy_sk_kerja.pdf',
        ]);
    }
}
