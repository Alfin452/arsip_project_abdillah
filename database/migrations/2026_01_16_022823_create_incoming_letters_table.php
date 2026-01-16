<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incoming_letters', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number'); // Nomor Surat dari pengirim
            $table->string('origin'); // Asal surat (Instansi pengirim)
            $table->string('agenda_number')->nullable(); // Nomor urut buku agenda (penting buat admin)
            $table->date('letter_date'); // Tanggal yang tertera di surat
            $table->date('received_date'); // Tanggal diterima admin
            $table->text('description'); // Perihal / Ringkasan isi
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relasi ke Kategori
            $table->string('file_path'); // Lokasi file PDF/Gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_letters');
    }
};
