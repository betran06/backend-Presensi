<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinPengajuan extends Model
{
    use HasFactory;

    protected $table = 'izin_pengajuans';

    /**
     * Kolom yang bisa diisi mass assignment.
     */
    protected $fillable = [
        'user_id',
        'jenis',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status',
        'approved_by',
    ];

    /**
     * Relasi ke User yang mengajukan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Admin yang approve/reject.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
