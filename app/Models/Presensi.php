<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensis';

    /**
     * Kolom yang bisa diisi mass assignment.
     */
    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'latitude_masuk',
        'longitude_masuk',
        'jam_pulang',
        'latitude_pulang',
        'longitude_pulang',
        'status',
        'keterangan',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
