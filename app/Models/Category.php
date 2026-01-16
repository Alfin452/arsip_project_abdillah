<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['code', 'name', 'description'];

    // Relasi: Satu kategori bisa memiliki banyak surat masuk
    public function incomingLetters()
    {
        return $this->hasMany(IncomingLetter::class);
    }

    // Relasi: Satu kategori bisa memiliki banyak surat keluar
    public function outgoingLetters()
    {
        return $this->hasMany(OutgoingLetter::class);
    }
}
