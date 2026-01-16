<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    protected $fillable = [
        'incoming_letter_id',
        'user_id',
        'status',
        'note',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Relasi: Disposisi milik satu surat masuk
    public function incomingLetter()
    {
        return $this->belongsTo(IncomingLetter::class);
    }

    // Relasi: Disposisi ditujukan ke satu user (karyawan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
