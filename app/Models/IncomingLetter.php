<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingLetter extends Model
{
    protected $fillable = [
        'reference_number',
        'origin',
        'agenda_number',
        'letter_date',
        'received_date',
        'description',
        'category_id',
        'file_path',
    ];

    // Agar tanggal bisa langsung diformat di Blade (contoh: ->format('d-m-Y'))
    protected $casts = [
        'letter_date' => 'date',
        'received_date' => 'date',
    ];

    // Relasi: Surat masuk milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Satu surat masuk bisa punya banyak disposisi (ke beberapa orang)
    public function dispositions()
    {
        return $this->hasMany(Disposition::class);
    }
}
