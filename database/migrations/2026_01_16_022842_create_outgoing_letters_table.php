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
        Schema::create('outgoing_letters', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique(); // Nomor Surat yang kita keluarkan
            $table->string('destination'); // Tujuan surat
            $table->date('letter_date'); // Tanggal surat
            $table->text('description'); // Perihal
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('file_path')->nullable(); // Bisa null kalau baru digenerate, tapi sebaiknya wajib upload arsip final
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_letters');
    }
};
