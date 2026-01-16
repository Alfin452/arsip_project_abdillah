<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingLetter extends Model
{
    protected $fillable = [
        'reference_number',
        'destination',
        'letter_date',
        'description',
        'category_id',
        'file_path',
    ];

    protected $casts = [
        'letter_date' => 'date',
    ];

    // Relasi: Surat keluar milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
