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
        Schema::create('dispositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incoming_letter_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tujuan disposisi (Karyawan mana)
            $table->string('status')->default('pending'); // pending, processed, completed
            $table->text('note')->nullable(); // Catatan/Instruksi (misal: "Segera balas", "Arsip saja")
            $table->date('due_date')->nullable(); // Batas waktu tindak lanjut
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositions');
    }
};
